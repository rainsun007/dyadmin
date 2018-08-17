<?php

/**
 * home controller
 * 框架规则-默认错误 信息 登陆处理对应此controller 如不使用默认需要在配制中定义.
 *
 * @author 大宇 Email:dyphp.com@gmail.com
 *
 * @link http://www.dyphp.com/
 *
 * @copyright Copyright dyphp.com
 */
class AppController extends BaseController
{
    /**
     * 站点首页.
     **/
    public function actionIndex()
    {
        DyRequest::redirect('/admin/home/login');
    }

    /**
     * 框架规则-登录action  此方法必须存在
     * 当游客访问accessRules方法中deny数组定义的action时 会自动跳转到此action.
     **/
    public function actionLogin()
    {
        DyRequest::redirect('/admin/home/login');
    }

    /**
     * 退出action.
     **/
    public function actionLogout()
    {
        DyTools::logs(Dy::app()->auth->username.'退出登录');
        Dy::app()->auth->logout();
        DyRequest::redirect('/admin/home/login');
    }

    /**
     * 框架规则-错误信息获取action  如config中不配制errorHandler此方法必须存在
     * 当访问出错时会自动调用此方法.
     * 若console,web类型放在同一项目下，建议在方法内按类型做不同处理，或使用不同的config文件设置不同的errorHandler
     **/
    public function actionError()
    {
        $errorInfo = $this->caParam;
        $this->forward('admin/home', 'error', $errorInfo);
    }

    /**
     * 框架规则-信息获取action  如config中不配制messageHandler此方法必须存在
     * 使用框架showMsg时会自动调用此方法.
     **/
    public function actionMessage()
    {
        $msgInfo = $this->caParam;
        $this->forward('admin/home', 'message', $msgInfo);
    }
}
