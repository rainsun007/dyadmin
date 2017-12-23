<?php
/**
 * 公共类.
 *
 * @author 大宇 Email:dyphp.com@gmail.com
 *
 * @link http://www.dyphp.com/
 *
 * @copyright Copyright 2011 dyphp.com
 **/
class Common
{
    /**
     * @brief    提示信息
     *
     * @param   $module 'app','admin'
     * @param   $msg
     * @param   $status 'success','error','warning','info',1,0等，可自定义
     * @param   $link
     **/
    public static function msg($msg = '', $status = 'success', $code = 200, $data = array())
    {
        if (DyRequest::isAjax()) {
            $status = $status != 'success' || $status === 1 || $code != 200 ? 1 : 0;
            echo DyTools::apiJson($status, $code, $msg, $data);
            exit;
        }

        $callouts = array('success'=>'success','error'=>'danger','warning'=>'warning','info'=>'info',1=>'success',0=>'warning');
        $callout = isset($callouts[$status]) ? $callouts[$status] : 'info';
        Dy::showMsg(array('message' => $msg, 'status' => $status, 'code' => $code, 'data' => $data, 'callout' => $callout), true);
    }

    /**
     * @brief  权限判断
     *
     * @param  $permitId 导航及权限id（nav表的id值）
     *
     * @return bool true为有操作权限 false为无操作权限  超级管理员总是返回true
     **/
    public static function checkPermit($permitId = 0)
    {
        if ((is_string($permitId) && !is_numeric($permitId)) || $permitId === 0) {
            //获取缓存url与id的对应关系
            $cache = DyCache::invoke('default');
            $navInfo = $cache->get('all_nav_info');
            if (!$navInfo) {
                $nav = Nav::model()->getAll();
                $navInfo = array();
                foreach ($nav as $key => $value) {
                    if ($value->link) {
                        $navInfo[strtolower($value->link)] = $value->id;
                    }
                }
                $cache->set('all_nav_info', $navInfo, CACHE_EXPIRE);
            }
            $link = $permitId === 0 ? '/'.Dy::app()->module.'/'.Dy::app()->cid.'/'.Dy::app()->aid : $permitId;
            $link = strtolower($link);
            $permitId = isset($navInfo[$link]) ? $navInfo[$link] : 0;
        }
        return Dy::app()->runingController->userId == 1 || in_array($permitId, Dy::app()->runingController->userPermissions) ? true : false;
    }

    /**
     * 访问log
     *
     * @return void
     */
    public static function accessLog()
    {
        $post = json_encode($_POST, JSON_UNESCAPED_UNICODE);
        DyTools::logs('user:'.Dy::app()->auth->username.' POST:'.$post);
    }

    /**
     * 邮件发送
     *
     * @param array $users
     * @param string $subject
     * @param string $body
     * @return void
     */
    public static function sendMail($users = array(), $subject = '', $body = '')
    {
        Dy::app()->vendors('PHPMailer/PHPMailerAutoload', true);
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
            $mail->addAddress($value->email, $value->realname);
        }
        $mail->send();
    }
}
