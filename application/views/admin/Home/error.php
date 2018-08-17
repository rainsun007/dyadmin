<?php $this->pageTitle = '服务异常'?>

<div class="error-page" style="color:#FFF;">
  <h2 class="headline text-red">500</h2>
  <div class="error-content">
    <h3><i class="fa fa-warning text-red"></i> 服务异常.</h3>
    <p><?php echo $error['msg']; ?></p>
    <p>
      可以尝试以下操作:<br /><br />
      <a href="<?php echo DyRequest::createUrl('/admin/home/index');?>">回首页</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="javascript:void(0)" onclick="history.go(-1)">返回上一页</a>
      <br /><br />
    </p>
    <p>将在 <span id="mes">10</span> 秒钟后返回上一页！</p>
  </div>
</div>

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
