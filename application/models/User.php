<?php

class User extends AppModel
{
    protected $tableName = 'dya_member';

    public static function model($className = __CLASS__)
    {
        return new $className();
    }
}
