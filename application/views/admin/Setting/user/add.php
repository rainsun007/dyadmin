<?php 
  $this->pageTitle = '创建用户';
  $this->setData('breadcrumbMain', '用户管理');
  $this->setData('breadcrumbActive', '创建用户');
?>
<?php ViewHelper::regCss('jstree/themes/default/style.css'); ?>
<?php //ViewHelper::regJs('jstree/jstree.js', 'head'); ?>

<!-- Main content -->
<div class="row">
  <section id="permitOpbak" class="col-md-12">
    <div class="box box-success" id="addRole">
      <div class="box-header">
        <h3 class="box-title">
          创建用户
        </h3>
      </div>

      <div class="box-body">
        <!-- form start -->
        <form id="roleForm" role="form">
          <div class="form-group">
            <label>用户名</label>
            <input type="text" class="form-control" name="username" value="" placeholder="以字母开头字母、数字、下划线组合">
          </div>

          <div class="form-group">
            <label>姓名</label>
            <input type="text" class="form-control" name="realname" value="" placeholder="用户的真实姓名">
          </div>

          <div class="form-group">
            <label>密码</label>
            <input type="text" class="form-control" name="password" placeholder="Password">
          </div>

          <div class="form-group">
            <label>邮箱</label>
            <input type="text" class="form-control" name="email" value="" placeholder="邮箱地址">
          </div>

          <div class="form-group">
            <label>电话</label>
            <input type="text" class="form-control" name="phone" value="" placeholder="电话号码">
          </div>

          
          <div class="form-group">
            <label>用户角色</label>
            <select class="form-control select2" multiple="multiple" name="roles" id="roles" data-placeholder=" 选择用户角色,可多选" style="width: 100%;">
              <?php foreach ($roles as $key => $value) : ?>
              <option value="<?php echo $value->id; ?>">
                <?php echo $value->name; ?>
              </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- checkbox -->
          <div class="form-group">
            <label>
              <input type="checkbox" name="status" class="flat-red">
            </label>
            <label>
              用户是否可用（不勾选为禁用）
            </label>
          </div>
          
        </form>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary" style="margin-right:20px;">Submit</button>
        <a href="<?php echo DyRequest::createUrl('/admin/user/list');?>" class="btn btn-default">返回</a>
      </div>

    </div>
    <!-- /.box -->
  </section>
</div>
<!-- /.content -->


<!-- Page script -->
<script>
  $(function() {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
    });

    //创建和编辑用户表单提交
    $('#addRole .btn.btn-primary').click(function() {
      var ids = "";
      var nodes = $('#roles').val();
      if (nodes) {
        ids = nodes.join(',');
      }
      var url = '<?php echo DyRequest::createUrl("/admin/user/add");?>';
      var postData = {
        username: $("#roleForm input[name='username']").val(),
        realname: $("#roleForm input[name='realname']").val(),
        password: $("#roleForm input[name='password']").val(),
        email: $("#roleForm input[name='email']").val(),
        phone: $("#roleForm input[name='phone']").val(),
        roles: ids,
        status: $("#roleForm input[name='status']").is(':checked')
      };
      $.post(url, postData,
        function(data) {
          var mtype = data.status == 0 ? 'success' : 'warning';
          $.bootstrapGrowl(data.message, {
            ele: 'body',
            type: mtype,
            offset: {
              from: 'top',
              amount: 100
            },
            align: 'center',
            width: 350,
            delay: 4000,
            allow_dismiss: true,
            stackup_spacing: 10
          });
          if (data.status == 0) {
            setTimeout("jumpURL();", 1000);
          }
        },
        'json'
      );
    });

  });

  function jumpURL(){
    window.location.href="<?php echo DyRequest::createUrl('/admin/user/list');?>";
  }
</script>