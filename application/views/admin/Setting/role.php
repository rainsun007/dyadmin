<?php $this->pageTitle = '角色管理'?>
<?php vHelper::regCss('jstree/themes/default/style.css'); ?>
<?php vHelper::regJs('jstree/jstree.js', 'head'); ?>

<!-- Main content -->
<div class="row">
<section class="col-md-6">
    <div class="box box-success">
      <div class="box-header">
        <h3 class="box-title">角色列表</h3>
      </div>

      <div class="box-body">
        <!-- form start -->
        <form role="form">
          <div class="form-group">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover" id="oplist">
                    <tbody>
                        <tr>
                            <th class="col-md-4">角色</th>
                            <th class="col-md-1">状态</th>
                            <th class="col-md-1">操作</th>
                        </tr>
                        <?php foreach ($listData as $key => $val):?>
                        <tr>
                            <td><?php echo $val->name; ?></td>
                            <td><?php echo $val->status == 1 ? '<span class="text-green">正常</span>' : '<span class="text-yellow">禁用</span>'; ?></td>
                            <td>
                                <a href="/admin/role/list?id=<?php echo $val->id; ?>"><button type="button" class="btn btn-primary" style="width:55px;">编辑</button></a>
                                <button type="button" data-toggle="modal" data-target="#permitOpModal" data-op="del" data-data='<?php echo json_encode($val); ?>' class="btn btn-danger" style="width:55px;">删除</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
          </div>
        </form>
      </div>
      <!-- /.box-body -->

    </div>
    <!-- /.box -->
</section>

<section class="col-md-6">
  <div class="box <?php echo $roleId ? 'box-warning' : 'box-info'; ?>" id="addRole">
    <div class="box-header">
      <h3 class="box-title"><?php echo $roleId ? '编辑角色' : '创建角色'; ?></h3>
      <?php if ($roleId > 0):?>
      <div class="box-tools pull-right">
          <a href="/admin/role/list"><button type="button" class="btn btn-info">创建角色</button></a>
      </div>
      <?php endif; ?>
    </div>

    <div class="box-body">
      <!-- form start -->
      <form id="roleForm" role="form">
        <input type="hidden" name="roleId" id="roleId" value="<?php echo $roleId; ?>">
        <div class="form-group">
          <label>角色名</label>
          <input type="text" class="form-control" name="name" value="<?php se($roleInfo, 'name'); ?>" placeholder="">
        </div>

        <div class="form-group">
          <label>选择权限</label>
          <div id="roleTree">
            <?php $permission = $roleInfo ? explode(',', $roleInfo->permission) : array(); echo vHelper::jsTree($permissionTree, $permission, false); ?>
  				</div>
        </div>

        <!-- checkbox -->
        <div class="form-group">
          <label>
            <input type="checkbox" name="status" class="flat-red" <?php if ($roleInfo && $roleInfo->status == 1):?>checked<?php endif; ?>>
          </label>
          <label>
            角色是否可用（不勾选为禁用）
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
        <button id="roleOpSubmit" type="button" class="btn btn-primary">submit</button>
      </div>
    </div>
  </div>
</div>



<!-- Page script -->
<script>
$(function () {
    //Flat red color scheme for iCheck
    $('#roleForm input[type="checkbox"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
    });
    $("#roleForm input[name='status']").on('ifChecked ifUnchecked', function(event) {
      event.type == 'ifChecked' ? $(this).attr('checked',true) : $(this).attr('checked',false);
    });

   $("#roleTree").jstree({
     "checkbox" : {
        "keep_selected_style" : false,
        "three_state":false,
        "whole_node":false,
        //"tie_selection":false,
     },
     "core" : {
        "check_callback" : true,
        "multiple" : true,
     },

     "types" : {
        "default" : {
          "icon" : false
        },
      },

     "plugins" : [ "checkbox","types"]
   });

  //删除角色操作
  $('#permitOpModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var op = button.data('op')
      var modal = $(this)
      var treeData = button.data('data');

      modal.removeClass('modal-warning').addClass('fade');
      if(op == 'del'){
        modal.removeClass('fade').addClass('modal-warning');
        modal.find('.modal-title').html(treeData.name+' [删除角色]');
        modal.find('.modal-body').html("<p>你确定要删除 ["+treeData.name+"] 项吗? </p>")
      }
      modal.find('.modal-body').attr('treeId',treeData.id);
  });

  //删除权限弹窗提交
  $("#roleOpSubmit").on("click",function(evt){
    var treeId = $('#permitOpModal .modal-body').attr('treeId');
    var url = '/admin/role/del';
    var postData = {id:treeId};
    $.post(url, postData,
       function(data){
           var mtype = data.status == 0 ? 'success' : 'warning';
           $.bootstrapGrowl(data.message,{ele:'body',type:mtype,offset: {from:'top',amount:100},align:'center',width:350,delay:4000,allow_dismiss:true,stackup_spacing:10});
           if(data.status == 0){
              window.location.href='/admin/role/list';
           }
       },
       'json'
    );
  });


   //创建和编辑角色表单提交
   $('#addRole .btn.btn-primary').click( function () {
      var ids="";
      var nodes=$('#roleTree').jstree().get_checked();
      $.each(nodes, function(i, n) {
         ids += jQuery.parseJSON($("#"+n).attr('data')).id+",";
      });
      var url = $('#roleId').val() > 0 ? '/admin/role/edit' : '/admin/role/add';
      var postData = {id:$('#roleId').val(),name:$("#roleForm input[name='name']").val(),permission:ids,status:$("#roleForm input[name='status']").is(':checked')};
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
