<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php echo $this->pageTitle(); ?>--
    <?php echo DyCfg::item('appName'); ?>--Powered by DyphpFramework</title>
  <link rel="icon" href="/favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <?php ViewHelper::regCss('AdminLTE/bootstrap/css/bootstrap.min.css'); ?>
  <!-- Font Awesome -->
  <?php ViewHelper::regCss('AdminLTE/bootstrap/css/font-awesome.css'); ?>
  <!-- Ionicons -->
  <?php ViewHelper::regCss('AdminLTE/bootstrap/css/ionicons.css'); ?>
  <!-- jvectormap -->
  <?php ViewHelper::regCss('AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css'); ?>
  <!-- Theme style -->
  <?php ViewHelper::regCss('AdminLTE/dist/css/font.css'); ?>
  <!-- daterange picker -->
  <?php ViewHelper::regCss('AdminLTE/plugins/daterangepicker/daterangepicker.css'); ?>
  <!-- bootstrap datepicker -->
  <?php ViewHelper::regCss('AdminLTE/plugins/datepicker/datepicker3.css'); ?>
  <!-- iCheck for checkboxes and radio inputs -->
  <?php ViewHelper::regCss('AdminLTE/plugins/iCheck/all.css'); ?>
  <!-- Bootstrap Color Picker -->
  <?php ViewHelper::regCss('AdminLTE/plugins/colorpicker/bootstrap-colorpicker.min.css'); ?>
  <!-- Bootstrap time Picker -->
  <?php ViewHelper::regCss('AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css'); ?>
  <!-- Select2 -->
  <?php ViewHelper::regCss('AdminLTE/plugins/select2/select2.min.css'); ?>
  <!-- Theme style -->
  <?php ViewHelper::regCss('AdminLTE/dist/css/AdminLTE.css'); ?>
  <!-- AdminLTE Skins. Choose a skin from the css/skins  folder instead of downloading all of them to reduce the load. -->
  <?php ViewHelper::regCss('AdminLTE/dist/css/skins/_all-skins.min.css'); ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <?php $this->loadJs(ViewHelper::getStaticPath('AdminLTE/bootstrap/js/html5shiv.min.js')); ?>
    <?php $this->loadJs(ViewHelper::getStaticPath('AdminLTE/bootstrap/js/respond.min.js')); ?>
    <![endif]-->

  <!-- jQuery 2.2.3 -->
  <?php ViewHelper::regJs('AdminLTE/plugins/jQuery/jquery-2.2.3.min.js', 'head'); ?>
  <!-- Bootstrap 3.3.6 -->
  <?php ViewHelper::regJs('AdminLTE/bootstrap/js/bootstrap.min.js', 'head'); ?>
  <!-- Select2 -->
  <?php ViewHelper::regJs('AdminLTE/plugins/select2/select2.full.min.js', 'head'); ?>
  <!-- InputMask -->
  <?php ViewHelper::regJs('AdminLTE/plugins/input-mask/jquery.inputmask.js', 'head'); ?>
  <?php ViewHelper::regJs('AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js', 'head'); ?>
  <?php ViewHelper::regJs('AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js', 'head'); ?>
  <!-- date-range-picker -->
  <?php ViewHelper::regJs('AdminLTE/dist/js/moment.min.js', 'head'); ?>
  <?php ViewHelper::regJs('AdminLTE/plugins/daterangepicker/daterangepicker.js', 'head'); ?>
  <!-- bootstrap datepicker -->
  <?php ViewHelper::regJs('AdminLTE/plugins/datepicker/bootstrap-datepicker.js', 'head'); ?>
  <!-- bootstrap color picker -->
  <?php ViewHelper::regJs('AdminLTE/plugins/colorpicker/bootstrap-colorpicker.min.js', 'head'); ?>
  <!-- bootstrap time picker -->
  <?php ViewHelper::regJs('AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js', 'head'); ?>
  <!-- FastClick -->
  <?php ViewHelper::regJs('AdminLTE/plugins/fastclick/fastclick.js', 'head'); ?>
  <!-- AdminLTE App -->
  <?php ViewHelper::regJs('AdminLTE/dist/js/app.min.js', 'head'); ?>
  <!-- Sparkline -->
  <?php ViewHelper::regJs('AdminLTE/plugins/sparkline/jquery.sparkline.min.js', 'head'); ?>
  <!-- jvectormap -->
  <?php ViewHelper::regJs('AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js', 'head'); ?>
  <?php ViewHelper::regJs('AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js', 'head'); ?>
  <!-- SlimScroll 1.3.0 -->
  <?php ViewHelper::regJs('AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js', 'head'); ?>
  <!-- iCheck 1.0.1 -->
  <?php ViewHelper::regJs('AdminLTE/plugins/iCheck/icheck.min.js', 'head'); ?>
  <!-- ChartJS 1.0.1 -->
  <?php ViewHelper::regJs('AdminLTE/plugins/chartjs/Chart.min.js', 'head'); ?>
  <!-- jquery.bootstrap-growl -->
  <?php ViewHelper::regJs('AdminLTE/bootstrap/js/jquery.bootstrap-growl.js', 'head'); ?>
  <!-- AdminLTE for purposes -->
  <?php ViewHelper::regJs('AdminLTE/dist/js/purposes.js', 'foot'); ?>
</head>

<body class="hold-transition skin-blue" style="height:100%; overflow:hidden; margin:0px; padding:0px;">
  <div class="wrapper" style="height:100%;position:absolute; width:100%;">
    <section class="content">
      <?php echo $content; ?>
    </section>
  </div>
  <!-- ./wrapper -->
</body>

</html>