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
    //使用cookie保存登陆状态及setInfo
    protected $isCookieUserAuth = true;

    private $username = null;

    /**
     * 框架规则-必须实现此认证方法 框架用调用此方法处理自动登陆.
     *
     * @param int    自动登陆有效期 0为浏览器session 单位：秒
     * @param string 用户验证加密串，如加密后的密码（如md5('password')等,保持加密一至即可）
     *               虽不强制但基于安全考虑此处最好不要使用明文（相关校验逻辑在实现方法中完成），
     *               需要注意的是框架调用此方法时此参数为空字
     *
     * @return bool|object
     **/
    public function authenticate($expire = 0, $encryptPassword = '')
    {
        $username = $this->username ? $this->username : $this->getUserIndexValue();
        if ($username) {
            $userInfo = User::model()->getOne("username='{$username}'");
            if (!$userInfo) {
                return false;
            }
        }

        //此处完成用户合法性校验（密码是否正确），兼容了框架自动调用，一般来说此逻辑不用修改
        if (!$this->getUserIndexValue() && ($encryptPassword == '' || $userInfo->password != $encryptPassword)) {
            return false;
        }

        //设置全局用户信息
        Dy::app()->auth->setInfo('uid', $userInfo->id);
        Dy::app()->auth->setInfo('username', $userInfo->username);

        //该方法必须调用 否则没有登陆状态
        $this->setStatus($userInfo->username, $expire);

        return $userInfo;
    }

    /**
     * app中调用登陆使用.
     *
     * @param string 用户名
     * @param string 密码
     * @param int    自动登陆有效期 单位：秒
     *
     * @return bool|object
     **/
    public function login($username = '', $password = '', $expire = 0)
    {
        if (empty($username) || empty($password)) {
            return false;
        }
        $this->username = $username;

        return $this->authenticate($expire, md5($password));
    }
}
