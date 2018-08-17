<?php
/**
 * 管理后台父类.
 *
 * @author 大宇 Email:dyphp.com@gmail.com
 * @link http://www.dyphp.com/
 * @copyright Copyright dyphp.com
 **/
class AdminController extends BaseController
{
    protected $allNeedLogin = true;
    protected $loginHandler = 'admin/home/login';

    //用户角色(id数组)
    public $userRoles = array();

    //用户权限(id数组)
    public $userPermissions = array();

    public $cache = null;

    protected function init()
    {
        parent::init();
        $this->cache = DyCache::invoke('default');
        $this->view->defaultTheme = 'admin';
        $this->view->defaultLayout = 'main';
    }

    protected function beforeAction()
    {
        $this->setUserInfo();
        if (!$this->userId || !$this->userInfo) {
            Common::msg('用户信息有误！', 'error',401);
        }
        if ($this->userInfo->status == 0) {
            Common::msg('账号已经被禁用，请联系管理员！', 'warning', 401);
        }
        if ($this->userInfo->pw_err_num >= PW_ERR_MAX_NUM) {
            Common::msg('账号不可用，请联系管理员！', 'warning', 401);
        }

        $this->getNavAndPermissionsTree('type=0 and display=1 order by sort asc', 'nav');
        $this->getUserRoles();

        if (!Common::checkPermit()) {
            DyTools::logs(Dy::app()->auth->username.'越权访问被拦截','warning');
            Common::msg('你无权访问，没有操作权限！', 'warning', 403);
        }
        Common::accessLog();
    }

    /**
     * 设置当前登陆用户信息
     **/
    protected function setUserInfo()
    {
        $this->userId = Dy::app()->auth->uid;
        $this->userInfo = DyaMember::model()->getById($this->userId);
        $this->view->setData('userInfo', $this->userInfo);
    }

    /**
     * 获取登录用户的角色(id数组)与权限(id数组)
     **/
    protected function getUserRoles()
    {
        $userRolesName = array();
        if (!Dy::app()->auth->isGuest() && $this->userInfo->role_ids) {
            $this->userRoles = explode(',', $this->userInfo->role_ids);
            $permission = DyaRole::model()->getAll("status=1 and id in({$this->userInfo->role_ids})", 'permission,name,id');
            foreach ($permission as $key => $value) {
                $userRolesName[] = $value->name;
                $this->userPermissions = array_unique(array_merge($this->userPermissions, explode(',', $value->permission)));
            }
        }
        $this->view->setData('userRoles', $this->userRoles);
        $this->view->setData('userRolesName', $userRolesName);
        $this->view->setData('userPermissions', $this->userPermissions);
    }

    /**
     * 获取管理后台导航与权限树
     *
     * @param string 查询条件
     * @param string 为nav时向view层发送数据
     *
     * @return array
     **/
    protected function getNavAndPermissionsTree($criteria, $type = '')
    {
        $key = md5($criteria.$type);
        $navTree = $this->cache->get($key);
        if (!$navTree) {
            $adminNav = DyaNav::model()->getAll($criteria);

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
            $this->cache->set($key, $navTree, CACHE_EXPIRE);
        }

        if ($type == 'nav') {
            $this->view->setData('navTree', $navTree);
        }

        return $navTree;
    }
}
