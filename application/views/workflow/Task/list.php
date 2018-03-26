<?php $this->pageTitle = '任务列表'?>

<style>
  hr {
    margin: 6px 0;
    width: 95%
  }
</style>

<!-- Main content -->
<div class="row">
  <section class="col-md-12">
    <div class="box box-success">
      <div class="box-header">
        <h3 class="box-title">工作流任务列表 &nbsp;&nbsp;
          <a href="/workflow/task/list?type=999">
            <button type="button" class="btn btn-default btn-sm">全部</button>
          </a>
          <a href="/workflow/task/list?type=0">
            <button type="button" class="btn btn-success btn-sm">正常</button>
          </a>
          <a href="/workflow/task/list?type=1">
            <button type="button" class="btn btn-danger btn-sm">终止</button>
          </a>
          <a href="/workflow/task/list?type=2">
            <button type="button" class="btn btn-info btn-sm">完成</button>
          </a>
        </h3>
        <div class="box-tools">
          <?php if (Common::checkPermit('/workflow/task/flowList')):?>
          <div class="pull-right">
            <a href="/workflow/task/flowList">
              <button type="button" class="btn btn-success">
                <i class="fa  fa-plus"></i> 发起新任务
              </button>
            </a>
          </div>
          <?php endif;?>
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
                    <th class="col-md-1">优先级</th>
                    <th class="col-md-1">流程名称</th>
                    <th class="col-md-1">创建者</th>
                    <th class="col-md-1">创建时间</th>
                    <th class="col-md-1">当前节点</th>
                    <th class="col-md-3">说明</th>
                    <th class="col-md-1">状态</th>
                    <th class="col-md-2">操作</th>
                  </tr>
                  <?php foreach ($listData as $key => $val):?>
                  <?php $flowArr = json_decode($val->flow, true);  $current = getNodeCurrent($flowArr);?>
                  <tr>
                    <td>
                      <?php echo $val->priority; ?>
                    </td>
                    <td>
                      <?php echo $val->name; ?>
                    </td>
                    <td>
                      <?php echo $val->username; ?>
                    </td>
                    <td style="text-align:left">
                      <?php echo $val->create_time; ?>
                      <?php echo $val->status == 0 ? '<br /><span style="color:#ff8800;font-size:12px;">用时:'.getConsume(time(), strtotime($val->create_time)).'</span>' : '';?>
                    </td>
                    <td>
                      <?php echo isset($current['name']) ? $current['name'] : ''; ?>
                    </td>
                    <td>
                      <?php echo $val->explain; ?>
                    </td>
                    <td>
                      <?php $status = array('正常','终止','完成'); $statusStyle = array('success','danger','info');?>
                      <span id='flow_status_<?php echo $val->id;?>' class="label label-<?php echo $statusStyle[$val->status];?>">
                        <?php echo $status[$val->status];?>
                      </span>
                    </td>
                    <td>
                      <a href="/workflow/task/view?id=<?php echo $val->id; ?>">
                        <button type="button" class="btn btn-primary" style="width:55px;">详细</button>
                      </a>
                      <?php if ($val->status != 2 && Dy::app()->auth->uid == $val->userid):?>
                      <?php $modalData = json_encode(array('id'=>$val->id,'name'=>$val->name), JSON_UNESCAPED_UNICODE); ?>
                      <button type="button" id="task_<?php echo $val->id;?>" data-toggle="modal"
                        data-target="#permitOpModal" data-op="<?php echo $val->status;?>"
                        data-data='<?php echo $modalData ?>' class="btn btn-<?php echo $val->status == 0 ? 'danger' : 'success';?> "
                        style="width:55px;">
                        <?php echo $val->status == 0 ? '终止' : '重启';?>
                      </button>
                      <a href="/workflow/task/edit?fid=<?php echo $val->fid; ?>&tid=<?php echo $val->id; ?>">
                        <button type="button" class="btn btn-warning" style="width:55px;">编辑</button>
                      </a>
                      <?php endif;?>
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">工作流操作</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="userOpSubmit" tid="" type="button" class="btn btn-primary">submit</button>
      </div>
    </div>
  </div>
</div>

<!-- Page script -->
<script>
  $(function() {
    //终止/重启工作流操作确认弹窗
    $('#permitOpModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var data = button.data('data');
      var modal = $(this);
      var dataOp = button.attr("data-op");

      var message = dataOp == 0 ? '终止' : '重启';
      dataOp == 0 ? modal.removeClass().addClass('modal modal-warning') : modal.removeClass().addClass(
        'modal modal-success');
      modal.find('.modal-body').html("<p>你确定要" + message + " [" + data.name + "] 任务吗? </p>");
      $("#userOpSubmit").attr('tid', data.id);
    });

    //终止/重启工作流操作提交
    $("#userOpSubmit").on("click", function(evt) {
      $('#permitOpModal').modal('hide');

      var tId = $(this).attr('tId');
      var op = $("#task_" + tId).attr("data-op") == 0 ? 1 : 0;
      var url = '/workflow/task/stop';
      var postData = {
        tid: tId,
        op: op
      };
      $.post(url, postData,
        function(data) {
          var mtype = data.status == 0 ? 'success' : 'warning';
          growlInfo(data.message, mtype);
          if (data.status == 0) {
            var btnstyle = op == 1 ? 'btn btn-success' : 'btn btn-danger';
            var btntext = op == 1 ? '重启' : '终止';
            var statusstyle = op == 0 ? 'label label-success' : 'label label-danger';
            var statustext = op == 0 ? '正常' : '终止';
            $("#task_" + tId).attr("data-op", op);
            $("#task_" + tId).removeClass().addClass(btnstyle);
            $("#task_" + tId).text(btntext);
            $("#flow_status_" + tId).removeClass().addClass(statusstyle);
            $("#flow_status_" + tId).text(statustext);
          }
        },
        'json'
      );
    });

  });
</script>