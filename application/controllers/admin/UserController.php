<?php

/**
 * UserController.
 *
 * @author 大宇 Email:dyphp.com@gmail.com
 *
 * @link http://www.dyphp.com/
 *
 * @copyright Copyright dyphp.com
 */
class UserController extends AdminController
{
    /**
     * 管理员查看用户列表.
     **/
    public function actionList()
    {
        $uId = DyRequest::getInt('id');
        $uInfo = array();
        if ($uId > 0) {
            $uInfo = DyaMember::model()->getById($uId);
        }

        $pageSize = 20;
        $criteria = Dy::app()->dbc->select()->order('status', 'DESC')->order('id', 'ASC');
        $data = DyaMember::model()->getAllForPage($criteria, $pageSize);
        $listData = $data['data'];
        $pageWidgetOptions = array(
            'count' => $data['count'],
            'pageSize' => $pageSize,
            'offset' => 3,
            'paramName' => 'page',
        );

        $roles = DyaRole::model()->getAll('status=1');


        $this->view->render('Setting/user/list', compact('listData', 'pageWidgetOptions', 'roles', 'uInfo', 'uId'));
    }

    /**
     * 管理员添加用户.
     **/
    public function actionAdd()
    {
        if (DyRequest::isGet()) {
            $roles = DyaRole::model()->getAll('status=1');
            $this->view->render('Setting/user/add', compact('roles'), true);
        }

        $name = DyRequest::postStr('username');
        if (empty($name) || !DyFilter::isAccount($name)) {
            echo DyTools::apiJson(1, 403, '用户名不可为空,且必须为字母开头的字母与数字的组合，长度为5~16个字符');
            exit;
        }

        $uInfo = DyaMember::model()->getOne("username='{$name}'");
        if ($uInfo) {
            echo DyTools::apiJson(1, 403, '用户名已经存在');
            exit;
        }

        $data = array(
            'username' => $name,
            'password' => md5(DyRequest::postStr('password')),
            'email' => DyRequest::postStr('email'),
            'phone' => DyRequest::postStr('phone'),
            'realname' => DyRequest::postStr('realname'),
            'status' => DyRequest::postStr('status') == 'true' ? 1 : 0,
            'role_ids' => trim(DyRequest::postStr('roles'), ','),
            'create_time' => $this->datetime,
            'last_op_time' => $this->datetime,
        );
        $result = DyaMember::model()->insert($data);
        echo $result ? DyTools::apiJson(0, 200, '用户创建成功', $result) : DyTools::apiJson(1, 500, '用户创建失败', $result);
    }

    /**
     * 管理员编辑用户.
     **/
    public function actionEdit()
    {

        //加载编辑页面
        if (DyRequest::isGet()) {
            $id = DyRequest::getInt('id');
            $uInfo = DyaMember::model()->getById($id);

            if ($id <= 1 || !$uInfo) {
                Common::msg('用户ID不合法，请求有误！', 'error', 401);
            }

            $roles = DyaRole::model()->getAll('status=1');
            $this->view->render('Setting/user/edit', compact('roles', 'uInfo'), true);
        }

        //超级管理员不可以被編輯
        $id = DyRequest::postInt('id');
        if ($id <= 1) {
            DyTools::apiJson(1, 403, '请求数据有误！', '', true);
        }

        $name = DyRequest::postStr('username');
        if (empty($name) || !DyFilter::isAccount($name)) {
            DyTools::apiJson(1, 403, '用户名不可为空,且必须为字母开头的字母与数字的组合，长度为5~16个字符', '', true);
        }

        $uInfo = DyaMember::model()->getOne("username='{$name}'");
        if (isset($uInfo->id) && $uInfo->id != $id) {
            DyTools::apiJson(1, 403, '用户名已经存在', '', true);
        }

        $data = array(
            'username' => $name,
            'email' => DyRequest::postStr('email'),
            'phone' => DyRequest::postStr('phone'),
            'realname' => DyRequest::postStr('realname'),
            'status' => $id == 1 ? 1 : (DyRequest::postStr('status') == 'true' ? 1 : 0),
            'role_ids' => $id == 1 ? 1 : trim(DyRequest::postStr('roles'), ','),
        );

        //重置密碼，重置密碼同時會解除賬號鎖定狀態
        if (DyRequest::postStr('password')) {
            $data['password'] = md5(DyRequest::postStr('password'));
            $data['pw_err_num'] = 0; //解除账号锁定状态
        }

        $result = DyaMember::model()->update($data, "id={$id}");
        $result ? DyTools::apiJson(0, 200, '用户编辑成功', $result, true) : DyTools::apiJson(1, 500, '用户编辑失败', $result, true);
    }

    /**
     * 管理员删除用户.
     **/
    public function actionDel()
    {
        //超级管理员不可被删除
        $id = DyRequest::postInt('id');
        if ($id <= 1) {
            DyTools::apiJson(1, 403, '请求数据有误！', '', true);
        }

        $result = DyaMember::model()->delete("id={$id}");
        $result ? DyTools::apiJson(0, 200, '用户删除成功', $result, true) : DyTools::apiJson(1, 500, '用户编辑成功', $result, true);
    }

    /**
     * 用户自己修改个人信息.
     **/
    public function actionUserEdit()
    {
        $data = array(
            'email' => DyRequest::postStr('email'),
            'phone' => DyRequest::postStr('phone'),
            'realname' => DyRequest::postStr('realname'),
        );
        if (empty($data['email']) || empty($data['realname']) || empty($data['phone'])) {
            echo DyTools::apiJson(1, 403, '真实姓名,邮箱地址,电话都不可为空！');
            exit;
        }
        if (DyRequest::postStr('password')) {
            $data['password'] = md5(DyRequest::postStr('password'));
        }
        $result = DyaMember::model()->update($data, "id={$this->userId}");
        echo $result ? DyTools::apiJson(0, 200, '编辑成功', $result) : DyTools::apiJson(1, 500, '编辑失败', $result);
    }

    /**
     * 用户自己修改头像
     *
     */
    public function actionFaceUp()
    {
        $savePath = APP_PARENT_PATH . '/upload/face';
        $upPic = DyGDImg::upload('file', $savePath, $this->userId);
        if ($upPic == 0) {
            $info = DyGDImg::resize($savePath . '/' . DyGDImg::getFileSaveName(), '', '', 100, 100);
            DyaMember::model()->update(array('avatar' => '/upload/face/' . $info['name']), "id={$this->userId}");
            echo DyTools::apiJson(0, 200, '头像上传成功', '/upload/face/' . $info['name']);
        } else {
            echo DyTools::apiJson(1, 500, '头像上传失败');
        }
    }
}
