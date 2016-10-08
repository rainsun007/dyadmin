
<?php vHelper::regCss('jstree/themes/default/style.css'); ?>
<?php vHelper::regJs('jstree/jstree.js', 'head'); ?>

<!-- Main content -->
<section class="content col-md-6">
    <div class="box box-success">
      <div class="box-header">
        <h3 class="box-title">创建用户</h3>
      </div>

      <div class="box-body">

        <!-- form start -->
        <form role="form">
          <div class="form-group">
            <label>用户名</label>
            <input type="text" class="form-control" name="username" placeholder="以字母开头字母、数字、下划线组合">
          </div>
          <div class="form-group">
            <label>密码</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>

          <!-- checkbox -->
          <div class="form-group">
            <label>
              <input type="checkbox" name="status" class="flat-red" checked>
            </label>
            <label>
              用户是否可用（不勾选为禁用）
            </label>
          </div>

          <div class="form-group">
            <label>用户角色</label>
            <select class="form-control select2" multiple="multiple" name="roles" data-placeholder="选择用户角色,可多选" style="width: 100%;">
              <?php foreach ($roles as $key => $value) : ?>
              <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </form>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>

    </div>
    <!-- /.box -->
</section>
<!-- /.content -->


<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
    });

  });
</script>
