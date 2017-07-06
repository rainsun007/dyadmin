<?php $this->pageTitle = '任务处理'?>
<?php vHelper::regCss('gooflow/codebase/fonts/iconflow.css'); ?>
<?php vHelper::regCss('gooflow/codebase/GooFlow.css'); ?>
<?php vHelper::regCss('gooflow/default.css'); ?>
<?php vHelper::regJs('gooflow/GooFunc.js', 'head'); ?>
<?php vHelper::regJs('gooflow/json2.js', 'head'); ?>
<?php vHelper::regJs('gooflow/codebase/GooFlow.js', 'head'); ?>
<?php vHelper::regJs('gooflow/codebase/GooFlow_color.js', 'head'); ?>
<?php vHelper::loadKindEditor("content",'qq'); ?>

<style>
    hr{margin:6px 0;width:95%}
    .Gooflow_extend_right {position:static}
    .Gooflow_extend_bottom {position:static}
    .GooFlow i{width:25px}
    .GooFlow_head label {width:auto;padding:3px 25px}
</style>


<div class="row">
    <div id="workflows" style="margin:10px"></div>
</div>

<div class="row">
    <section class="col-md-6">
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">当前节点: <?php echo str_replace('<hr>',' | ',$current['name']);?></h3>
        </div>

        <form id="opForm" tid="<?php echo $taskInfo->id;?>" method="post" action="">
        <div class="box-body">
            <?php if(in_array(Dy::app()->auth->uid,$current['userIds'])):?>
            <div class="form-group">
                <label>执行流程</label><br />
                <?php foreach ($nextArr['nodes'] as $key => $value):?>
                <label class="">
                  <div class="iradio_minimal-red" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="radio" value="<?php echo $value;?>" name="r2" class="minimal-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                  <?php echo '['.$flowArr['lines'][$nextArr['lines'][$key]]['name'].'] -> ['.str_replace('<hr>',' | ',$flowArr['nodes'][$value]['name']).']'; ?>
                </label><br />
                <?php endforeach;?>
            </div>
            <?php endif; ?>

            <div class="form-group">
              <label>备注信息</label>
              <textarea id="opFormContent" name="content" style="width:650px;height:350px;visibility:hidden;"></textarea>
            </div>
        </div>

        <div class="box-footer">
          <input type="button" id="opFormSubmit" name="submit" class="btn btn-primary" value="Submit">
        </div>

        </form>
      </div>
      <!-- /.box -->
    </section>

    <section class="col-md-6">
    <div class="box box-success">
      <div class="box-header">
        <h3 class="box-title">操作记录</h3>
        <div class="box-tools pull-right">
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
                            <th class="col-md-1">用户</th>
                            <th class="col-md-1">操作时间</th>
                            <th class="col-md-1">操作类型</th>
                            <th class="col-md-6">备注信息</th>
                        </tr>
                        <?php foreach ($listData as $key => $val):?>
                        <tr>
                            <td><?php echo in_array($val->operate,array(0,3)) ? '系统' : $val->username; ?></td>
                            <td><?php echo $val->create_time; ?></td>
                            <td>
                                <?php 
                                $opArr = array('创建任务','流程操作','追加备注', '任务结束','任务终止','任务重启');
                                echo $opArr[$val->operate]; 
                                ?>
                             </td>
                            <td><?php echo $val->remark; ?></td>
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
</div>



<!-- Page script -->
<script type="text/javascript">
var jsondata = <?php echo $taskInfo->flow;?>;

var currentNodeId = "<?php echo $current['id'];?>";

var userNode = <?php echo in_array(Dy::app()->auth->uid,$current['userIds']) ? 'true' : 'false'; ?>

var property={
	width:1200,
	height:540,
	toolBtns:[],
	haveHead:true,
	headLabel:true,
	headBtns:[],
    haveTool:false,
	haveGroup:true,
	useOperStack:true
};

var workflow;
$(document).ready(function(){
     //iCheck for checkbox and radio inputs
    $('input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    $('input[name="r2"]').on('ifChecked', function(event){
        $(this).iCheck('check');  
    });

	workflow=$.createGooFlow($("#workflows"),property);
	workflow.loadData(jsondata);
    workflow.setTitle("<?php echo '工作流任务: '.$taskInfo->name;?>");

    //提交到服务器
    $('#opFormSubmit').click( function () {
      var nextNodeId = $("#opForm input[name='r2']:checked").val();
      if(userNode && nextNodeId == undefined){
          $.bootstrapGrowl('必须选择执行流程',{ele:'body',type:'warning',offset: {from:'top',amount:200},align:'center',width:350,delay:2000,allow_dismiss:true,stackup_spacing:10});
          return false;
      }

      editor.sync();
      var content =  $("#opFormContent").val();
      if(content == ""){
          $.bootstrapGrowl('备注信息不可为空',{ele:'body',type:'warning',offset: {from:'top',amount:200},align:'center',width:350,delay:2000,allow_dismiss:true,stackup_spacing:10});
          return false;
      }

      var tid = $("#opForm").attr('tid');

      var url = '/workflow/task/flowOp';
      var postData = {tid:tid,from:currentNodeId,to:nextNodeId,remark:content};
      $.post(url, postData,
          function(data){
              var mtype = data.status == 0 ? 'success' : 'warning';
              $.bootstrapGrowl(data.message,{ele:'body',type:mtype,offset: {from:'top',amount:100},align:'center',width:350,delay:4000,allow_dismiss:true,stackup_spacing:10});
          },
          'json'
      );
    });

});

</script>
