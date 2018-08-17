<?php
/**
 * WorkFlowController.
 *
 * @author 大宇 Email:dyphp.com@gmail.com
 * @link http://www.dyphp.com/
 * @copyright Copyright dyphp.com
 */
class WorkFlowController extends AdminController
{
    protected $mailSubject = '工作流任务通知';

    protected function init()
    {
        parent::init();
        $this->view->defaultTheme = 'workflow';
        $this->view->defaultLayout = '/admin/Layout/main';
    }

    /**
     * 获取节点中所有用户id
     *
     * @param array $nodes 工作流节点信息
     * @return array
     */
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

    /**
     * 标记节点操作状态，设置当前结点
     *
     * @param array $flowArr  工作流信息
     * @param string $from    开始节点
     * @param string $to      指向节点
     * @return string
     */
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

        return json_encode($flowArr, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 从指定节点获取所有可操作节点信息
     *
     * @param array $flowArr  工作流信息
     * @param string $from    节点id
     * @return array
     */
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

    /**
     * 从指定操作节点信息
     *
     * @param array $flowArr  工作流信息
     * @param string $from    开始节点id
     * @param string $to      指向节点id
     * @return array
     */
    protected function getLineInfo($flowArr, $from, $to)
    {
        $line = array();
        $lines = $flowArr['lines'];
        foreach ($lines as $key => $value) {
            if ($value['from'] == $from && $value['to'] == $to) {
                $line = $value;
                break;
            }
        }

        return $line;
    }

    /**
     * 获取工作流的当前节点
     *
     * @param array $flowArr 工作流信息
     * @return array
     */
    protected function getNodeCurrent($flowArr)
    {
        return getNodeCurrent($flowArr);
    }

    /**
     * 访问拦截
     *
     * @param array $flowNodes  工作流节点信息
     * @param int   $userId     放行的用户id
     * @return mix
    */
    protected function accessCheck($flowNodes, $userId=0)
    {
        if ($this->userId == 1) {
            return true;
        }
        $userIds = $this->getNodeUserIds($flowNodes);
        array_push($userIds, $userId);
        if (!in_array($this->userId, $userIds)) {
            Common::msg('你无权访问该流程', 'warning', 401);
        }
    }

    /**
     * 邮件内容的共用部分
     *
     * @param int $id 任务id
     * @return string
     */
    protected function mailBodySuffix($id)
    {
        return '<br /><br /><a href="'.DyRequest::createUrl('/workflow/task/view', array('id'=>$id)).'">查看任务详情</a>'.'<br /><a href="'.DyRequest::createUrl('/workflow/task/list').'">查看任务列表</a>';
    }
}
