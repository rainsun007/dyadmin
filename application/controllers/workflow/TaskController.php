<?php
/**
 * TaskController.
 *
 * @author 大宇 Email:dyphp.com@gmail.com
 *
 * @link http://www.dyphp.com/
 *
 * @copyright Copyright 2016 dyphp.com
 */
class TaskController extends WorkFlowController
{
    /**
     * 任务列表.
     **/
    public function actionList()
    {
        $where = '';
        $type = DyRequest::getInt('type');
        if($type < 999){
            if($this->userId == 1){
                $where = "`status` = {$type} ORDER BY priority DESC";
            }else{
                $where = "`status` = {$type} and (`node_users` LIKE '%,{$this->userId},%' OR `userid` = {$this->userId}) ORDER BY priority DESC";
            }
        }else{
            if($this->userId == 1){
                $where = "1=1 ORDER BY status ASC , priority DESC";
            }else{
                $where = "`node_users` LIKE '%,{$this->userId},%' OR `userid` = {$this->userId} ORDER BY status ASC , priority DESC";
            }
        }
        
        $pageSize = 20;
        $data = WFTask::model()->getAllForPage($where, $pageSize);
        $listData = $data['data'];
        $pageWidgetOptions = array(
            'count' => $data['count'],
            'pageSize' => $pageSize,
            'offset' => 3,
            'paramName' => 'page',
        );

        $this->view->render('list', compact('listData', 'pageWidgetOptions'), 'workflow');
    }

    /**
     * 发起流程，选择使用流程列表.
     **/
    public function actionFlowList()
    {
        $pageSize = 20;
        $criteria = Dy::app()->dbc->select()->where('status',0)->order('id', 'DESC');
        $data = WFFlow::model()->getAllForPage($criteria, $pageSize);
        $listData = $data['data'];
        $pageWidgetOptions = array(
            'count' => $data['count'],
            'pageSize' => $pageSize,
            'offset' => 3,
            'paramName' => 'page',
        );

        $this->view->render('flowList', compact('listData', 'pageWidgetOptions'), 'workflow');
    }

    /**
     * 发起流程设置与提交.
     **/
    public function actionAdd()
    {
        if (DyRequest::isPost()) {
            $flowArr = json_decode(DyRequest::postOriginal('flow'),true);
            $next = $this->getNodeNext($flowArr,'start_node');
            $flow = $this->setNodeMarked($flowArr,'start_node',$next['nodes'][0]);

            $fid = DyRequest::postInt('fid');

            $data = array(
                'fid' => $fid,
                'name' => DyRequest::postStr('name'),
                'explain' => DyRequest::postStr('explain'),
                'priority' => DyRequest::postStr('priority'),
                'userid' => $this->userInfo->id,
                'username' => $this->userInfo->realname,
                'create_time' => $this->datetime,
                'status' => 0,
                'flow' => $flow,
                'node_users'=>','.join(',',$this->getNodeUserIds($flowArr['nodes'])).',',
            );
            $result = WFTask::model()->insert($data);
            $tid = WFTask::model()->getInsertId();

            WFFlow::model()->update(array('used'=>1),"id={$fid}");


            WFTaskLog::model()->wirteLog($tid,0,'任务开始: '.$this->userInfo->realname.' 创建了任务');

            $body = '【新工作流】<br /><br />《'.DyRequest::postStr('name').'》与你相关的任务已启动 <br /><br /> 注意响应操作'.$this->mailBodySuffix($tid);
            $this->sendMail($this->getNodeUserIds($flowArr['nodes']),$this->mailSubject,$body);
            $body = '【新工作流】<br /><br />《'.DyRequest::postStr('name').'》流程已到达你负责的节点 <br /><br /> 尽快响应处理'.$this->mailBodySuffix($tid);
            $this->sendMail($flowArr['nodes'][$next['nodes'][0]]['userIds'],$this->mailSubject,$body);

            echo $result ? DyTools::apiJson(0, 200, '创建成功', $result) : DyTools::apiJson(1, 500, '创建失败', $result);
            exit;
        }

        $id = DyRequest::getInt('id');
        $flowInfo = WFFlow::model()->getOne("id={$id} and status=0");
        if(!$flowInfo){
            Common::msg('该工作流已不可用', 'warning', 403);
        }
        $this->view->render('add', compact('flowInfo'), 'workflow');
    }

