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
class common
{
    /**
     * @brief    提示信息
     *
     * @param   $module 'app','admin'
     * @param   $msg
     * @param   $status 'success','error','warning','info',1,0
     * @param   $link
     **/
    public static function msg($msg = '', $status = 'success', $code = 200, $data = array())
    {
        Dy::showMsg(array('message' => $msg, 'status' => $status, 'code' => $code, 'data' => $data), true);
    }

    /**
     * @brief  权限判断
     *
     * @param  $permitId 导航及权限id（nav表的id值）或连接（nav表的link值）
     *
     * @return bool true为有操作权限 false为无操作权限  超级管理员总是返回true
     **/
    public static function checkPermit($permitId = 0)
    {
        if (!is_numeric($permitId)) {
            $navInfo = Nav::model()->getOne("link='{$permitId}'");
            $permitId = isset($navInfo->id) ? $navInfo->id : 0;
        }

        return DyPhpBase::app()->runingController->userId == 1 || in_array($permitId, DyPhpBase::app()->runingController->userPermissions) ? true : false;
    }
}
