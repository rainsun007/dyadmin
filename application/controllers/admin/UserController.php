<?php
/**
 * UserController.
 *
 * @author 大宇 Email:dyphp.com@gmail.com
 *
 * @link http://www.dyphp.com/
 *
 * @copyright Copyright 2016 dyphp.com
 */
class UserController extends AdminController
{
    /**
     * 用户列表.
     **/
    public function actionList()
    {
        $uId = DyRequest::getInt('id');
        $uInfo = array();
        if ($uId > 0) {
            $uInfo = User::model()->getById($uId);
        }

        $pageSize = 20;
        $criteria = Dy::app()->dbc->select()->order('id', 'ASC');
        $data = User::model()->getAllForPage($criteria, $pageSize);
        $listData = $data['data'];
        $pageWidgetOptions = array(
            'count' => $data['count'],
            'pageSize' => $pageSize,
            'offset' => 3,
            'paramName' => 'page',
        );

        $roles = Role::model()->getAll('status=1');

        $this->view->render('Setting/user', compact('listData', 'pageWidgetOptions', 'roles', 'uInfo', 'uId'));
    }

    /**
     * 添加用户.
     **/
    public function actionAdd()
    {
        $name = DyRequest::postStr('username');
        if (empty($name) || !DyFilter::isAccount($name)) {
            echo DyTools::apiJson(1, 403, '用户名不可为空,且必须为字母开头的字母与数字的组合，长度为5~16个字符');
            exit;
        }

        $uInfo = User::model()->getOne("username='{$name}'");
        if ($uInfo) {
            echo DyTools::apiJson(1, 403, '用户名已经存在');
            exit;
        }

        $data = array(
          'username' => $name,
          'password' => md5(DyRequest::postStr('password')),
          'email' => DyRequest::postStr('email'),
          'realname' => DyRequest::postStr('realname'),
          'status' => DyRequest::postStr('status') == 'true' ? 1 : 0,
          'role_ids' => trim(DyRequest::postStr('roles'), ','),
          'create_time' => $this->datetime,
        );
        $result = User::model()->insert($data);
        echo $result ? DyTools::apiJson(0, 200, '用户创建成功', $result) : DyTools::apiJson(1, 500, '用户创建失败', $result);
    }

    /**
     * 编辑用户.
     **/
    public function actionEdit()
    {
        $name = DyRequest::postStr('username');
        if (empty($name) || !DyFilter::isAccount($name)) {
            echo DyTools::apiJson(1, 403, '用户名不可为空,且必须为字母开头的字母与数字的组合，长度为5~16个字符');
            exit;
        }

        $id = DyRequest::postInt('id');
        if ($id == 0) {
            echo DyTools::apiJson(1, 403, '请求数据有误！');
            exit;
        }

        //其它用户无权编辑超级管理员
        if ($id == 1 && $this->userId != 1) {
            DyTools::logs(Dy::app()->auth->username.'越权访问被拦截-编辑超级管理员','warning');
            echo DyTools::apiJson(1, 403, '无权操作！');
            exit;
        }

        $uInfo = User::model()->getOne("username='{$name}'");
        if (isset($uInfo->id) && $uInfo->id != $id) {
            echo DyTools::apiJson(1, 403, '用户名已经存在');
            exit;
        }

        $data = array(
          'username' => $name,
          'email' => DyRequest::postStr('email'),
          'realname' => DyRequest::postStr('realname'),
          'status' => $id == 1 ? 1 : (DyRequest::postStr('status') == 'true' ? 1 : 0),
          'role_ids' => $id == 1 ? 1 : trim(DyRequest::postStr('roles'), ','),
        );
        if (DyRequest::postStr('password')) {
            $data['password'] = md5(DyRequest::postStr('password'));
        }
        $result = User::model()->update($data, "id={$id}");
        echo $result ? DyTools::apiJson(0, 200, '用户编辑成功', $result) : DyTools::apiJson(1, 500, '用户编辑失败', $result);
    }

    /**
     * 用户个人信息自己修改.
     **/
    public function actionUserEdit()
    {
        $data = array(
          'email' => DyRequest::postStr('email'),
          'realname' => DyRequest::postStr('realname'),
        );
        if (DyRequest::postStr('password')) {
            $data['password'] = md5(DyRequest::postStr('password'));
        }
        $result = User::model()->update($data, "id={$this->userId}");
        echo $result ? DyTools::apiJson(0, 200, '编辑成功', $result) : DyTools::apiJson(1, 500, '编辑失败', $result);
    }

    /**
     * 删除用户.
     **/
    public function actionDel()
    {
        $id = DyRequest::postInt('id');
        if ($id == 0) {
            echo DyTools::apiJson(1, 403, '请求数据有误！');
            exit;
        }

        //超级管理员不可被删除
        if ($id == 1) {
            echo DyTools::apiJson(1, 403, '非法操作！');
            exit;
        }

        $result = User::model()->delete("id={$id}");
        echo $result ? DyTools::apiJson(0, 200, '用户删除成功', $result) : DyTools::apiJson(1, 500, '用户编辑成功', $result);
    }
}
