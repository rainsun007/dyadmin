<?php $this->pageTitle = '登录系统'?>

<div class="login-box" style="margin-top:-100px;">
  <div class="login-logo">
    <span style="color:#FFF;">
      <?php echo DyCfg::item('appName'); ?>
    </span>
  </div>

  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">
      <?php if ($loginError > 0):?>
      <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php 
            $loginErrorArr = array(1=>'验证码错误',2=>'用户密码不可为空',3=>'登录失败',4=>'账号不可用');
            echo $loginErrorArr[$loginError];
        ?>
      </div>
      <?php endif; ?>
    </p>

    <form action="<?php echo DyRequest::createUrl('/admin/home/login');?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" value="<?php echo isset($username) ? $username : ''; ?>" class="form-control" id="inputWarning" placeholder="Username">
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="captcha" value="" class="form-control" style="width:100px;float:left" placeholder="验证码">
        <span style="width:200px;float:right">
          <?php $this->widget('DyCaptchaWidget', array('request'=>DyRequest::createUrl('/admin/home/captcha', array('ct'=>'adminlogin')),'buttonLabel'=>'换一个')); ?>
        </span>
      </div>
      <div class="row">
        <div class="col-xs-8"></div>
        <div class="col-xs-4" style="margin-top:18px">
          <button type="submit" class="btn btn-primary btn-block btn-flat">登 录</button>
        </div>
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->