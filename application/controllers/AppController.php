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
class AppController extends SiteController
{
    /**
     * 站点首页.
     **/
    public function actionIndex()
    {
        //站点首页逻辑
    }

    /**
     * 框架规则-登录action  此方法必须存在
     * 当游客访问accessRules方法中deny数组定义的action时 会自动跳转到此action.
     **/
    public function actionLogin()
    {
        $this->view->defaultTheme = 'site';
        $this->view->defaultLayout = 'main';
        $username = DyRequest::postStr('username');
        $password = DyRequest::postStr('password');
        if (empty($username) || empty($password) || DyFilter::isAccount($username)) {
            $this->view->render('login', compact('username'));
        }

        $authenticate = Dy::app()->auth->login($username, $password);
        $authenticate ? DyRequest::redirect('/') : $this->view->render('login', compact('username'));
    }

    /**
     * 退出action.
     **/
    public function actionLogout()
    {
        Dy::app()->auth->logout();
        DyRequest::redirect('/admin/login');
    }

    /**
     * 框架规则-错误信息获取action  如config中不配制errorHandler此方法必须存在
     * 当访问出错时会自动调用此方法.
     **/
    public function actionError()
    {
        $error = $this->actionParam;
        if (Dy::app()->preModule == 'admin') {
            //$this->view->defaultTheme = 'admin';
            //$this->view->defaultLayout = 'main';
            //$this->view->render('error', compact('error'));
            $this->forward('admin/home', 'error', $error);
        } else {
            $this->view->defaultTheme = 'site';
            $this->view->defaultLayout = 'main';
            var_dump($error);
        }
    }

    /**
     * 框架规则-信息获取action  如config中不配制messageHandler此方法必须存在
     * 使用框架showMsg时会自动调用此方法.
     **/
    public function actionMessage()
    {
        $message = $this->actionParam;
        if (Dy::app()->preModule == 'admin') {
            //$this->view->defaultTheme = 'admin';
            //$this->view->defaultLayout = 'main';
            //$this->view->render('Layout/message', compact('message'));
            $this->forward('admin/home', 'message', $message);
        } else {
            $this->view->defaultTheme = 'site';
            $this->view->defaultLayout = 'main';
            var_dump($message);
        }
    }
}
