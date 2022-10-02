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
								<li class="breadcrumb-item active">Form Tambah Sub Kriteria</li>
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
								Form Tambah Sub Kriteria
							</h3>
						</div>
						<div class="card-body">
							<table class="table col-md-4 mb-3">
								<thead>
									<tr>
										<th>Jenis</th>
										<th>:</th>
										<th><?= $kriteria->jenis ?></th>
									</tr>
									<tr>
										<th>Kriteria</th>
										<th>:</th>
										<th><?= $kriteria->kriteria ?></th>
									</tr>
								</thead>
							</table>
							<form action="" method="POST">
								<input type="hidden" name="id_kriteria" value="<?= $id_kriteria ?>">
								<div class="form-group">
									<label for="kriteria">Sub Kriteria*</label>
									<input type="text" name="subkriteria" placeholder="Sub Kriteria" required title="Masukkan Sub Kriteria" class="form-control" />
								</div>
								<div class="form-group">
									<label for="">Operator</label>
									<?= form_dropdown('operator', [
										'DIANTARA' => 'DIANTARA' , 
										'KURANG DARI' => '<',
										'KURANG DARI SAMA DENGAN' => '<=',
										'LEBIH DARI' => '>',
										'LEBIH DARI SAMA DENGAN' => '>=',
										'SAMA DENGAN' => '='
									], '', 'class="form-control"'); ?>
								</div>
								<div class="form-group">
									<label for="">Nilai 1</label>
									<input type="number" name="nilai_1" class="form-control" step="any">
								</div>
								<div class="form-group nilai_2_form">
									<label for="">Nilai 2</label>
									<input type="number" name="nilai_2" class="form-control" step="any">
								</div>
								<div class="form-group">
									<label for="">Nilai Profile</label>
									<input type="number" name="nilai_profile" class="form-control" step="any">
								</div>
								<div>
									<a href="<?= site_url('admin/subkriteria') ?>"><button type="button" class="btn btn-default">Batal</button></a>
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
<script>
function onChangeOperator(value) {
	if (value === 'DIANTARA') {
		$(".nilai_2_form").removeClass("d-none");
	} else {
		$(".nilai_2_form").addClass("d-none");
	}
}

$(function() {
	var operator = $("select[name='operator']").val();
	onChangeOperator(operator);
});

$("select[name='operator']").change(function() {
	var value = $(this).val();
	onChangeOperator(value);
});
</script>
</html>
