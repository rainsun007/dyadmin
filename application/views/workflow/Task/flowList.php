<?php $this->pageTitle = '工作流管理'?>
<!-- Main content -->
<div class="row">
<section class="col-md-12">
    <div class="box box-success">
      <div class="box-header">
        <h3 class="box-title">工作流列表 - [在列表中选择要使用的工作流]</h3>
        <div class="box-tools pull-right">
          <a href="/workflow/task/list">返回任务列表</a>
        </div>
      </div>

      <div class="box-body">
        <!-- form start -->
        <form role="form">
          <div class="form-group">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th class="col-md-2">流程名称</th>
                            <th class="col-md-2">创建者</th>
                            <th class="col-md-1">说明</th>
                            <th class="col-md-2">创建时间</th>
                            <th class="col-md-1">操作</th>
                        </tr>
                        <?php foreach ($listData as $key => $val):?>
                        <tr>
                            <td><?php echo $val->name; ?></td>
                            <td><?php echo $val->username; ?></td>
                            <td><?php echo $val->explain; ?></td>
                            <td><?php echo $val->create_time; ?></td>
                            <td>
                              <a href="/workflow/task/add?id=<?php echo $val->id; ?>"><button type="button" class="btn btn-primary" style="width:55px;">使用</button></a>
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


    //删除用户操作
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
                  setTimeout("window.location.reload();",1000);
               }
           },
           'json'
        );
      });

  });
</script>

