<?php

class Nav extends AppModel
{
    protected $tableName = 'nav';

    public static function model($className = __CLASS__)
    {
        return new $className();
    }
}
