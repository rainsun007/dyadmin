<?php $this->pageTitle = '权限管理'?>
<?php ViewHelper::regCss('jstree/themes/default/style.css'); ?>
<?php ViewHelper::regJs('jstree/jstree.js', 'head'); ?>

<!-- Main content -->
<div class="row">
<section class="col-md-6">
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">权限列表</h3>
      </div>

      <div class="box-body">
        <!-- form start -->
        <form role="form">
          <div class="form-group">
          <div class="callout callout-info">
            <h4>功能说明</h4>
            <p><span class="text-light-blue" style="background:#fff;padding:3px;">蓝色</span> 项为导航，导航为权限的一部份，在此处只能添加子权限，对导航操作进入<a href="/admin/nav/list">导航管理</a></p>
            <p>在列表中各节点上右键进行相关操作</p>
          </div>
          <div id="roleTree">
            <?php echo ViewHelper::jsTree($permissionTree, array(), false, 'text-light-blue'); ?>
  				</div>
          </div>
        </form>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>
<section class="col-md-6">
  <div class="box box-success">
    <div class="box-header">
      <h3 class="box-title">权限缓存清理</h3>
    </div>
    <div class="box-body">
      <div class="callout callout-success">
        <p>系统产生的所有缓存都是7天</p>
        <p>现有缓存：导航数据缓存，权限数据缓存</p>
      </div>
      <button type="button" id="flushcache" class="btn btn-block btn-success btn-lg">清除全部缓存</button>
      <button type="button" id="flushcache_disabled" class="btn btn-block btn-success btn-lg disabled" style="display:none">清除全部缓存</button>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->
</div>


<div class="modal fade" id="permitOpModal" treeData='' tabindex="-1" role="dialog" aria-labelledby="permitOpModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="permitOpModal">创建子权限</h4>
      </div>
      <div class="modal-body">
        <form id="navOp">
          <input type="hidden" class="form-control" name="treeId" id="treeId" >
          <div class="form-group">
            <label>权限名<span class="text-red">*</span></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="权限显示名">
          </div>

          <div class="form-group">
            <label>连接地址</label>
            <input type="text" class="form-control" name="link" id="link" placeholder="访问连接">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="navOpSubmit" type="button" class="btn btn-primary">submit</button>
      </div>
    </div>
  </div>
</div>


<!-- Page script -->
<script>
 $(function () {
		$("#roleTree").jstree({
      "core" : {
         "check_callback" : true,
         "multiple" : true,
      },

      "types" : {
         "default" : {
           "icon" : false
         },
       },

      "contextmenu":{
         "select_node":true,
         "items":customMenu,
       },

			"plugins" : [ "types","contextmenu"]
    }); 


    function customMenu(node) {
       var items = {
         "create":null,
         "rename":null,
         "remove":null,
         "ccp":null,
         "addMenu":{
             "separator_before": false,
             "separator_after": false,
             "icon":"glyphicon glyphicon-leaf text-aqua",
             "label":"<span data-toggle=\"modal\" data-target=\"#permitOpModal\" data-op=\"add\">建子权限</span>",
             "action":function(data){
                 var inst = jQuery.jstree.reference(data.reference),
                 obj = inst.get_node(data.reference);
                 $('#permitOpModal').attr('treeData',$('#'+obj.id).attr("data"))
             }
         },
         "delMenu":{
             "separator_before": false,
             "separator_after": false,
             "icon":"glyphicon glyphicon-trash  text-red",
             "label":"<span data-toggle=\"modal\" data-target=\"#permitOpModal\" data-op=\"del\">删除权限</span>",
             "action":function(data){
                 var inst = jQuery.jstree.reference(data.reference),
                 obj = inst.get_node(data.reference);
                 $('#permitOpModal').attr('treeData',$('#'+obj.id).attr("data"))
             }
         },
         "editMenu":{
             "separator_before": false,
             "separator_after": false,
             "icon":"glyphicon glyphicon-edit text-yellow",
             "label":"<span data-toggle=\"modal\" data-target=\"#permitOpModal\" data-op=\"edit\">编辑权限</span>",
             "action":function(data){
                 var inst = jQuery.jstree.reference(data.reference),
                 obj = inst.get_node(data.reference);
                 $('#permitOpModal').attr('treeData',$('#'+obj.id).attr("data"))
             }
         }
       };

       var nodeData = jQuery.parseJSON($('#'+node.id).attr('data'));
       if (nodeData.type == 0) {
          delete items.editMenu;
          delete items.delMenu;
       }

       if (nodeData.sys == 1) {
          delete items.delMenu;
       }

       return items;
    }

    //右键菜单操作弹窗
    $('#permitOpModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var op = button.data('op')
        var modal = $(this)
        var treeData = jQuery.parseJSON($(modal[0]).attr('treeData'));

        modal.removeClass('modal-warning').addClass('fade');
        modal.find('.modal-body form').show();
        modal.find('.modal-body p').remove();

        if(op == 'add'){
          modal.find('.modal-body input').val('');
          modal.find('.modal-title').html('<i class="'+treeData.icon+'"></i>'+treeData.name+' [添加子权限]');
        }else if(op == 'edit'){
          modal.find('.modal-title').html('<i class="'+treeData.icon+'"></i>'+treeData.name+' [编辑权限]');
          modal.find('.modal-body #name').val(treeData.name);
          modal.find('.modal-body #link').val(treeData.link);
        }else if(op == 'del'){
          modal.removeClass('fade').addClass('modal-warning');
          modal.find('.modal-title').html('<i class="'+treeData.icon+'"></i>'+treeData.name+' [删除权限]');
          modal.find('.modal-body form').hide();
          modal.find('.modal-body').append("<p>你确定要删除 ["+treeData.name+"] 项吗? 请注意此操作会删除本权限及其子权限</p>")
        }
        modal.find('.modal-body #treeId').val(treeData.id);
        modal.find('.modal-body form').attr('op',op);
    });

    //右键弹窗提交
    $("#navOpSubmit").on("click",function(evt){
      var op = $("#navOp").attr('op');
      var treeId = $("#navOp input[name='treeId']").val();
      if(op == 'edit'){
        var url = '/admin/permit/edit';
        var postData = {id:treeId, name:$("#navOp input[name='name']").val(), link:$("#navOp input[name='link']").val()};
      }else if(op == 'add'){
        var url = '/admin/permit/add';
        var postData = {pid:treeId, name:$("#navOp input[name='name']").val(), link:$("#navOp input[name='link']").val()};
      }else if(op == 'del'){
        var url = '/admin/permit/del';
        var postData = {id:treeId};
      }
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

    //清除所有缓存
    $("#flushcache").on("click",function(evt){
      $("#flushcache_disabled").show();
      $("#flushcache").hide();
      $.post('/admin/permit/flushCache',{op:'fulsh'},
         function(data){
             var mtype = data.status == 0 ? 'success' : 'warning';
             $.bootstrapGrowl(data.message,{ele:'body',type:mtype,offset: {from:'top',amount:100},align:'center',width:350,delay:4000,allow_dismiss:true,stackup_spacing:10});
             $("#flushcache_disabled").hide();
             $("#flushcache").show();
         },
         'json'
      );
    });

 });
</script>
