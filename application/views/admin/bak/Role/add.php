
<?php vHelper::regCss('jstree/themes/default/style.css'); ?>
<?php vHelper::regJs('jstree/jstree.js', 'head'); ?>

<!-- Main content -->
<section class="content col-md-6">
    <div class="box box-success">
      <div class="box-header">
        <h3 class="box-title">创建角色</h3>
      </div>

      <div class="box-body">
        <!-- form start -->
        <form role="form">
          <div class="form-group">
            <label>角色名</label>
            <input type="text" class="form-control" name="name" placeholder="">
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

          <div class="form-group">
          <label>选择角色权限</label>
          <div id="roleTree">
            <?php echo vHelper::jsTree($permissionTree); ?>
  				</div>
        </form>
      </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>

    </div>
    <!-- /.box -->
</section>
<!-- /.content -->


<!-- Page script -->
<script>
 $(function () {
     //Flat red color scheme for iCheck
     $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
       checkboxClass: 'icheckbox_flat-green',
     });

		$("#roleTree").jstree({
			"checkbox" : {
				 "keep_selected_style" : false,
         "three_state":false,
         "whole_node":false,
         "tie_selection":false,
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

			//"plugins" : [ "checkbox","contextmenu","dnd","massload","search","sort","state","types","unique","wholerow","changed","conditionalselect" ]
			"plugins" : [ "checkbox","types"]
		});

    //表单提交
    $('.btn.btn-primary').click( function () {
       var ids="";
       var nodes=$('#roleTree').jstree().get_checked();
       $.each(nodes, function(i, n) {
          ids += $("#"+n).attr('treeId')+",";
       });
       alert(ids);
    });
 });
</script>
