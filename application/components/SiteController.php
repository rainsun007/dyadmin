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

    protected function init()
    {
        parent::init();
        $this->view->defaultTheme = 'site';
        $this->view->defaultLayout = 'main';
    }

    protected function beforeAction()
    {
    }
}
