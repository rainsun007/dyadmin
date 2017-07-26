<?php $this->pageTitle = '工作流管理'?>
<?php vHelper::regCss('gooflow/codebase/fonts/iconflow.css'); ?>
<?php vHelper::regCss('gooflow/codebase/GooFlow.css'); ?>
<?php vHelper::regCss('gooflow/default.css'); ?>
<?php vHelper::regJs('gooflow/GooFunc.js', 'head'); ?>
<?php vHelper::regJs('gooflow/json2.js', 'head'); ?>
<?php vHelper::regJs('gooflow/codebase/GooFlow.js', 'head'); ?>
<?php vHelper::regJs('gooflow/codebase/GooFlow_color.js', 'head'); ?>

<style>
   hr{margin:0}
  .GooFlow i{width:25px}
  .GooFlow_head label {width:auto;padding:3px 25px}
</style>


<!-- Main content -->
<div class="row">
    <div class="col-md-6" style="height:90px">
        <input type="text" class="form-control" id="flowname" name="flowname" value="<?php echo $flowInfo ? $flowInfo->name : ''; ?>" placeholder="工流程名称"><br />
        <input type="text" class="form-control" id="explain" name="explain" value="<?php echo $flowInfo ? $flowInfo->explain : ''; ?>" placeholder="工流程说明">
    </div>
    <div class="col-md-6" style="height:50px"><a href="/workflow/manage/list">返回工作流管理列表</a></div>
</div>
<div class="row">
    <?php if(se($flowInfo,'used',true) == 1 && $op == 'edit'):?>
    <div class="col-md-6 text-red" style="height:10px;margin:15px;">
        此流程已被使用，流程主体已不可被编辑
    </div>
    <?php endif;?>
    <div id="workflows" style="margin:10px"></div>
</div>
<!-- /.content -->


<div class="modal fade" id="permitOpModal" treeData='' tabindex="-1" role="dialog" aria-labelledby="permitOpModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="permitOpModal">节点属性设置</h4>
      </div>
      <div class="modal-body">
            <input type="text" class="form-control" name="node_name" id="node_name" value="" placeholder="节点名称"><br/>
            <label>相关人员</label>
            <select class="form-control select2" multiple="multiple" name="users" id="users" data-placeholder="选择人员,可多选" style="width: 100%;">
                <?php $usersInfo = array(); ?>
                <?php foreach ($userList as $key => $value) : ?>
                <option value="<?php echo $value->id; ?>"><?php echo $value->realname; ?></option>
                <?php $usersInfo[$value->id] = $value->realname;?>
                <?php endforeach; ?>
            </select>
      </div>
      <div class="modal-footer">
          <input type="hidden" id="flow_id" value="<?php echo $flowInfo ? $flowInfo->id : 0; ?>">
          <input type="hidden" id="flow_op" value="<?php echo $op; ?>">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="userOpSubmit" onclick="chsub()" type="button" class="btn btn-primary">Ok</button>
      </div>
    </div>
  </div>
</div>


<!-- Page script -->
<script type="text/javascript">
var property={
    width:1200,
    height:540,
    //toolBtns:["start round mix","end round mix","task","node","chat","state","plug","join","fork","complex mix"],
    toolBtns:["task","node","chat","state","plug","join","fork","complex mix"],
    haveHead:true,
    headLabel:true,
    //headBtns:["new","open","save","undo","redo","reload"],//如果haveHead=true，则定义HEAD区的按钮
    headBtns:<?php echo se($flowInfo,'used',true) == 1 && $op == 'edit' ? '["save"]' : '["save","undo","redo"]';?>,//如果haveHead=true，则定义HEAD区的按钮
    haveTool:<?php echo se($flowInfo,'used',true) == 1 && $op == 'edit' ? 'false' : 'true';?>,
    haveGroup:<?php echo se($flowInfo,'used',true) == 1 && $op == 'edit' ? 'false' : 'true';?>,
    useOperStack:<?php echo se($flowInfo,'used',true) == 1 && $op == 'edit' ? 'false' : 'true';?>
};

var remark={
    cursor:"选择指针",
    direct:"结点连线",
    //start:"入口结点",
    //"end":"结束结点",
    "task":"任务结点",
    node:"自动结点",
    chat:"决策结点",
    state:"状态结点",
    plug:"附加插件",
    "join":"联合结点",
    fork:"分支结点",
    "complex":"复合结点",
    group:"组织划分框编辑开关"
};

//初始化数据
var jsondata = {
    "title": "创建工作流",
    "nodes": {
        "start_node": {
            "name": "开始",
            "left": 200,
            "top": 134,
            "type": "start round mix",
            "width": 26,
            "height": 26,
            "alt": true
        },
        "end_node": {
            "name": "结束",
            "left": 1000,
            "top": 142,
            "type": "end round mix",
            "width": 26,
            "height": 26,
            "alt": true
        }
    },
    "lines": {},
    "areas": {},
    "initNum": 3
};

<?php if($flowInfo){ echo 'jsondata ='.$flowInfo->flow.';';  } ?>

