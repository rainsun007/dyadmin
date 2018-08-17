<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <title><?php echo $this->pageTitle().'--'.DyCfg::item('appName').'--Powered by DyphpFramework'; ?></title>

  <link rel="icon" href="/favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

  <!-- Bootstrap 3.3.6 -->
  <?php ViewHelper::regCss('AdminLTE/bootstrap/css/bootstrap.min.css'); ?>
  <!-- Font Awesome -->
  <?php ViewHelper::regCss('AdminLTE/bootstrap/css/font-awesome.css'); ?>
  <!-- Theme style -->
  <?php ViewHelper::regCss('AdminLTE/dist/css/font.css'); ?>
  <!-- Theme style -->
  <?php ViewHelper::regCss('AdminLTE/dist/css/AdminLTE.css'); ?>
  <!-- AdminLTE Skins. Choose a skin from the css/skins  folder instead of downloading all of them to reduce the load. -->
  <?php ViewHelper::regCss('AdminLTE/dist/css/skins/_all-skins.min.css'); ?>
</head>

<body class="hold-transition skin-blue" style="height:100%; overflow:hidden; margin:0px; padding:0px;">
  <div class="wrapper" style="height:100%;position:absolute; width:100%;">
    <section class="content" style="padding-top:250px;">
      <?php echo $content; ?>
    </section>
  </div>
  <!-- ./wrapper -->
</body>

</html>