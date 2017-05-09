<?php $this->pageTitle = '信息提示'?>
<div class="error-page">
  <h2 class="headline text-yellow"> <?php echo $message['code']; ?></h2>
  <div class="error-content">
    <h3><i class="fa fa-bullhorn"></i> 提示信息</h3>
    <p>   
        <div class="callout callout-<?php echo $message['callout'];?>">
            <h4><?php echo $message['status'];?></h4>
            <p><?php echo $message['message']; ?></p>
        </div>
    </p>
    <p>可以尝试以下操作:<br /><a href="/dashboard">回首页</a> | <a href="javascript:void(0)" onclick="history.go(-1)">返回上一页</a></p>
    <p>将在 <span id="mes">6</span> 秒钟后返回上一页！</p>
  </div>
</div>

<script language="javascript" type="text/javascript">
  var i = 6;
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
