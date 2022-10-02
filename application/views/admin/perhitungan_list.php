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
								<li class="breadcrumb-item active">Perhitungan</li>
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
								Perhitungan
							</h3>
						</div>
						<div class="card-body">
							<table class="table">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Kriteria</th>
										<th>Nilai Siswa</th>
										<th>Nilai Profil</th>
										<th>Nilai Profil Ideal</th>
										<th>GAP</th>
										<th>Bobot Nilai GAP</th>
										<th>Kriteria</th>
										<th>Nilai Total</th>
										<th>Ranking</th>
									</tr>
								</thead>
								<tbody>
								<?php $sn = 1 ?>
									
										<?php foreach($penilaian as $s){ 
												$findRataRata = $this->penilaian_model->findNilaiRataRata($s->id_siswa, $s->nilai_factor);
												$nilaiRataRata = isset($findRataRata->avg_gap) ? $findRataRata->avg_gap : 0;

												$rangking = $this->penilaian_model->findRangking($s->id_siswa);
											?>
										<tr>
											<td>
												<div scope="row"><?= $sn ?></div>
											</td>
											<td>
												<div><?= $s->nama ?></div>
											</td>
											<td>
												<div><?= $s->kriteria ?></div>
											</td>
											<td>
												<div class="text-center"><?= $s->nilai ?></div>
											</td>
											<td>
												<div class="text-center"><?= $s->nilai_profil ?></div>
											</td>
											<td>
												<div class="text-center"><?= $s->nilai_ideal ?></div>
											</td>
											<td>
												<div class="text-center"><?= $s->gap ?></div>
											</td>
											<td>
												<div class="text-center"><?= $s->nilai_gap ?></div>
											</td>
											<td>
												<div><?= $s->jenis ?></div>
											</td>
											<td>
												<div class="text-center"><?= $nilaiRataRata ?></div>
											</td>
											<td>
												<div class="text-center"><?= $rangking ?></div>
											</td>
										</tr>
									<?php $sn++; ?>

									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>

	<?php $this->load->view('admin/_partials/footer.php') ?>
</body>

</html>
