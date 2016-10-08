<?php
/**
 * 用户认证类
 * 框架规则-此文件为特殊文件 此类必须存在 无此类将报错.
 *
 * @author 大宇 Email:dyphp.com@gmail.com
 *
 * @link http://www.dyphp.com/
 *
 * @copyright Copyright 2011 dyphp.com
 */
class UserIdentity extends DyPhpUserIdentity
{
    //用户信息
    private $userInfo = null;
    //使用cookie保存登陆状态及setInfo
    protected $isCookieUserAuth = true;

    /**
     * 框架规则-必须实现此认证方法 框架用调用此方法处理自动登陆.
     *
     * @param string 加密后的密码（如md5('password')等,保持加密一至即可）,基于安全考虑此处不要使用密码明文
     * @param int    自动登陆有效期 0为浏览器session 单位：秒
     *
     * @return bool|object
     **/
    public function authenticate($expire = 0, $encryptPassword = '')
    {
        if (!$this->userInfo) {
            $userId = $this->getUserIndexValue();
            if (!empty($userId)) {
                $this->userInfo = User::model()->getOne("id={$userId}");
            }
            if (!$this->userInfo) {
                return false;
            }
        }

        if ($encryptPassword == '' || $this->userInfo->password != $encryptPassword) {
            return false;
        }

        //设置全局用户信息
        Dy::app()->auth->setInfo('uid', $this->userInfo->id);
        Dy::app()->auth->setInfo('username', $this->userInfo->username);

        //该方法必须调用 否则没有登陆状态
        $this->setStatus($this->userInfo->id, $expire);

        return $this->userInfo;
    }

    /**
     * app中调用登陆使用.
     *
     * @param string 用户名
     * @param string 密码
     * @param bool   是否下次自动登陆
     * @param int    自动登陆有效期 单位：秒
     *
     * @return bool|object
     **/
    public function login($username = '', $password = '', $expire = 0)
    {
        if (empty($username) || empty($password)) {
            return false;
        }
        $this->userInfo = User::model()->getOne("username='$username'");

        return $this->authenticate($expire, md5($password));
    }
}
