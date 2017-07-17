<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/static/AdminLTE/dist/img/avatar<?php  $ex = array('.jpg','.png'); echo rand(1,5).$ex[array_rand($ex)];?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo Dy::app()->auth->username; ?></p>
          <span id="user_edit" class="label label-info" style="cursor:pointer">编辑</span> <a href="/app/logout?m=admin"><span class="label label-danger">退出</span></a>
        </div>
      </div>
      

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header" style="white-space:normal;width:100%">
        <div style="width:100%;color:#FFF;word-wrap:break-word;word-break:break-all;border-bottom:solid 1px #333;">
        <?php echo isset($userRolesName) ? '角色(组)：'.implode(',', $userRolesName) : ''; ?>
        </div>
        </li>
        <?php if (isset($navTree)): foreach ($navTree as $key => $val):?>
          <?php
          if (!Common::checkPermit($val['id'])) {
              continue;
          }
          ?>
          <li treeId="<?php echo $val['id']; ?>" class="treeview">
            <a href="#">
              <i class="<?php echo $val['icon']; ?>"></i> <span><?php echo $val['name']; ?></span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
              <?php if (isset($val['child']) && is_array($val['child'])): ?>
              <ul class="treeview-menu">
              <?php foreach ($val['child'] as $k => $v):?>
              <?php
                  if (!Common::checkPermit($v['id'])) {
                      continue;
                  }
                  $itemActive = '';
                  $link = trim($v['link'], '/');
                  if (!empty($link) && strcasecmp(Dy::app()->module.'/'.Dy::app()->cid.'/'.Dy::app()->aid, trim($link, '/')) == 0) {
                      $itemActive = 'active';
                      $this->setData('breadcrumbMain', $val['name']);
                      $this->setData('breadcrumbActive', $v['name']);
                  }
              ?>
              <li <?php echo $itemActive ? 'class="'.$itemActive.'"' : ''; ?> pid="<?php echo $v['pid']; ?>"><a <?php echo $itemActive ? 'style="color:#FFF"' : ''; ?> href="<?php echo $v['link']; ?>"><i class="<?php echo $v['icon']; ?>"></i> <?php echo $v['name']; ?></a></li>
              <?php endforeach; ?>
              </ul>
              <?php endif; ?>
          </li>
        <?php endforeach; endif; ?>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>



<div class="modal fade" id="userEditOpModal" treeData='' tabindex="-1" role="dialog" aria-labelledby="permitOpModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">个人信息编辑</h4>
      </div>
      <div class="modal-body">
        <form id="navOp">
          <div class="form-group">
            <label>真实姓名<span class="text-red">*</span></label>
            <input type="text" class="form-control" name="user_realname" id="user_realname" value="<?php echo $userInfo->realname;?>" placeholder="个人的真实姓名">
          </div>

          <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="user_email" id="user_email" value="<?php echo $userInfo->email;?>" placeholder="邮箱地址">
          </div>

          <div class="form-group">
            <label>密码</label>
            <input type="text" class="form-control" name="user_password" id="user_password" placeholder="password">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="userEditOpModalSubmit" type="button" class="btn btn-primary">submit</button>
      </div>
    </div>
  </div>
</div>


<script>
//nav bar active menu
$(document).ready(function(){
    $(".sidebar-menu > li > ul.treeview-menu").each(function(index, domEle){
      var activePid = 0;
       $('li').each(function(i, e){
           if($(e).attr("class") == "active"){
             activePid = $(e).attr("pid");
             return false;
           }
       });

      if(activePid > 0 && $(domEle).parent().attr("treeId") == activePid){
          $(domEle).parent().attr("class","active treeview");
          return false;
      }

    });

    $('#user_edit').on("click", function(){
        $('#userEditOpModal').modal({keyboard: true});
    });
    $('#userEditOpModalSubmit').on("click", function(){
        $('#userEditOpModal').modal('hide');
        var url = '/admin/user/userEdit';
        var postData = {realname:$('#user_realname').val(),password:$("#user_password").val(),email:$("#user_email").val()};
        $.post(url, postData,
           function(data){
               var mtype = data.status == 0 ? 'success' : 'warning';
               $.bootstrapGrowl(data.message,{ele:'body',type:mtype,offset: {from:'top',amount:100},align:'center',width:350,delay:2000,allow_dismiss:true,stackup_spacing:10});
           },
           'json'
        );
    });

});
</script>
