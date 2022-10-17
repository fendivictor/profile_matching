<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('siswa/_partials/head.php') ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm">
  <div class="wrapper">
		<?php $this->load->view('siswa/_partials/side_nav.php') ?>

		<div class="content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<!-- /.col -->
						<div class="col-sm-12">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Dashboard</li>
							</ol>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
				<!-- /.container-fluid -->
			</div>
			<section class="content">
				<div class="container-fluid">
	        <div class="card card-primary card-outline">
						<div class="card-header">
							<h3 class="card-title">
								Dashboard
							</h3>
						</div>
						<div class="card-body">
							<h5 class="mb-3">
								Hasil Penilaian
							</h5>
							<?php 
								$sortingArray = [];
								if ($siswa) {
									foreach ($siswa as $s => $val) {
										$rangking = $this->penilaian_model->findRangking($val->id);
										$sortingArray[$val->id] = $rangking;
									}
								}

								arsort($sortingArray);

								$isLulus = false;
								$jumlah = 1;
								if ($sortingArray) {
									foreach ($sortingArray as $s => $v) {
										if ($s == $this->session->userdata('nis')) {
											$isLulus = true;
										}

										$jumlah++;

										if ($jumlah > $setting->jumlah_lolos) {
											break;
										}
									}
								}

								echo ($isLulus) ? 'Selemat anda lulus' : 'Maaf, Anda belum lulus';
							?>
						</div>
					</div>
				</div>
			</section>
		</div>

	</div>
	<?php $this->load->view('siswa/_partials/footer.php') ?>
</body>
</html>
