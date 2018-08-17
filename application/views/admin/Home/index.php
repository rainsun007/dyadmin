<?php $this->pageTitle = '系统看板'?>

<!-- Info boxes -->
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua">
        <i class="fa fa-upload"></i>
      </span>
      <div class="info-box-content">
        <span class="info-box-text">文件上传限制</span>
        <span class="info-box-number">
          <?php echo $fileUpload; ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red">
        <i class="fa fa-code-fork"></i>
      </span>

      <div class="info-box-content">
        <span class="info-box-text">Mysql数据库版本</span>
        <span class="info-box-number">
          <?php echo $dbVersion; ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- fix for small devices only -->
  <div class="clearfix visible-sm-block"></div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green">
        <i class="fa fa-database"></i>
      </span>

      <div class="info-box-content">
        <span class="info-box-text">Mysql数据库大小</span>
        <span class="info-box-number">
          <?php echo $dbLength; ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow">
        <i class="fa fa-users"></i>
      </span>

      <div class="info-box-content">
        <span class="info-box-text">后台用户总数</span>
        <span class="info-box-number">
          <?php echo $userCount; ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <section class="col-md-6" style="margin-top:15px">
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">说明</h3>
        <div class="box-tools pull-right">
        </div>
      </div>

      <div class="box-body">
          <div class="form-group">
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <td class="col-md-12"><a href="http://www.dyphp.com" target="_blank" class="text-light-blue">DyAdmin</a>是php+mysql开发的基于角色的管理后台系统</td>
                  </tr>
                  <tr>
                    <td class="col-md-12">php版本要求5.3及以上</td>
                  </tr>
                  <tr>
                    <td class="col-md-12">此系统为开源系统,可免费使用</td>
                  </tr>
                  <tr>
                    <td class="col-md-12">此系统基于开源框架 <a href="http://www.dyphp.com" target="_blank" class="text-light-blue">DyphpFramework</a> 开发</td>
                  </tr>
                  <tr>
                    <td class="col-md-12">系统文档请前往官网查看：<a href="http://www.dyphp.com" target="_blank" class="text-light-blue">http://www.dyphp.com</a></td>
                  </tr>
                  <tr>
                    <td class="col-md-12">当前版本：<?php echo DYADMIN_VERSION; ?></td>
                  </tr>
                  <tr>
                    <td class="col-md-12 text-red">
                    注意：<br />
                    为了安全，安装完成后删除根目录下的DyAdmin.sql文件<br />
                    修改/application/config/config.php文件配制中的secretKey值
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </section>

  <section class="col-md-6" style="margin-top:15px">
    <div class="box box-success">
      <div class="box-header">
        <h3 class="box-title">关于</h3>
        <div class="box-tools pull-right">
        </div>
      </div>

      <div class="box-body">
          <div class="form-group">
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <td class="col-md-12">在工作中所有系统基本上都需要有自己的管理后台，基于此而开发出了DyAdmin</td>
                  </tr>
                  <tr>
                    <td class="col-md-12">DyAdmin本质上为一个管理后台框架</td>
                  </tr>
                  <tr>
                    <td class="col-md-12">简单，通用，安全，易扩展，高效开发，快速整合</td>
                  </tr>
                  <tr>
                    <td class="col-md-12">力求开发者基于DyAdmin直接进行业务开发，以快速完成业务功能</td>
                  </tr>
                  <tr>
                    <td class="col-md-12">作者：大宇</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </section>

</div>
<!-- /.row -->