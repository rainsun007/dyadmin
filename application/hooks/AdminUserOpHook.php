<?php

/**
 * 操作超时
 * @author 大宇 Email:dyphp.com@gmail.com
 * @link http://www.dyphp.com/
 * @copyright Copyright dyphp.com
 **/
class AdminUserOpHook extends DyPhpHooks
{
    /**
     * 对登录成功的用户记录最后操作时间
     * 操作超时自动退出登录
     *
     * @return void
     */
    public function userOpTime()
    {
        if (!Dy::app()->auth->isGuest()){
            $userId = Dy::app()->auth->uid;
            $userInfo = DyaMember::model()->getById($userId);
            if (time() - strtotime($userInfo->last_op_time) > USER_OP_TIMEOUT) {
                DyRequest::redirect('/app/logout',array('m'=>'admin'));
            } else {
                DyaMember::model()->update(array('last_op_time'=>date('Y-m-d H:i:s', time())), "id={$userId}");
            }
        }
    }
}
