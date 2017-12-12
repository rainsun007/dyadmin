<?php
/**
 * @file BaseController.php
 * @brief 项目父类
 *
 * @author QingYu.Sun Email:dyphp.com@gmail.com
 *
 * @version 1.0
 *
 * @copyright dyphp.com
 *
 * @link http://www.dyphp.com
 * @date 2016-04-12
 **/
class BaseController extends DyPhpController
{
    protected $allNeedLogin = false;

    public $userInfo = null;
    public $userId = 0;

    protected function init()
    {
    }

    protected function beforeAction()
    {
    }

    /**
     * @brief    设置当前登陆用户信息
     *
     * @return
     **/
    protected function setUserInfo()
    {
        $this->userId = Dy::app()->auth->uid;
        $this->userInfo = User::model()->getById($this->userId);
        $this->view->setData('userInfo', $this->userInfo);
    }

    /**
     * 验证码生成器.
     **/
    public function actionCaptcha()
    {
        $captchaType = DyRequest::getStr('ct');
        $captchaArr = array('adminlogin');
        if (!in_array($captchaType, $captchaArr)) {
            exit('captcha error');
        }

        $cap = Dy::app()->captcha;
        $cap->saveType = 'cookie';
        $cap->saveName = 'rc_'.$captchaType;
        $cap->width = 140;
        $cap->height = 35;
        $cap->wordLength = array(4,5);
        $cap->background = 'rand';
        $cap->waveWord = false;
        $cap->expire = 300;
        $cap->model = 2;
        $cap->format = 'png';
        $cap->scale = 2;
        $cap->maxRotation = 5;
        $cap->noiseLine = 5;
        $cap->noise = 15;
        $cap->fonts = array(array('spacing' => rand(5, -2), 'minSize' => 19, 'maxSize' => 25, 'font' => 'AHGBold.ttf'));
        //$cap->colors = array(array(27, 78, 181));
        $cap->createImage();
        exit;
    }
}
