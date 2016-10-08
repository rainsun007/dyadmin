<?php
/**
 * PermitController.
 *
 * @author 大宇 Email:dyphp.com@gmail.com
 *
 * @link http://www.dyphp.com/
 *
 * @copyright Copyright 2016 dyphp.com
 */
class PermitController extends AdminController
{
    /**
     * 权限管理.
     **/
    public function actionList()
    {
        $permissionTree = $this->getNavAndPermissionsTree('display=1 order by sort asc');
        $this->view->render('Setting/permit', compact('permissionTree'));
    }

    /**
     * 添加权限.
     **/
    public function actionAdd()
    {
        $name = DyRequest::postStr('name');
        if (empty($name)) {
            echo DyTools::apiJson(1, 403, '权限名不可为空');
            exit;
        }

        $data = array(
          'pid' => DyRequest::postInt('pid'),
          'name' => $name,
          'link' => DyRequest::postStr('link'),
          'type' => 1,
        );
        $result = Nav::model()->insert($data);
        echo $result ? DyTools::apiJson(0, 200, 'success', $result) : DyTools::apiJson(1, 500, 'failed', $result);
    }

    /**
     * 编辑权限.
     **/
    public function actionEdit()
    {
        $name = DyRequest::postStr('name');
        if (empty($name)) {
            echo DyTools::apiJson(1, 403, '权限名不可为空');
            exit;
        }
        $id = DyRequest::postInt('id');
        if ($id == 0) {
            echo DyTools::apiJson(1, 403, '请求数据有误！');
            exit;
        }

        $data = array(
          'name' => $name,
          'link' => DyRequest::postStr('link'),
        );
        $result = Nav::model()->update($data, "id={$id}");
        echo $result ? DyTools::apiJson(0, 200, 'success', $result) : DyTools::apiJson(1, 500, 'failed', $result);
    }

    /**
     * 删除权限.
     **/
    public function actionDel()
    {
        $id = DyRequest::postInt('id');
        if ($id == 0) {
            echo DyTools::apiJson(1, 403, '请求数据有误！');
            exit;
        }

        //系统权限不可删除
        $navInfo = Nav::model()->getById($id);
        if ($navInfo && $navInfo->sys == 1) {
            echo DyTools::apiJson(1, 403, '非法操作！');
            exit;
        }

        $result = Nav::model()->delete("id={$id} or pid={$id}");
        echo $result ? DyTools::apiJson(0, 200, 'success', $result) : DyTools::apiJson(1, 500, 'failed', $result);
    }
}
