<footer class="main-footer">
   <div class="pull-right hidden-xs">
     <b>Version</b> <?php $params = DyCfg::item('params'); echo $params['version']; ?>
   </div>
   <strong><a target="_blank" href="https://github.com/rainsun007/dyphpframework">Powered by DyphpFramework</a></strong>
 </footer>

 <!-- Control Sidebar -->
 <aside class="control-sidebar control-sidebar-dark">
   <!-- Tab panes -->
   <div class="tab-content">
     <!-- Home tab content -->
     <div class="tab-pane" id="control-sidebar-home-tab">
     </div>
     <!-- /.tab-pane -->
     <!-- Settings tab content -->
     <div class="tab-pane" id="control-sidebar-settings-tab">
     </div>
     <!-- /.tab-pane -->
   </div>
 </aside>
 <!-- /.control-sidebar -->

 <!-- Add the sidebar's background. This div must be placed  immediately after the control sidebar -->
 <div class="control-sidebar-bg"></div>


<style>
.loading_message{
    display: none; 
    background:#000 ;
    width:220px;  
    height:56px;  
    position: fixed;  
    top:20%;  
    left:50%;  
    line-height:50px;  
    color:#fff;  
    padding:3px 60px 5px 60px;  
    font-size:16px;  
    z-index:9999;  
    -moz-border-radius:20px;  
    -webkit-border-radius:20px;  
    border-radius:20px;  
    opacity: 0.7;  
    filter:progid:DXImageTransform.Microsoft.Alpha(opacity=70);  
}
</style>
<div id="loading_message" class="loading_message"><i class="fa fa-refresh fa-spin"></i> 请稍候......</div>
<script>
$(document).bind("ajaxSend", function () {
    $("#loading_message").show();
}).bind("ajaxComplete", function () {
    $("#loading_message").hide();
})  
</script>