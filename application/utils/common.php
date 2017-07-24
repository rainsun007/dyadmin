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
        if(DyRequest::isAjax()){
            $status = $status != 'success' || $status == 0 || $code != 200 ? 0 : 1;
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
        if (is_string($permitId) || $permitId === 0) {
            //获取缓存url与id的对应关系
            $cache = DyCache::invoke('default');
            $navInfo = $cache->get('all_nav_info');
            if (!$navInfo) {
                $nav = Nav::model()->getAll();
                $navInfo = array();
                foreach ($nav as $key => $value) {
                    if ($value->link) {
                        $navInfo[$value->link] = $value->id;
                    }
                }
                $cache->set('all_nav_info', $navInfo, CACHE_EXPIRE);
            }
            $link = $permitId === 0 ? '/'.Dy::app()->module.'/'.Dy::app()->cid.'/'.Dy::app()->aid : $permitId;
            $permitId = isset($navInfo[$link]) ? $navInfo[$link] : 0;
        }
        return DyPhpBase::app()->runingController->userId == 1 || in_array($permitId, DyPhpBase::app()->runingController->userPermissions) ? true : false;
    }

    /**
     * 访问log
     *
     * @return void
     */
    public static function accessLog(){
        $post = json_encode($_POST,JSON_UNESCAPED_UNICODE);
        DyTools::logs('user:'.Dy::app()->auth->username.' POST:'.$post);
    }

}
