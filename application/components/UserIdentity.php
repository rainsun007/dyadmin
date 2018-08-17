<?php
/**
 * 用户认证类
 * 框架规则-此文件为特殊文件 此类必须存在 无此类将报错.
 *
 * @author 大宇 Email:dyphp.com@gmail.com
 * @link http://www.dyphp.com/
 * @copyright Copyright dyphp.com
 */
class UserIdentity extends DyPhpUserIdentity
{
    //使用cookie保存登陆状态及setInfo
    protected $isCookieUserAuth = true;

    //用户信息
    public $userInfo = null;

    /**
     * 框架规则-必须实现此认证方法.
     *
     * @param string 用户身份索引值,如：id,email,电话,用户名,昵称等
     * @param string 加密后的密码
     *
     * @return bool
     **/
    public function authenticate($userIndexValue = '', $encryptPassword = '' , $autoLoginExpire = 0)
    {
        $userInfo = DyaMember::model()->getOne("username='{$userIndexValue}'");
        if (!$userInfo) {
            return false;
        }
        $this->userInfo = $userInfo;
        
        if ($userInfo->password != $encryptPassword) {
            return false;
        }

        //设置全局用户信息
        $this->setInfo('uid', $userInfo->id);
        $this->setInfo('username', $userInfo->username);
        
        //该方法必须调用 否则没有登陆状态
        return $this->setLoginStatus($userIndexValue, $encryptPassword, $autoLoginExpire);
    }

    /**
     * app中调用登陆使用.
     *
     * @param string 用户名
     * @param string 密码
     *
     * @return bool
     **/
    public function adminLogin($username = '', $password = '')
    {
        if (empty($username) || empty($password)) {
            return false;
        }

        return $this->authenticate($username,md5($password),86400*7);
    }
}
