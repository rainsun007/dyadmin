<?php
/**
 * 管理后台父类.
 *
 * @author 大宇 Email:dyphp.com@gmail.com
 *
 * @link http://www.dyphp.com/
 *
 * @copyright Copyright 2016 dyphp.com
 **/
class AdminController extends Controller
{
    protected $allNeedLogin = true;
    protected $loginHandler = 'admin/login';

    //用户角色(id数组)
    public $userRoles = array();
    //用户权限(id数组)
    public $userPermissions = array();

    protected function init()
    {
        parent::init();
        $this->view->defaultTheme = 'admin';
        $this->view->defaultLayout = 'main';
    }

    protected function beforeAction()
    {
        $this->setUserInfo();
        if (!$this->userId || !$this->userInfo) {
            Common::msg('用户信息有误！', 'error');
        }
        if ($this->userInfo->status == 0) {
            Common::msg('账号已被禁用！', 0, 401);
        }
        $this->getNavAndPermissionsTree('type=0 and display=1 order by sort asc', 'nav');
        $this->getUserRoles();

        if (!common::checkPermit('/'.Dy::app()->module.'/'.Dy::app()->cid.'/'.Dy::app()->aid)) {
            Common::msg('你无权访问，没有操作权限！', 1, 403);
        }
    }

    /**
     * @brief    获取登录用户的角色(id数组)与权限(id数组)
     *
     * @return
     **/
    protected function getUserRoles()
    {
        if (!Dy::app()->auth->isGuest() && $this->userInfo->role_ids) {
            $this->userRoles = explode(',', $this->userInfo->role_ids);
            $permission = Role::model()->getAll("status=1 and id in({$this->userInfo->role_ids})", 'permission');
            foreach ($permission as $key => $value) {
                $this->userPermissions = array_unique(array_merge($this->userPermissions, explode(',', $value->permission)));
            }
        }

        $this->view->setData('userRoles', $this->userRoles);
        $this->view->setData('userPermissions', $this->userPermissions);
    }

    /**
     * @brief    获取管理后台导航与权限树
     *
     * @param    nav为获取导航 permission为获取权限
     * @param    是否获取隐藏数据 type为permission时有效
     *
     * @return
     **/
    protected function getNavAndPermissionsTree($criteria, $type = '')
    {
        $adminNav = Nav::model()->getAll($criteria);

        $classArr = array();
        foreach ($adminNav as $val) {
            $classArr[$val->id] = array(
                'id' => $val->id,
                'pid' => $val->pid,
                'name' => $val->name,
                'link' => $val->link,
                'icon' => $val->icon,
                'sort' => $val->sort,
                'type' => $val->type,
                'display' => $val->display,
                'sys' => $val->sys,
            );
        }
        $navTree = DyTools::treeFormat($classArr);

        if ($type == 'nav') {
            $this->view->setData('navTree', $navTree);
        }

        return $navTree;
    }
}
