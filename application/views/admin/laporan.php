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
								<li class="breadcrumb-item active">Laporan</li>
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
								Laporan
							</h3>
						</div>
						<div class="card-body">
							<form class="row" method="get">
								<div class="col-3 form-group">
									<label for="">Tahun Masuk</label>
									<input type="number" name="tahun" value="<?= date('Y') ?>" class="form-control">
								</div>
								<div class="col-3 form-group">
									<label for="">Kelas</label>
									<select name="kelas" class="form-control">
										<option value="">Pilih Kelas</option>
										<option value="VII">VII</option>
										<option value="VIII">VIII</option>
										<option value="IX">IX</option>
									</select>
								</div>
								<div class="col-3 form-group">
									<button class="btn btn-primary" style="margin-top: 30px;">
										<i class="fa fa-search"></i> Cari
									</button>
								</div>
							</form>

							<h5 class="my-3">
								Rekomendasi
							</h5>

							<table class="table" id="tb-rekomendasi">
								<thead>
									<tr>
										<th>Nama Alternatif</th>
										<th class="text-center">Nilai</th>
									</tr>
								</thead>
								<tbody>
								<?php 
									$sortingArray = [];
									if ($siswa) {
										foreach ($siswa as $s => $val) {
											$rangking = $this->penilaian_model->findRangking($val->id);
											$sortingArray[$val->id] = $rangking;
										}
									}

									arsort($sortingArray);

									$rankArray = [];
									$jumlah = 1;
									if ($sortingArray) {
										foreach ($sortingArray as $s => $v) {
											$siswa = $this->siswa_model->find($s);
											$rankArray[] = [
												'id' => $s,
												'nama' => $siswa->nama,
												'rangking' => $v
											];

											$jumlah++;

											if ($jumlah > $setting->jumlah_lolos) {
												break;
											}
										}
									}

									if ($rankArray) {
										foreach ($rankArray as $s => $val) {
											echo '<tr>';
											echo '<td>'.$val['nama'].'</td>';
											echo '<td class="text-center">'.$val['rangking'].'</td>';
											echo '</tr>';
										}
									}
								?>
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
	<script>
		$("#tb-rekomendasi").DataTable({
			order: [[
				1, 'desc'
			]],
			paging: false,
			searching: false,
			info: false
		})
	</script>
</html>
