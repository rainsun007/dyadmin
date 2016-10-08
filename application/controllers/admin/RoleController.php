<?php
/**
 * RoleController.
 *
 * @author 大宇 Email:dyphp.com@gmail.com
 *
 * @link http://www.dyphp.com/
 *
 * @copyright Copyright 2016 dyphp.com
 */
class RoleController extends AdminController
{
    /**
     * 角色管理.
     **/
    public function actionList()
    {
        $roleId = DyRequest::getInt('id');
        $roleInfo = array();
        if ($roleId > 0) {
            $roleInfo = Role::model()->getById($roleId);
        }
        $listData = Role::model()->getAll();
        $permissionTree = $this->getNavAndPermissionsTree('display=1 order by sort asc');

        $this->view->render('Setting/role', compact('listData', 'permissionTree', 'roleInfo', 'roleId'));
    }

    /**
     * 添加角色.
     **/
    public function actionAdd()
    {
        $name = DyRequest::postStr('name');
        if (empty($name)) {
            echo DyTools::apiJson(1, 403, '角色名不可为空');
            exit;
        }
        $data = array(
          'name' => $name,
          'permission' => trim(DyRequest::postStr('permission'), ','),
          'create_time' => $this->datetime,
          'status' => DyRequest::postStr('status') == 'true' ? 1 : 0,
        );
        $result = Role::model()->insert($data);
        echo $result ? DyTools::apiJson(0, 200, '角色创建成功', $result) : DyTools::apiJson(1, 500, '角色创建失败', $result);
    }

    /**
     * 编辑角色.
     **/
    public function actionEdit()
    {
        $name = DyRequest::postStr('name');
        if (empty($name)) {
            echo DyTools::apiJson(1, 403, '角色名不可为空');
            exit;
        }
        $id = DyRequest::postInt('id');
        if ($id == 0) {
            echo DyTools::apiJson(1, 403, '请求数据有误！');
            exit;
        }

        $data = array(
          'name' => $name,
          'status' => DyRequest::postStr('status') == 'true' ? 1 : 0,
          'permission' => trim(DyRequest::postStr('permission'), ','),
        );
        $result = Role::model()->update($data, "id={$id}");
        echo $result ? DyTools::apiJson(0, 200, '角色编辑成功', $result) : DyTools::apiJson(1, 500, '角色编辑失败', $result);
    }

    /**
     * 删除角色.
     **/
    public function actionDel()
    {
        $id = DyRequest::postInt('id');
        if ($id == 0) {
            echo DyTools::apiJson(1, 403, '请求数据有误！');
            exit;
        }
        $result = Role::model()->delete("id={$id}");
        echo $result ? DyTools::apiJson(0, 200, '角色删除成功', $result) : DyTools::apiJson(1, 500, '角色编辑成功', $result);
    }
}
