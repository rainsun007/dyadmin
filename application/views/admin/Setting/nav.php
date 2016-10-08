<?php vHelper::regCss('jstree/themes/default/style.css'); ?>
<?php vHelper::regJs('jstree/jstree.js', 'head'); ?>

<!-- Main content -->
<div class="row">
<section class="col-md-6">
    <div class="box box-success">
      <div class="box-header">
        <h3 class="box-title">导航列表</h3>
      </div>

      <div class="box-body">
        <!-- form start -->
        <form role="form">
          <div class="callout callout-info">
            <h4>功能说明</h4>
            <p><span class="text-muted" style="background:#fff;padding:3px;">灰色</span> 项为禁用的导航，在列表中各节点上右键进行相关操作</p>
            <p>添加主导航请在右侧的表单操作；各节点中的输入框为导航排序（正整数），修改后输入框失去焦点将自动保存</p>
            <p class="text-red">注意：只支持二级导航，相关内部操作（权限）在<a href="/admin/permit/list">权限管理</a>中设置</p>
          </div>
          <div class="form-group">
          <label>选择角色权限</label>
          <div id="roleTree">
            <?php echo vHelper::jsTree($permissionTree, array(), true, 'text-muted', true); ?>
  				</div>
          </div>
        </form>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>

<section class="col-md-6">
  <div class="box box-info">
    <div class="box-header">
      <h3 class="box-title">创建主导航</h3>
    </div>

    <div class="box-body">
      <!-- form start -->
      <form id="mainNavAdd" role="form">
        <div class="form-group">
          <label>导航名<span class="text-red">*</span></label>
          <input type="text" class="form-control" name="name" placeholder="导航显示名">
        </div>

        <div class="form-group">
          <label>连接地址</label>
          <input type="text" class="form-control" name="link" placeholder="访问连接">
        </div>

        <div class="form-group">
          <label>ICON样式</label>
          <input type="text" class="form-control" name="icon" placeholder="icon class">
        </div>

        <div class="form-group">
          <label>排序</label>
          <input type="text" class="form-control" name="sort" placeholder="请输入正整数">
        </div>

        <!-- checkbox -->
        <div class="form-group">
          <label>
            <input type="checkbox" name="display" class="flat-red" checked>
          </label>
          <label>
            角色是否可用（不勾选为禁用）
          </label>
        </div>
      </form>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
      <button type="button" id="mainNavAddSubmit" class="btn btn-primary">Submit</button>
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
        <h4 class="modal-title" id="permitOpModal">创建子导航</h4>
      </div>
      <div class="modal-body">
        <form id="navOp">
          <input type="hidden" class="form-control" name="treeId" id="treeId" >
          <div class="form-group">
            <label>导航名<span class="text-red">*</span></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="导航显示名">
          </div>

          <div class="form-group">
            <label>连接地址</label>
            <input type="text" class="form-control" name="link" id="link" placeholder="访问连接">
          </div>

          <div class="form-group">
            <label>ICON样式</label>
            <input type="text" class="form-control" name="icon" id="icon" placeholder="icon class">
          </div>

          <div class="form-group">
            <label>排序</label>
            <input type="text" class="form-control" name="sort" id="sort" placeholder="请输入整数">
          </div>

          <!-- checkbox -->
          <div class="form-group">
            <label>
              <input type="checkbox" name="display" id="display" class="flat-red" checked>
            </label>
            <label>
              导航是否可用（不勾选为禁用）
            </label>
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
     //Flat red color scheme for iCheck
     $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
       checkboxClass: 'icheckbox_flat-green',
     });
     $("#mainNavAdd input[name='display']").on('ifChecked ifUnchecked', function(event) {
       event.type == 'ifChecked' ? $(this).attr('checked',true) : $(this).attr('checked',false);
     });
     $("#permitOpModal input[name='display']").on('ifChecked ifUnchecked', function(event) {
       event.type == 'ifChecked' ? $(this).attr('checked',true) : $(this).attr('checked',false);
     });

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
         "select_node":false,
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
             "label":"<span data-toggle=\"modal\" data-target=\"#permitOpModal\" data-op=\"add\">添加导航</span>",
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
             "label":"<span data-toggle=\"modal\" data-target=\"#permitOpModal\" data-op=\"del\">删除导航</span>",
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
             "label":"<span data-toggle=\"modal\" data-target=\"#permitOpModal\" data-op=\"edit\">编辑导航</span>",
             "action":function(data){
                 var inst = jQuery.jstree.reference(data.reference),
                 obj = inst.get_node(data.reference);
                 $('#permitOpModal').attr('treeData',$('#'+obj.id).attr("data"))
             }
         }
       };

       var nodeData = jQuery.parseJSON($('#'+node.id).attr('data'));
       console.log(nodeData);
       //二级导航不可创建子导航
       if (nodeData.pid > 0) {
          delete items.addMenu;
       }
       //系统导航不可删除
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
          modal.find('.modal-title').html('<i class="'+treeData.icon+'"></i>'+treeData.name+' [添加子导航]');
          //console.log(modal.find('.modal-body #name')[0]);
        }else if(op == 'edit'){
          modal.find('.modal-title').html('<i class="'+treeData.icon+'"></i>'+treeData.name+' [编辑导航]');
          modal.find('.modal-body #name').val(treeData.name);
          modal.find('.modal-body #link').val(treeData.link);
          modal.find('.modal-body #icon').val(treeData.icon);
          modal.find('.modal-body #sort').val(treeData.sort);
          treeData.display == 1 ? modal.find('.modal-body #display').iCheck('check') : modal.find('.modal-body #display').iCheck('uncheck');;
        }else if(op == 'del'){
          modal.removeClass('fade').addClass('modal-warning');
          modal.find('.modal-title').html('<i class="'+treeData.icon+'"></i>'+treeData.name+' [删除导航]');
          modal.find('.modal-body form').hide();
          modal.find('.modal-body').append("<p>你确定要删除 ["+treeData.name+"] 项吗? 请注意此操作会删除本导航及其子导航</p>")
        }
        modal.find('.modal-body #treeId').val(treeData.id);
        modal.find('.modal-body form').attr('op',op);
    });

    //右键弹窗提交
    $("#navOpSubmit").on("click",function(evt){
      var op = $("#navOp").attr('op');
      var treeId = $("#navOp input[name='treeId']").val();
      if(op == 'edit'){
        var url = '/admin/nav/edit';
        var postData = {id:treeId, name:$("#navOp input[name='name']").val(), link:$("#navOp input[name='link']").val(),sort:$("#navOp input[name='sort']").val(),icon:$("#navOp input[name='icon']").val(),display:$("#navOp input[name='display']").is(':checked') };
      }else if(op == 'add'){
        var url = '/admin/nav/add';
        var postData = {pid:treeId, name:$("#navOp input[name='name']").val(), link:$("#navOp input[name='link']").val(),sort:$("#navOp input[name='sort']").val(),icon:$("#navOp input[name='icon']").val(),display:$("#navOp input[name='display']").is(':checked') };
      }else if(op == 'del'){
        var url = '/admin/nav/del';
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

    //排序编辑
    $("input[class='treeSort']").on("click",function(evt){
        evt.stopPropagation();
        evt.preventDefault();
        $(evt.target).focus().one('blur',function(){
             if($(evt.target).attr('osort') != $(evt.target).val()){
               $.post("/admin/nav/upsort", { id: $(evt.target).attr('treeid'), sort: $(evt.target).val() },
                   function(data){
                       var mtype = data.status == 0 ? 'success' : 'warning';
                       var msg = data.status == 0 ? '已修改成功' : '修改失败！';
                       msg = data.code == 403 ? data.message : msg;
                       $.bootstrapGrowl(msg,{ele:'body',type:mtype,offset: {from:'top',amount:100},align:'center',width:350,delay:4000,allow_dismiss:true,stackup_spacing:10});
                   },
                   'json'
               );
           }
        });
    });

    //创建主导航提交
    $("#mainNavAddSubmit").on("click",function(evt){
      $.post("/admin/nav/add", {name:$("#mainNavAdd input[name='name']").val(), link:$("#mainNavAdd input[name='link']").val(),sort:$("#mainNavAdd input[name='sort']").val(),icon:$("#mainNavAdd input[name='icon']").val(),display:$("#mainNavAdd input[name='display']").is(':checked') },
         function(data){
             var mtype = data.status == 0 ? 'success' : 'warning';
             var msg = data.status == 0 ? '创建成功' : '创建失败！';
             msg = data.code == 403 ? data.message : msg;
             $.bootstrapGrowl(msg,{ele:'body',type:mtype,offset: {from:'top',amount:100},align:'center',width:350,delay:4000,allow_dismiss:true,stackup_spacing:10});
             if(data.status == 0){
                window.location.reload();
             }
         },
         'json'
      );
    });
 });
</script>
