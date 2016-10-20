<?php

class Nav extends AppModel
{
    protected $tableName = 'dya_nav';

    public static function model($className = __CLASS__)
    {
        return new $className();
    }
}
