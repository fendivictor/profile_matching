<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark navbar-success">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
		</li>
	</ul>
</nav>
<!-- /.navbar -->
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-success elevation-4">
	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<!-- <img src="http://localhost/ci-boilerplate/assets/img/avatar5.png" class="img-circle elevation-2" alt="User Image"> -->
			</div>
			<div class="info">
				<a href="#" class="d-block">SPK Profile Matching</a>
			</div>
		</div>
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column text-sm nav-flat nav-compact" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
				
				<li class="nav-item">
					<a href="<?= base_url(); ?>" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('Auth/login'); ?>" class="nav-link">
						<i class="nav-icon fas fa-lock"></i>
						<p>
							Login
						</p>
					</a>
				</li>                    
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside><!-- Content Wrapper. Contains page content -->