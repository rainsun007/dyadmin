<?php

class User extends AppModel
{
    protected $tableName = 'dya_member';

    public static function model($className = __CLASS__)
    {
        return new $className();
    }

    public function getUsers($ids = array()){
        $dbc = Dy::app()->dbc;
        $criteria = $dbc->select()->where('id',join(',',$ids),'in');
        //echo $dbc->getMysqlSql('dya_member');exit;
        return $this->getAll($criteria);
    }
}