    /**
     * 任务信息编辑.
     **/
    public function actionEdit()
    {
        if (DyRequest::isPost()) {
            $tid = DyRequest::postInt('tid');
            $taskInfo = WFTask::model()->getById($tid);

            $logMsg = '';
            if($taskInfo->name != DyRequest::postStr('name')){
                $logMsg .= '<br />流程名称: '.$taskInfo->name.' -> '.DyRequest::postStr('name');
            }

            if($taskInfo->explain != DyRequest::postStr('explain')){
                $logMsg .= '<br />说明: '.$taskInfo->explain.' -> '.DyRequest::postStr('explain');
            }

            if($taskInfo->priority != DyRequest::postStr('priority')){
                $logMsg .= '<br />优先级: '.$taskInfo->priority.' -> '.DyRequest::postStr('priority');
            }

            if($logMsg == ''){
                echo DyTools::apiJson(0, 200, '信息没有变动，无需修改');
                exit;
            }

            $data = array(
                'name' => DyRequest::postStr('name'),
                'explain' => DyRequest::postStr('explain'),
                'priority' => DyRequest::postStr('priority'),
            );
            $result = WFTask::model()->update($data,"id={$tid} and userid={$this->userId}");

            WFTaskLog::model()->wirteLog($tid,6,'任务修改: '.$this->userInfo->realname.' 修改了任务'.$logMsg);

            $body = '【任务信息修改】<br /><br />《'.DyRequest::postStr('name').'》与你相关的任务信息已修改'.$logMsg.$this->mailBodySuffix($tid);
            $flowArr = json_decode(DyRequest::postOriginal('flow'),true);
            $this->sendMail($this->getNodeUserIds($flowArr['nodes']),$this->mailSubject,$body);

            echo $result ? DyTools::apiJson(0, 200, '修改成功', $result) : DyTools::apiJson(1, 500, '修改失败', $result);
            exit;
        }

        $fid = DyRequest::getInt('fid');
        $tid = DyRequest::getInt('tid');
        $taskInfo = WFTask::model()->getOne("id={$tid}");
        $flowInfo = WFFlow::model()->getOne("id={$fid}");
        $this->view->render('add', compact('flowInfo','taskInfo'), 'workflow');
    }

    /**
     * 终止，重启操作.
     **/
    public function actionStop()
    {
        $tid = DyRequest::postInt('tid');
        if ($tid == 0) {
            echo DyTools::apiJson(1, 403, '请求数据有误！');
            exit;
        }
        $op  = DyRequest::postInt('op');
        $data = array('status' => $op);
        $result = WFTask::model()->update($data, "id={$tid} and userid={$this->userId} and status<2");

        $taskInfo = WFTask::model()->getById($tid);
        $flowArr = json_decode($taskInfo->flow,true);


        $bodyTitle = $op == 0 ? '工作流重启' : '工作流终止';
        $logOp = $op == 0 ? 5 : 4;
        WFTaskLog::model()->wirteLog($tid,$logOp,$bodyTitle);

        $body = '【'.$bodyTitle.'】<br /><br />《'.$taskInfo->name.'》与你相关的任务状态已改变 <br /><br /> 注意响应操作'.$this->mailBodySuffix($tid);
        $this->sendMail($this->getNodeUserIds($flowArr['nodes']),$this->mailSubject,$body);

        echo $result ? DyTools::apiJson(0, 200, '用户编辑成功', $result) : DyTools::apiJson(1, 500, '用户编辑失败', $result);
    }

    /**
     * 查看流程.
     **/
    public function actionView()
    {
        $id = DyRequest::getInt('id');
        $taskInfo = WFTask::model()->getById($id);

        $flowArr = json_decode($taskInfo->flow,true);
        $current = $this->getNodeCurrent($flowArr);
        $nextArr = $this->getNodeNext($flowArr,$current['id']);

        $this->accessCheck($flowArr['nodes'],$taskInfo->userid);

        $listData = WFTaskLog::model()->getAll("tid={$id} order by id desc");

        $this->view->render('view', compact('flowArr','taskInfo','current','nextArr','listData'), 'workflow');
    }

     /**
     * 流程操作.
     **/
    public function actionFlowOp()
    {
        $tid = DyRequest::postStr('tid');
        $from = DyRequest::postStr('from');
        $to = DyRequest::postStr('to');
        
        $taskInfo = WFTask::model()->getById($tid);
        $flowArr = json_decode($taskInfo->flow,true);
        $this->accessCheck($flowArr['nodes'],$taskInfo->userid);

        if($taskInfo->status == 1 || $taskInfo->status == 2){
            echo DyTools::apiJson(1, 403, '当前任务状态不可操作！');
            exit;
        }

        $op = $to == 'undefined' || empty($to) ? 2 : 1;
        $result = WFTaskLog::model()->wirteLog($tid,$op,DyRequest::postStr('remark'));

        if($to != 'undefined' && !empty($to)){
            $flow = $this->setNodeMarked($flowArr,$from,$to);
            $data = array('flow'=>$flow);

            if($to == 'end_node'){
                $data['status'] = 2;
                WFTaskLog::model()->wirteLog($tid,3,'任务完成');
                $body = '【工作流结束】<br /><br />《'.$taskInfo->name.'》任务已结束'.$this->mailBodySuffix($tid);
                $this->sendMail($this->getNodeUserIds($flowArr['nodes']),$this->mailSubject,$body);
            }else{
                $body = '【任务提醒】<br /><br />《'.$taskInfo->name.'》流程已到达你负责的节点 <br /><br /> 尽快响应处理'.$this->mailBodySuffix($tid);
                $this->sendMail($flowArr['nodes'][$to]['userIds'],'【任务提醒】'.$this->mailSubject,$body);
            }

            WFTask::model()->update($data,"id={$tid}");
        }else{
            $body = '【备注添加】<br /><br />《'.$taskInfo->name.'》有新备注增加 <br /><br />备注内容：<br />'.DyRequest::postStr('remark').$this->mailBodySuffix($tid);
            $this->sendMail($this->getNodeUserIds($flowArr['nodes']),$this->mailSubject,$body);
        }

        echo $result ? DyTools::apiJson(0, 200, '操作成功', $result) : DyTools::apiJson(1, 500, '操作失败', $result);
        exit;
    }

}
