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
                                <a href="/admin/role/edit?id=<?php echo $val->id; ?>"><button type="button" data-toggle="modal" data-target="#permitOpModal" data-op="edit" class="btn btn-primary" style="width:55px;">编辑</button></a>
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
  <div class="box box-success" id="addRole">
    <div class="box-header">
      <h3 class="box-title">编辑角色</h3>
      <div class="box-tools pull-right">
          <a href="/admin/role/list"><button type="button" class="btn btn-info">创建角色</button></a>
      </div>
    </div>

    <div class="box-body">
      <!-- form start -->
      <form id="roleForm" role="form">
        <div class="form-group">
          <label>角色名</label>
          <input type="text" class="form-control" value="<?php echo $roleInfo->name; ?>" name="name" placeholder="">
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
            <input type="checkbox" name="status" class="flat-red" checked>
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


<!-- Page script -->
<script>
$(function () {
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
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
      modal.find('.modal-body form').show();
      modal.find('.modal-body p').remove();

      if(op == 'del'){
        modal.removeClass('fade').addClass('modal-warning');
        modal.find('.modal-title').html(treeData.name+' [删除角色]');
        modal.find('.modal-body form').hide();
        modal.find('.modal-body').append("<p>你确定要删除 ["+treeData.name+"] 项吗? </p>")
      }
      modal.find('.modal-body #treeId').val(treeData.id);
      modal.find('.modal-body form').attr('op',op);
  });

  //右键弹窗提交
  $("#roleOpSubmit").on("click",function(evt){
    var op = $("#roleOp").attr('op');
    var treeId = $("#roleOp input[name='treeId']").val();
    if(op == 'edit'){
      var url = '/admin/role/edit';
      var postData = {id:treeId, name:$("#roleOp input[name='name']").val(),status:$("#roleOp input[name='status']").is(':checked') };
    }else if(op == 'del'){
      var url = '/admin/role/del';
      var postData = {id:treeId};
    }
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


   //创建角色表单提交
   $('#addRole .btn.btn-primary').click( function () {
      var ids="";
      var nodes=$('#roleTree').jstree().get_checked();
      $.each(nodes, function(i, n) {
         ids += jQuery.parseJSON($("#"+n).attr('data')).id+",";
      });
      var url = '/admin/role/add';
      var postData = {name:$("#roleForm input[name='name']").val(),permission:ids,status:$("#roleForm input[name='status']").is(':checked')};
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
