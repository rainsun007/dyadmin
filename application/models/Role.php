<?php

class Role extends AppModel
{
    protected $tableName = 'role';

    public static function model($className = __CLASS__)
    {
        return new $className();
    }
}
