<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/static/AdminLTE/dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo Dy::app()->auth->username; ?></p>
          <a href="/app/logout?m=admin">退出</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header" style="color:#FFF"><?php echo isset($userRolesName) ? '角色：'.implode(',', $userRolesName) : ''; ?></li>

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
});
</script>
