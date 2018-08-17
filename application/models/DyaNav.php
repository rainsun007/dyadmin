<?php

class DyaNav extends DyAdminModel
{
    protected $tableName = 'dya_nav';

    public static function model($className = __CLASS__)
    {
        return new $className();
    }
}
