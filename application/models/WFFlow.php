<?php

class WFFlow extends DyAdminModel
{
    protected $tableName = 'wf_flow';

    public static function model($className = __CLASS__)
    {
        return new $className();
    }
}
