<?php

class User extends AppModel
{
    protected $tableName = 'member';

    public static function model($className = __CLASS__)
    {
        return new $className();
    }

    /**
     * @brief    是否为管理员
     *
     * @return
     **/
    public function getRole()
    {
        //return isset($this->userInfo->group_id) && $this->userInfo->group_id == 1 ? true : false;
    }
}
