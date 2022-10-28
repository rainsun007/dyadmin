<?php
/**
 * 项目父类
 *
 * @author QingYu.Sun Email:dyphp.com@gmail.com
 * @copyright dyphp.com
 * @link http://www.dyphp.com
 **/

Dy::app()->import('app.func.functions');

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
