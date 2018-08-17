<?php

class WFTask extends DyAdminModel
{
    protected $tableName = 'wf_task';

    public static function model($className = __CLASS__)
    {
        return new $className();
    }
}
