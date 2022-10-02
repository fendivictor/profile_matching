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
								<li class="breadcrumb-item active">Form Edit Penilaian</li>
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
								Form Edit Penilaian
							</h3>
						</div>
						<div class="card-body">
							<form action="" method="POST">
								<div class="form-group">
									<label for="siswa">Siswa</label>
									<?= form_dropdown('siswa', $siswa, $id_siswa, 'required title="Pilih Siswa" class="form-control"'); ?>
								</div>
								
								<?php 

									if ($kriteria) {
										foreach ($kriteria as $k) {

											$find = $this->penilaian_model->findNilai($id_siswa, $k->id);
											$nilai = isset($find->nilai) ? $find->nilai : 0;

											?>

								<div class="form-group">
									<label for=""><?= $k->kriteria ?></label>
									<input type="number" step="any" class="form-control" name="kriteria[<?= $k->id ?>]" value="<?= $nilai ?>">
								</div>

											<?php
										}
									}

								?>

								<div>
									<a href="<?= site_url('admin/Kriteria') ?>"><button type="button" class="btn btn-default">Batal</button></a>
									<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
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
