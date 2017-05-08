<?php $this->pageTitle = '信息提示'?>
<div class="error-page">
  <h2 class="headline text-yellow"> <?php echo $message['code']; ?></h2>
  <div class="error-content">
    <h3><i class="fa fa-bullhorn"></i> 提示信息</h3>
    <p>   
        <?php $staus = $message['status'] == 'error' ? 'danger' : $message['status'];?> 
        <?php $staus = $message['status'] === 0 ? 'warning' : $message['status'];?> 
        <?php $staus = $message['status'] === 1 ? 'success' : $message['status'];?> 
        <div class="callout callout-<?php echo $staus;?>">
            <h4><?php echo $staus;?></h4>
            <p><?php echo $message['message']; ?></p>
        </div>
    </p>
    <?php if ($message['code'] == 401): ?>
    <p>账号已经被禁用，请联系管理员！</p>
    <?php else:?>
    <p>可以尝试以下操作:<br /><a href="/dashboard">回首页</a> | <a href="javascript:void(0)" onclick="history.go(-1)">返回上一页</a></p>
    <p>将在 <span id="mes">10</span> 秒钟后返回上一页！</p>
    <?php endif; ?>
  </div>
</div>

<?php if ($message['code'] != 401): ?>
<script language="javascript" type="text/javascript">
var i = 10;
var intervalid;
intervalid = setInterval("goBack()", 1000);
function goBack() {
  if (i == 0) {
    history.go(-1);
    clearInterval(intervalid);
  }
  document.getElementById("mes").innerHTML = i;
  i--;
}
</script>
<?php endif; ?>
