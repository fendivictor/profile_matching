<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('admin/_partials/head.php') ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm">
  <div class="wrapper">
		<?php $this->load->view('admin/_partials/side_nav.php') ?>
		<div class="content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<!-- /.col -->
						<div class="col-sm-12">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Setting Jumlah Lolos</li>
							</ol>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
			</div>
			<section class="content">
				<div class="container-fluid">
	        <div class="card card-primary card-outline">
						<div class="card-header">
							<h3 class="card-title">
								Setting Jumlah Lolos
							</h3>
						</div>
						<div class="card-body">
							<form action="" method="POST">

								<div class="form-group">
									<label for="nama">Jumlah Lolos*</label>
									<input type="hidden" name="id" value="<?= $setting->id ?>">
									<input type="number" name="jumlah_lolos" value="<?= $setting->jumlah_lolos ?>" class="form-control col-3" required/>
								</div>
								
								<div>
									<button type="submit" name="simpan" class="btn btn-primary">Update</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	<?php $this->load->view('admin/_partials/footer.php') ?>
</body>

</html>
