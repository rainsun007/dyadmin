<?php 
/**
 * 使用该方法做为应用model的父类可使程序框架更灵活
 * 
 * @author QingYu.Sun Email:dyphp.com@gmail.com
 * @copyright dyphp.com
 * @link http://www.dyphp.com
 **/
class DyAdminModel extends DyPhpModel{ 
    //public $openExplain = false;
    
    protected function init()
    {
        parent::init();
    }
    
}
