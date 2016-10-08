<?php
/**
 * NavController.
 *
 * @author 大宇 Email:dyphp.com@gmail.com
 *
 * @link http://www.dyphp.com/
 *
 * @copyright Copyright 2016 dyphp.com
 */
class NavController extends AdminController
{
    /**
     * 菜单管理.
     **/
    public function actionList()
    {
        $permissionTree = $this->getNavAndPermissionsTree('type=0 order by sort asc');
        $this->view->render('Setting/nav', compact('permissionTree'));
    }

    /**
     * 添加菜单.
     **/
    public function actionAdd()
    {
        $name = DyRequest::postStr('name');
        if (empty($name)) {
            echo DyTools::apiJson(1, 403, '菜单名不可为空');
            exit;
        }

        $pid = DyRequest::postInt('pid');
        if ($pid > 0) {
            echo DyTools::apiJson(1, 403, '二级导航不可创建子导航');
            exit;
        }

        $data = array(
          'pid' => $pid,
          'name' => $name,
          'link' => DyRequest::postStr('link'),
          'icon' => DyRequest::postStr('icon'),
          'sort' => DyRequest::postInt('sort'),
          'display' => DyRequest::postStr('display') == 'true' ? 1 : 0,
        );
        $result = Nav::model()->insert($data);
        echo $result ? DyTools::apiJson(0, 200, 'success', $result) : DyTools::apiJson(1, 500, 'failed', $result);
    }

    /**
     * 添加菜单.
     **/
    public function actionEdit()
    {
        $name = DyRequest::postStr('name');
        if (empty($name)) {
            echo DyTools::apiJson(1, 403, '菜单名不可为空');
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
          'icon' => DyRequest::postStr('icon'),
          'sort' => DyRequest::postInt('sort'),
          'display' => DyRequest::postStr('display') == 'true' ? 1 : 0,
        );
        $result = Nav::model()->update($data, "id={$id}");
        echo $result ? DyTools::apiJson(0, 200, 'success', $result) : DyTools::apiJson(1, 500, 'failed', $result);
    }

    /**
     * 删除导航.
     **/
    public function actionDel()
    {
        $id = DyRequest::postInt('id');
        if ($id == 0) {
            echo DyTools::apiJson(1, 403, '请求数据有误！');
            exit;
        }

        //系统导航不可删除
        $navInfo = Nav::model()->getById($id);
        if ($navInfo && $navInfo->sys == 1) {
            echo DyTools::apiJson(1, 403, '非法操作！');
            exit;
        }

        $result = Nav::model()->delete("id={$id} or pid={$id}");
        echo $result ? DyTools::apiJson(0, 200, 'success', $result) : DyTools::apiJson(1, 500, 'failed', $result);
    }

    /**
     * 更新导航排序.
     **/
    public function actionUpsort()
    {
        $id = DyRequest::postInt('id');
        $sort = DyRequest::postInt('sort');
        $result = Nav::model()->update(array('sort' => $sort), "id={$id}");
        echo $result ? DyTools::apiJson(0, 200, 'success', $result) : DyTools::apiJson(1, 500, 'failed', $result);
    }
}
