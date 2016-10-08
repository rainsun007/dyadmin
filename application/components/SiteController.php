<?php
/**
 * 站点前台父类.
 *
 * @author 大宇 Email:dyphp.com@gmail.com
 *
 * @link http://www.dyphp.com/
 *
 * @copyright Copyright 2011 dyphp.com
 **/
class SiteController extends Controller
{
    protected $allNeedLogin = false;
    protected $handlerPass = true;

    protected function init()
    {
        parent::init();
    }

    protected function beforeAction()
    {
    }
}