var usersInfo = <?php echo json_encode($usersInfo);?>;

var userSplitStyle = " <hr>Users:";

var workflow;
$(document).ready(function(){
    $("#users").select2();
    workflow=$.createGooFlow($("#workflows"),property);
    workflow.setNodeRemarks(remark);
    workflow.loadData(jsondata);
    workflow.reinitSize($('.row').width()*0.985,540)

    //节点编辑
    $("div").on("dblclick", function(){
      var id = $(this).children(".GooFlow_item.item_focus").attr("id");
      if(id == undefined){
        if($(this).attr('class') == 'GooFlow_work_inner'){
          return true;
        }
        id = $(this).attr("id");
      }

      var info = workflow.getItemInfo(id,"node");
      if(info == null){
        return true;
      }

      $("#workflows").children("textarea").attr("style","display:none");
      if(info.type == "start round mix" || info.type == "end round mix"){
          return false;
      }
      
      $('#node_name').val(info.name.split(userSplitStyle)[0]);
      $("#users").val(info.userIds).trigger('change');
      $("#permitOpModal").attr("choid",id);
      $("#permitOpModal").attr("chjson",JSON.stringify(info));
      $("#permitOpModal").attr("op","edit");
      $('#permitOpModal').modal({keyboard: true});
      
      return false;
    });

    //节点添加
    workflow.onItemAdd=function(id,type,json){
        if(type != 'node'){
          return true;
        }
        if(json.mychsub){
            return true;
        }
        if(json.type == "start round mix" || json.type == "end round mix"){
            json.name = json.type == "start round mix" ? '开始' : '结束';
            return true;
        }

        $('#node_name').val("");
        $('#users').val("").trigger('change');
        $("#permitOpModal").attr("choid",id);
        $("#permitOpModal").attr("chjson",JSON.stringify(json));
        $("#permitOpModal").attr("op","add");
        $('#permitOpModal').modal({keyboard: true});

        return false;
    }

    //删除节点
    workflow.onItemDel=function(id,type){
      if($("#workflows").attr("cd") == "true"){
          return true;
      }
      var info = workflow.getItemInfo(id,"node");
      if(info == null){
        return true;
      }
      if(info.type == "start round mix" || info.type == "end round mix"){
          $.bootstrapGrowl('此节点不可删除',{ele:'body',type:'warning',offset: {from:'top',amount:200},align:'center',width:350,delay:2000,allow_dismiss:true,stackup_spacing:10});
          return false;
      }
      return true;
    }

    //解决编辑后节点名不变问题
    workflow.onItemBlur=function(id,type){
        if($('#node_name').val() == ""){
            return true;
        }
        
        this.setName(id,joinNodeName(),'node');
        $('#node_name').val("");
        return true;
    }

    //提交到服务器
    workflow.onBtnSaveClick=function(){
        var flowname = $("#flowname").val();
        if(flowname == ""){
            $.bootstrapGrowl('工流程名称不可为空',{ele:'body',type:'warning',offset: {from:'top',amount:200},align:'center',width:350,delay:2000,allow_dismiss:true,stackup_spacing:10});
            return false;
        }
        workflow.setTitle(flowname);

        //var url = $('#userId').val() > 0 ? '/admin/user/edit' : '/admin/user/add';
        var url = $('#flow_op').val() == 'edit' ? '/workflow/manage/edit' :'/workflow/manage/add';
        var postData = {id:$('#flow_id').val(),name:flowname,explain:$("#explain").val(),flow:JSON.stringify(workflow.exportData())};
        $.post(url, postData,
           function(data){
               var mtype = data.status == 0 ? 'success' : 'warning';
               $.bootstrapGrowl(data.message,{ele:'body',type:mtype,offset: {from:'top',amount:100},align:'center',width:350,delay:4000,allow_dismiss:true,stackup_spacing:10});
           },
           'json'
        );
    }
});


//创建节点确定操作
function chsub(){
    var id = $("#permitOpModal").attr("choid");
    if(id == ""){
      return false;
    }

    if($("#permitOpModal").attr("op") == 'add'){
        var json = JSON.parse($("#permitOpModal").attr("chjson"));
        json.userIds = $('#users').val();
        json.name = joinNodeName();
        json.mychsub = true;
        workflow.addNode(id,json);
    }else if($("#permitOpModal").attr("op") == 'edit'){
        var ninfo = workflow.getItemInfo(id,"node");
        ninfo.userIds = $('#users').val();
        workflow.setName(id,joinNodeName(),'node');
    }

    $("#permitOpModal").attr("choid","");
    $("#permitOpModal").attr("chjson","");
    $('#permitOpModal').modal('hide');
}

function joinNodeName(){
    userIds = $('#users').val();
    var usersname = '';
    $.each(userIds, function (n, value) {
        usersname = usersname+usersInfo[value]+' ';
    });
    return usersname == "" ? $('#node_name').val() : $('#node_name').val()+userSplitStyle+usersname;
}
</script>
