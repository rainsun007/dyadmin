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
class HomeController extends AdminController
{
    protected $allNeedLogin = false;

    protected function needLogin()
    {
        return array('index');
    }

    protected function beforeAction()
    {
        if (Dy::app()->aid == 'index') {
            parent::beforeAction();
        }
    }

    /**
     * 系统看板.
     **/
    public function actionIndex()
    {
        //获取数据库大小及版本
        $dbLength = DyaMember::model()->getDataSize();
        $dbVersion = DyaMember::model()->getVersion();

        //获取上传许可最大值
        $fileUpload = ini_get('file_uploads') ? ini_get('upload_max_filesize') : 'off';

        //用户总数
        $userCount = DyaMember::model()->count();

        $this->view->render('index', compact('dbLength', 'dbVersion', 'fileUpload', 'userCount'));
    }

    /**
     * 当访问出错时会自动调用此方法.
     * 可在config中设置errorHandler.
     **/
    public function actionError()
    {
        $this->view->defaultLayout = 'simple';
        $error = $this->caParam;
        if (DyRequest::isAjax()) {
            echo json_encode($error);
        } else {
            $this->view->render('error', compact('error'),true);
        }
    }

    /**
     * 使用框架showMsg时会自动调用此方法.
     * 可在config中设置messageHandler.
     **/
    public function actionMessage()
    {
        $this->view->defaultLayout = 'simple';
        $message = $this->caParam;
        if (DyRequest::isAjax()) {
            echo json_encode($message);
        } else {
            $this->view->render('message', compact('message'),true);
        }
    }

    /**
     * 访问必须有登录态才可访问的方法时会直接跳转到此方法.
     **/
    public function actionLogin()
    {
        if (!Dy::app()->auth->isGuest()) {
            DyRequest::redirect('/admin/home/index');
        }

        $this->view->defaultLayout = 'simple';

        $loginError = 0;
        if (DyRequest::isPost()) {
            $username = DyRequest::postStr('username');
            $password = DyRequest::postStr('password');
            
            if (empty($username) || empty($password) || !DyFilter::isAccount($username)) {
                $loginError = 2;
                $this->view->render('login', compact('username', 'loginError'),true);
            }

            if (!Dy::app()->captcha->cookieCheck(DyRequest::postStr('captcha'), 'rc_adminlogin')) {
                $loginError = 1;
                $this->view->render('login', compact('username', 'loginError'),true);
            }

            $authenticate = Dy::app()->auth->adminLogin($username, $password);
            if (Dy::app()->auth->userInfo && Dy::app()->auth->userInfo->pw_err_num >= PW_ERR_MAX_NUM) {
                DyTools::logs($username.'登录密码错误过多被禁用');
                $loginError = 4;
                $this->view->render('login', compact('username', 'loginError'),true);
            }
           
            if ($authenticate) {
                if (Dy::app()->auth->userInfo->pw_err_num > 0) {
                    DyaMember::model()->update(array('pw_err_num'=>0), 'id='.Dy::app()->auth->userInfo->id);
                }
                DyaMember::model()->update(array('last_op_time'=>date('Y-m-d H:i:s', time())), 'id='.Dy::app()->auth->userInfo->id);

                DyTools::logs($username.'登录系统成功');
                DyRequest::redirect('/admin/home/index');
            } else {
                if (Dy::app()->auth->userInfo) {
                    DyaMember::model()->incr(array('pw_err_num'=>1), 'id='.Dy::app()->auth->userInfo->id);
                }
                DyTools::logs($username.'登录系统失败');
                $loginError = 3;
                $this->view->render('login', compact('username', 'loginError'),true);
            }
        }

        $this->view->render('login', compact('loginError'),true);
    }
}
