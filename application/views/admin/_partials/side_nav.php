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
				<img src="<?= base_url(); ?>assets/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block">
					<?= ucfirst($this->session->userdata('username')); ?>
				</a>
			</div>
		</div>
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column text-sm nav-flat nav-compact" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
				<li class="nav-item">
					<a href="<?= base_url('admin') ?>" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/Jenis_kriteria') ?>" class="nav-link">
						<i class="nav-icon fas fa-folder"></i>
						<p>
							Jenis Kriteria
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/Kriteria') ?>" class="nav-link">
						<i class="nav-icon fas fa-folder"></i>
						<p>
							Kriteria
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/profile') ?>" class="nav-link">
						<i class="nav-icon fas fa-folder"></i>
						<p>
							Profile Standar
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/Siswa') ?>" class="nav-link">
						<i class="nav-icon fas fa-folder"></i>
						<p>
							Siswa
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/penilaian') ?>" class="nav-link">
						<i class="nav-icon fas fa-folder"></i>
						<p>
							Penilaian
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/perhitungan') ?>" class="nav-link">
						<i class="nav-icon fas fa-folder"></i>
						<p>
							Perhitungan
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="javascript:;" class="nav-link" id="btn-logout">
						<i class="nav-icon fas fa-lock"></i>
						<p>
							Log Out
						</p>
					</a>
				</li>                    
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside><!-- Content Wrapper. Contains page content -->