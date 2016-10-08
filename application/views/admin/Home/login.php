<div class="login-box">
  <div class="login-logo">
    <a href="#"><?php echo DyCfg::item('appName'); ?></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">
      <?php if (!empty($password) || !empty($username)):?>
      <div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          用户名或密码不正确
      </div>
      <?php endif; ?>
    </p>

    <form action="/admin/home/login" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" value="<?php echo $username; ?>" class="form-control" id="inputWarning" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">登 录</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
