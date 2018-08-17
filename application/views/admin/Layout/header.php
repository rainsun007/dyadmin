<header class="main-header">
	<!-- Logo -->
	<a href="/admin/home/index" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini">
			<b>DYA</b>
		</span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg">
			<b>
				<?php echo DyCfg::item('appName'); ?>
			</b>
		</span>
	</a>

	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only"></span>
		</a>
		<!-- Navbar Right Menu -->
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<?php if (Common::checkPermit('/admin/permit/flushCache')): ?>
				<li>
					<a href="#" id="flush_all_cache">
						<i class="fa fa-database"></i>
					</a>
				</li>
				<?php endif;?>
				<li>
					<a href="#" data-toggle="control-sidebar">
						<i class="fa fa-gears"></i>
					</a>
				</li>
			</ul>
		</div>

	</nav>
</header>