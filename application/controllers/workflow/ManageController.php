<?php
/**
 * ManageController.
 *
 * @author 大宇 Email:dyphp.com@gmail.com
 *
 * @link http://www.dyphp.com/
 *
 * @copyright Copyright 2016 dyphp.com
 */
class ManageController extends WorkFlowController
{
    /**
     * 流程列表.
     **/
    public function actionList()
    {
        $pageSize = 20;
        $criteria = Dy::app()->dbc->select()->order('id', 'DESC');
        $data = WFFlow::model()->getAllForPage($criteria, $pageSize);
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
     * 创建流程.
     **/
    public function actionAdd()
    {
        if (DyRequest::isPost()) {
            $data = array(
                'name' => DyRequest::postStr('name'),
                'userid' => $this->userInfo->id,
                'username' => $this->userInfo->realname,
                'status' => 0,
                'explain' => DyRequest::postStr('explain'),
                'flow' => DyRequest::postStr('flow'),
                'create_time' => $this->datetime,
            );
            $result = WFFlow::model()->insert($data);
            echo $result ? DyTools::apiJson(0, 200, '创建成功', $result) : DyTools::apiJson(1, 500, '创建失败', $result);
            exit;
        }

        $fid = DyRequest::getInt('id');
        $flowInfo = WFFlow::model()->getById($fid);

        $userList = User::model()->getAll("status=1");

        $op = 'add';
        $this->view->render('add', compact('userList','flowInfo','op'), 'workflow');
    }

    /**
     * 禁止，启用操作.
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
        $result = WFFlow::model()->update($data, "id={$tid} and userid={$this->userId}");

        echo $result ? DyTools::apiJson(0, 200, '禁止/启用操作成功', $result) : DyTools::apiJson(1, 500, '禁止/启用操作失败', $result);
    }

    /**
     * 编辑.
     **/
    public function actionEdit()
    {
        if (DyRequest::isPost()) {
            $id = DyRequest::postInt('id');
            $flowInfo = WFFlow::model()->getById($id);
            $data = array(
                'name' => DyRequest::postStr('name'),
                'userid' => $this->userInfo->id,
                'username' => $this->userInfo->realname,
                'explain' => DyRequest::postStr('explain'),
            );
            if($flowInfo->used == 0){
                $data['flow'] = DyRequest::postStr('flow');
            }
            $result = WFFlow::model()->update($data, "id={$id}");
            echo $result ? DyTools::apiJson(0, 200, '编辑成功', $result) : DyTools::apiJson(1, 500, '编辑失败', $result);
            exit;
        }

        $fid = DyRequest::getInt('id');
        $flowInfo = WFFlow::model()->getById($fid);

        $userList = User::model()->getAll("status=1");

        $op = 'edit';
        $this->view->render('add', compact('userList','flowInfo','op'), 'workflow');
    }
}
