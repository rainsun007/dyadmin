<?php

class DyaRole extends DyAdminModel
{
    protected $tableName = 'dya_role';

    public static function model($className = __CLASS__)
    {
        return new $className();
    }
}
