<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<!-- Tell the browser to be responsive to screen width -->
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1, user-scalable=no" />
	<meta name="renderer" content="webkit|ie-comp|ie-stand" />
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<title>
		<?php echo $this->pageTitle().'-'.DyCfg::item('appName').'-Powered By DyAdmin'; ?>
	</title>

	<link rel="icon" href="/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

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
	<!-- gototop -->
	<?php ViewHelper::regCss('gototop/css/ui.totop.css'); ?>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
    	<?php $this->loadJs(ViewHelper::getStaticPath('AdminLTE/bootstrap/js/html5shiv.min.js')); ?>
	<?php $this->loadJs(ViewHelper::getStaticPath('AdminLTE/bootstrap/js/respond.min.js')); ?>
	<![endif]-->

	<!-- jQuery 2.2.3 -->
	<?php ViewHelper::regJs('jquery-2.2.3.min.js', 'head'); ?>
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
	<!-- gototop -->
	<?php ViewHelper::regJs('gototop/js/jquery.ui.totop.min.js', 'foot'); ?>
	<?php ViewHelper::regJs('gototop/js/easing.js', 'foot'); ?>
	<?php ViewHelper::regJs('gototop/js/top.js', 'foot'); ?>
	<!-- layui -->
	<?php ViewHelper::regJs('layui/layui.js', 'head'); ?>
	<?php ViewHelper::regCss('layui/css/layui.css'); ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php $this->renderPartial('/Layout/header', array(), 'admin'); ?>
		<?php $this->renderPartial('/Layout/navBar', array(), 'admin'); ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					<?php echo $this->getData('breadcrumbMain'); ?>
					<small>
						<?php echo DyCfg::item('appName'); ?>
					</small>
				</h1>
				<ol class="breadcrumb">
					<li>
						<a href="#">
							<i class="fa fa-fw fa-hand-o-right"></i>
							<?php echo $this->getData('breadcrumbMain'); ?>
						</a>
					</li>
					<li class="active">
						<?php echo $this->getData('breadcrumbActive'); ?>
					</li>
				</ol>
			</section>
			<section class="content">
				<?php echo $content; ?>
			</section>
		</div>
		<!-- /.content-wrapper -->

		<?php $this->renderPartial('/Layout/footer', array(), 'admin'); ?>
		<!-- 引入通用工具 -->
		<?php $this->renderPartial('/ViewTools/common', array(), 'admin');?>
	</div>
	<!-- ./wrapper -->
	<?php DyDebug::show(); ?>
</body>

</html>