<?php

/**
 * home controller
 * 框架规则-默认错误 信息 登陆处理对应此controller 如不使用默认需要在配制中定义.
 *
 * @author 大宇 Email:dyphp.com@gmail.com
 *
 * @link http://www.dyphp.com/
 *
 * @copyright Copyright 2011 dyphp.com
 */
class AppController extends BaseController
{
    /**
     * 站点首页.
     **/
    public function actionIndex()
    {
        DyRequest::redirect('/admin/login');
    }

    /**
     * 框架规则-登录action  此方法必须存在
     * 当游客访问accessRules方法中deny数组定义的action时 会自动跳转到此action.
     **/
    public function actionLogin()
    {
        DyRequest::redirect('/admin/login');
    }

    /**
     * 退出action.
     **/
    public function actionLogout()
    {
        DyTools::logs(Dy::app()->auth->username.'退出登录');
        Dy::app()->auth->logout();
        DyRequest::getStr('m') == 'admin' ? DyRequest::redirect('/admin/login') : DyRequest::redirect('/');
    }

    /**
     * 框架规则-错误信息获取action  如config中不配制errorHandler此方法必须存在
     * 当访问出错时会自动调用此方法.
     **/
    public function actionError()
    {
        $errorInfo = $this->actionParam;
        if ($this->moduleCheck()) {
            $this->forward('admin/home', 'error', $errorInfo);
        } else {
            $this->view->render('error',compact('errorInfo'));
        }
    }

    /**
     * 框架规则-信息获取action  如config中不配制messageHandler此方法必须存在
     * 使用框架showMsg时会自动调用此方法.
     **/
    public function actionMessage()
    {
        $msgInfo = $this->actionParam;
        if ($this->moduleCheck()) {
            $this->forward('admin/home', 'message', $msgInfo);
        } else {
            $this->view->render('message',compact('msgInfo'));
        }
    }

    /**
     * 验证是否为管理后台的module
     *
     * @return array
     */
    private function moduleCheck(){
        $adminModule = array('admin','workflow');
        $checkArr = array(Dy::app()->preModule,Dy::app()->module);
        return array_intersect($checkArr,$adminModule);
    }
}
