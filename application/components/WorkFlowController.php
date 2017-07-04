<?php
/**
 * WorkFlowController.
 *
 * @author 大宇 Email:dyphp.com@gmail.com
 *
 * @link http://www.dyphp.com/
 *
 * @copyright Copyright 2016 dyphp.com
 */
class WorkFlowController extends AdminController
{
    protected $mailSubject = '工作流任务通知';

    protected function init()
    {
        parent::init();
        $this->view->defaultLayout = '/admin/Layout/main';
    }

    protected function getNodeUserIds($nodes)
    {
        $userIds = array();
        foreach ($nodes as $key => $value) {
            if (isset($value['userIds'])) {
                $userIds = array_merge($userIds, $value['userIds']);
            }
        }
        return array_unique($userIds);
    }

    protected function setNodeMarked($flowArr, $from, $to)
    {
         $nodes = $flowArr['nodes'];
         $lines = $flowArr['lines'];

        foreach ($nodes as $key => $value) {
            if ($key == $from) {
                $nodes[$key]['marked'] = true;
                $nodes[$key]['current'] = false;
            } elseif ($key == $to) {
                $nodes[$key]['marked'] = true;
                $nodes[$key]['current'] = true;
            } else {
                $nodes[$key]['current'] = false;
            }
        }

        foreach ($lines as $key => $value) {
            if ($value['from'] == $from && $value['to'] == $to) {
                $lines[$key]['marked'] = true;
                break;
            }
        }

         $flowArr['nodes'] = $nodes;
         $flowArr['lines'] = $lines;

         return json_encode($flowArr,JSON_UNESCAPED_UNICODE);
    }

    protected function getNodeNext($flowArr, $from)
    {
        $nodes = array();
        $lines = $flowArr['lines'];

        foreach ($lines as $key => $value) {
            if ($value['from'] == $from) {
                $nodes['nodes'][] = $value['to'];
                $nodes['lines'][] = $key;
            }
        }

        return $nodes;
    }

    protected function getNodeCurrent($flowArr){
        return getNodeCurrent($flowArr);
    }

    protected function accessCheck($flowNodes){
        if(!in_array($this->userId,$this->getNodeUserIds($flowNodes))){
            Common::msg('你无权访问该流程', 'warning', 401);
        }
    }

    protected function mailBodySuffix($id){
        return '<br /><br /><a href="'.DyRequest::createUrl('/workflow/task/view',array('id'=>$id)).'">查看任务详情</a>'.'<br /><a href="'.DyRequest::createUrl('/workflow/task/list').'">查看任务列表</a>';
    }

}
