<?php $this->pageTitle = '用户管理'?>
<?php vHelper::regCss('jstree/themes/default/style.css'); ?>
<?php vHelper::regJs('jstree/jstree.js', 'head'); ?>

<!-- Main content -->
<div class="row">
<section class="col-md-6">
    <div class="box box-success">
      <div class="box-header">
        <h3 class="box-title">用户列表</h3>
      </div>

      <div class="box-body">
        <!-- form start -->
        <form role="form">
          <div class="form-group">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th class="col-md-4">用户</th>
                            <th class="col-md-1">状态</th>
                            <th class="col-md-1">操作</th>
                        </tr>
                        <?php foreach ($listData as $key => $val):?>
                        <tr>
                            <td><?php echo $val->username; ?></td>
                            <td><?php echo $val->status == 1 ? '<span class="text-green">正常</span>' : '<span class="text-yellow">禁用</span>'; ?></td>
                            <td>
                              <?php if ($val->id > 1):?>
                              <a href="/admin/user/list?id=<?php echo $val->id; ?>"><button type="button" class="btn btn-primary" style="width:55px;">编辑</button></a>
                              <button type="button" data-toggle="modal" data-target="#permitOpModal" data-op="del" data-data='<?php echo json_encode($val); ?>' class="btn btn-danger" style="width:55px;">删除</button>
                              <?php endif; ?>

                              <?php if ($val->id == 1 && Dy::app()->auth->uid == 1):?>
                              <a href="/admin/user/list?id=<?php echo $val->id; ?>"><button type="button" class="btn btn-primary" style="width:55px;">编辑</button></a>
                              <?php endif; ?>
                           </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
          </div>
        </form>
        <?php $this->widget('DyPagerWidget', $pageWidgetOptions); ?>
      </div>
      <!-- /.box-body -->

    </div>
    <!-- /.box -->
</section>

<section id="permitOpbak" class="col-md-6">
  <div class="box <?php echo $uId ? 'box-warning' : 'box-info'; ?>" id="addRole">
    <div class="box-header">
      <h3 class="box-title"><?php echo $uId ? '编辑用户' : '创建用户'; ?></h3>
      <?php if ($uId > 0):?>
      <div class="box-tools pull-right">
          <a href="/admin/user/list"><button type="button" class="btn btn-info">创建用户</button></a>
      </div>
      <?php endif; ?>
    </div>

    <div class="box-body">
      <!-- form start -->
      <form id="roleForm" role="form">
        <input type="hidden" name="userId" id="userId" value="<?php echo $uId; ?>">
        <div class="form-group">
          <label>用户名</label>
          <input type="text" class="form-control" name="username" value="<?php se($uInfo, 'username'); ?>" placeholder="以字母开头字母、数字、下划线组合">
        </div>

        <div class="form-group">
          <label>密码</label>
          <input type="text" class="form-control" name="password" placeholder="Password">
        </div>

        <div class="form-group">
          <label>用户角色</label>
          <?php $userRoleIds = explode(',', se($uInfo, 'role_ids', true)); ?>
          <select class="form-control select2" multiple="multiple" name="roles" id="roles" data-placeholder="选择用户角色,可多选" style="width: 100%;">
            <?php foreach ($roles as $key => $value) : ?>
            <option value="<?php echo $value->id; ?>" <?php if (in_array($value->id, $userRoleIds)): ?>selected="selected"<?php endif; ?>><?php echo $value->name; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- checkbox -->
        <div class="form-group">
          <label>
            <input type="checkbox" name="status" class="flat-red" <?php if ($uInfo && $uInfo->status == 1):?>checked<?php endif; ?>>
          </label>
          <label>
            用户是否可用（不勾选为禁用）
          </label>
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
</div>
<!-- /.content -->


<div class="modal fade" id="permitOpModal" treeData='' tabindex="-1" role="dialog" aria-labelledby="permitOpModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="permitOpModal">删除权限</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="userOpSubmit" type="button" class="btn btn-primary">submit</button>
      </div>
    </div>
  </div>
</div>

<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
    });


    //删除角色操作
    $('#permitOpModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data = button.data('data');
        var modal = $(this);

        modal.removeClass('fade').addClass('modal-warning');
        modal.find('.modal-title').html(data.username+' [删除用户]');
        modal.find('.modal-body').html("<p>你确定要删除 ["+data.username+"] 项吗? </p>");
        modal.find('.modal-body').attr('treeId',data.id);
    });

    //删除用户弹窗提交
    $("#userOpSubmit").on("click",function(evt){
      var treeId = $('#permitOpModal .modal-body').attr('treeId');
      var url = '/admin/user/del';
      var postData = {id:treeId};
      $.post(url, postData,
         function(data){
             var mtype = data.status == 0 ? 'success' : 'warning';
             $.bootstrapGrowl(data.message,{ele:'body',type:mtype,offset: {from:'top',amount:100},align:'center',width:350,delay:4000,allow_dismiss:true,stackup_spacing:10});
             if(data.status == 0){
                window.location.href='/admin/user/list';
             }
         },
         'json'
      );
    });


     //创建和编辑角色表单提交
     $('#addRole .btn.btn-primary').click( function () {
        var ids="";
        var nodes=$('#roles').val();
        if(nodes){
           ids = nodes.join(',');
        }
        var url = $('#userId').val() > 0 ? '/admin/user/edit' : '/admin/user/add';
        var postData = {id:$('#userId').val(),username:$("#roleForm input[name='username']").val(),password:$("#roleForm input[name='password']").val(),roles:ids,status:$("#roleForm input[name='status']").is(':checked')};
        $.post(url, postData,
           function(data){
               var mtype = data.status == 0 ? 'success' : 'warning';
               $.bootstrapGrowl(data.message,{ele:'body',type:mtype,offset: {from:'top',amount:100},align:'center',width:350,delay:4000,allow_dismiss:true,stackup_spacing:10});
               if(data.status == 0){
                  window.location.reload();
               }
           },
           'json'
        );
      });

  });
</script>
