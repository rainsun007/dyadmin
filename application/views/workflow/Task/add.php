<?php $this->pageTitle = '创建任务'?>
<?php VHelper::setBreadcrumb('发起新任务', '创建任务', 'workflow/task/list'); ?>

<?php ViewHelper::regCss('gooflow/codebase/fonts/iconflow.css'); ?>
<?php ViewHelper::regCss('gooflow/codebase/GooFlow.css'); ?>
<?php ViewHelper::regCss('gooflow/default.css'); ?>
<?php ViewHelper::regJs('gooflow/GooFunc.js', 'head'); ?>
<?php ViewHelper::regJs('gooflow/json2.js', 'head'); ?>
<?php ViewHelper::regJs('gooflow/codebase/GooFlow.js', 'head'); ?>
<?php ViewHelper::regJs('gooflow/codebase/GooFlow_color.js', 'head'); ?>

<style>
hr{margin:0}
.Gooflow_extend_right {position:static}
.Gooflow_extend_bottom {position:static}
.GooFlow i{width:25px}
.GooFlow_head label {width:auto;padding:3px 25px}
</style>

<div class="row">
    <div class="col-md-6" style="height:150px">
        <input type="text" class="form-control" id="taskname" name="taskname" value="<?php echo isset($taskInfo->name) ? $taskInfo->name : ''; ?>" placeholder="任务名称"><br />
        <input type="text" class="form-control" id="explain" name="explain" value="<?php echo isset($taskInfo->explain) ? $taskInfo->explain : ''; ?>" placeholder="任务说明"><br />
        <input type="text" class="form-control" id="priority" name="priority" value="<?php echo isset($taskInfo->priority) ? $taskInfo->priority : ''; ?>" placeholder="优先级，请输入正整数，数值越大优先级越高">
    </div>
    <div class="col-md-6" style="height:50px"><a href="/workflow/task/list">返回任务列表</a></div>
</div>
<div class="row">
    <div id="workflows" style="margin:10px"></div>
</div>


<!-- Page script -->
<script type="text/javascript">
var jsondata = <?php echo $flowInfo->flow;?>;

var fid = <?php echo $flowInfo->id;?>;

var tid = <?php echo DyRequest::getInt('tid');?>;

var property={
	width:1200,
	height:540,
	toolBtns:["start round mix","end round mix","task","node","chat","state","plug","join","fork","complex mix"],
	haveHead:true,
	headLabel:true,
	headBtns:['save'],
  haveTool:false,
	haveGroup:false,
	useOperStack:false
};

var workflow;
$(document).ready(function(){
	workflow=$.createGooFlow($("#workflows"),property);
	workflow.loadData(jsondata);
    workflow.reinitSize($('.row').width()*0.985,540)

  //提交到服务器
  workflow.onBtnSaveClick=function(){
      var taskname = $("#taskname").val();
      if(taskname == ""){
          $.bootstrapGrowl('任务名称不可为空',{ele:'body',type:'warning',offset: {from:'top',amount:200},align:'center',width:350,delay:2000,allow_dismiss:true,stackup_spacing:10});
          return false;
      }
      var url = tid > 0 ? '/workflow/task/edit' : '/workflow/task/add';
      var postData = {tid:tid,fid:fid,name:taskname,explain:$("#explain").val(),priority:$("#priority").val(),flow:JSON.stringify(jsondata)};
      $.post(url, postData,
          function(data){
              var mtype = data.status == 0 ? 'success' : 'warning';
              $.bootstrapGrowl(data.message,{ele:'body',type:mtype,offset: {from:'top',amount:100},align:'center',width:350,delay:4000,allow_dismiss:true,stackup_spacing:10});
          },
          'json'
      );
  }

});

</script>
