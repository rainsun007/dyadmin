<?php
/**
 * @file Controller.php
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
class Controller extends DyPhpController
{
    protected $allNeedLogin = false;

    public $userInfo = null;
    public $userId = 0;

    protected function init()
    {
        Dy::app()->vendors('PHPMailer/PHPMailerAutoload',true);
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
        $captchaArr = array('login');
        if (!in_array($captchaType, $captchaArr)) {
            exit('captcha error');
        }

        $cap = Dy::app()->captcha;
        $cap->saveName = 'rc_'.$captchaType;
        $cap->background = 'rand'; //'rand'  'bg4.png'  array(100,255,255)
        $cap->waveWord = false;
        $cap->saveType = 'cookie';
        $cap->expire = 300;
        $cap->model = 0;
        $cap->format = 'png';
        $cap->scale = 2;
        //$cap->maxRotation = 20;
        $cap->noiseLine = 0;
        $cap->noise = 0;
        $cap->fonts = array(array('spacing' => -2, 'minSize' => 24, 'maxSize' => 30, 'font' => 'AHGBold.ttf'));
        $cap->colors = array(array(27, 78, 181));
        $cap->createImage();
        exit;
    }

     protected function sendMail($users = array(), $subject = '', $body = ''){
        $mail = new PHPMailer;

        $mail->CharSet = "UTF-8";
        //$mail->SMTPDebug = 3;                               // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = MAIL_SMTP;  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = MAIL_USERNAME;                 // SMTP username
        $mail->Password = MAIL_PASSWORD;                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

        $mail->setFrom(MAIL_USERNAME, MAIL_FROM_NAME);

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body = $body;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $usersInfo = User::model()->getUsers($users);
        foreach ($usersInfo as $key => $value) {
            $mail->addAddress($value->email,$value->realname); 
        }
        $mail->send();
    }
}
