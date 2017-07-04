<?php

class WFFlow extends AppModel
{
    protected $tableName = 'wf_flow';

    public static function model($className = __CLASS__)
    {
        return new $className();
    }
}
