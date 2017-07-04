<?php

class WFTaskLog extends AppModel
{
    protected $tableName = 'wf_task_log';

    public static function model($className = __CLASS__)
    {
        return new $className();
    }

    /**
     * 任务log写入
     *
     * @param [int]    $tid     任务id
     * @param [int]    $op      操作类型
     * @param [string] $remark  备注信息
     * @return void
     */
    public function wirteLog($tid,$op,$remark){
        $userId = Dy::app()->auth->uid;
        $userInfo = User::model()->getById($userId);

        $data = array(
            'tid' => $tid,
            'userid' => $userInfo->id,
            'username' => $userInfo->realname,
            'create_time' => $this->datetime,
            'operate' => $op,
            'remark' => $remark,
        );
        return WFTaskLog::model()->insert($data);
    }
}
