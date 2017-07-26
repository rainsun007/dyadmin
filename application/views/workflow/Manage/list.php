<?php $this->pageTitle = '工作流管理'?>
<!-- Main content -->
<div class="row">
<section class="col-md-12">
    <div class="box box-success">
      <div class="box-header">
        <h3 class="box-title">工作流列表</h3>
        <div class="box-tools pull-right">
            <a href="/workflow/manage/add"><button type="button" class="btn btn-success"><i class="fa  fa-plus"></i> 创建工作流</button></a>
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
                            <th class="col-md-1">创建者</th>
                            <th class="col-md-2">创建时间</th>
                            <th class="col-md-4">说明</th>
                            <th class="col-md-1">状态</th>
                            <th class="col-md-2">操作</th>
                        </tr>
                        <?php foreach ($listData as $key => $val):?>
                        <tr>
                            <td><?php echo $val->name; ?></td>
                            <td><?php echo $val->username; ?></td>
                            <td><?php echo $val->create_time; ?></td>
                            <td><?php echo $val->explain; ?></td>
                            <td>
                              <?php echo $val->status == 0 ? "<span id='flow_status_".$val->id."' class='label label-success'>正常" : "<span id='flow_status_".$val->id."' class='label label-danger'>禁用"; ?>
                              <?php echo $val->used == 0 ? " [未用]</span>" : " [已用]</span>"; ?>
                            </td>
                            <td>
                              <a href="/workflow/manage/edit?id=<?php echo $val->id; ?>"><button type="button" class="btn btn-primary" style="width:55px;">编辑</button></a>
                              <button type="button" id="task_<?php echo $val->id;?>" data-toggle="modal" data-target="#permitOpModal" data-op="<?php echo $val->status;?>" data-data='<?php echo json_encode(array('id'=>$val->id,'name'=>$val->name),JSON_UNESCAPED_UNICODE); ?>' class="btn btn-<?php echo $val->status == 0 ? 'danger' : 'success';?> " style="width:55px;"><?php echo $val->status == 0 ? '禁用' : '启用';?></button>
                              <a href="/workflow/manage/add?id=<?php echo $val->id; ?>"><button type="button" class="btn" style="width:55px;">克隆</button></a>
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
        <h4 class="modal-title" id="permitOpModal">工作流操作</h4>
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
    //终止/重启工作流操作确认弹窗
    $('#permitOpModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data = button.data('data');
        var modal = $(this);
        var message = $("#task_"+data.id).attr("data-op") == 0 ? '禁用' : '启用';
        $("#task_"+data.id).attr("data-op") == 0 ? modal.removeClass().addClass('modal modal-warning') : modal.removeClass().addClass('modal modal-success');
        modal.find('.modal-body').html("<p>你确定要"+message+" ["+data.name+"] 工作流吗? </p>");
        modal.find('.modal-body').attr('tId',data.id);
    });

    //终止/重启工作流操作提交
    $("#userOpSubmit").on("click",function(evt){
      $('#permitOpModal').modal('hide');
      
      var tId = $('#permitOpModal .modal-body').attr('tId');
      var op = $("#task_"+tId).attr("data-op") == 0 ? 1 : 0;
      //var op = $("#task_"+tId).attr("data-op");

      var url = '/workflow/manage/stop';
      var postData = {tid:tId,op:op};
      $.post(url, postData,
         function(data){
             var mtype = data.status == 0 ? 'success' : 'warning';
             $.bootstrapGrowl(data.message,{ele:'body',type:mtype,offset: {from:'top',amount:100},align:'center',width:350,delay:4000,allow_dismiss:true,stackup_spacing:10});
             if(data.status == 0){
                var btnstyle = op == 1 ? 'btn btn-success' : 'btn btn-danger';  
                var btntext = op == 1 ? '启用' : '禁用';
                var statusstyle = op == 0 ? 'label label-success' : 'label label-danger';
                var statustext = op == 0 ? '正常' : '禁用';
                $("#task_"+tId).attr("data-op",op);
                $("#task_"+tId).removeClass().addClass(btnstyle);
                $("#task_"+tId).text(btntext);
                $("#flow_status_"+tId).removeClass().addClass(statusstyle);
                $("#flow_status_"+tId).text(statustext);
             }
         },
         'json'
      );
    });

  });
</script>