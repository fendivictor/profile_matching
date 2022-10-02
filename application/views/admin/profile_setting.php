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
								<li class="breadcrumb-item active">Profile Standar</li>
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
								Profile Standar
							</h3>
						</div>
						<div class="card-body">
							<form action="" method="POST">
								<table class="table">
									<?php
										if ($kriteria) {
											foreach ($kriteria as $row => $val) {
												$subkriteria = $this->subkriteria_model->get(['id_kriteria' => $val->id]);
												$dropdownSubkriteria = [];

												$dropdownSubkriteria[0] = 'Pilih Subkriteria';
												if ($subkriteria) {
													foreach ($subkriteria as $s) {
														$dropdownSubkriteria[$s->id] = $s->sub_kriteria;
													}
												}

												$findValue = $this->profile_standar_model->find($val->id);
												$id_sub_kriteria = isset($findValue->id_sub_kriteria) ? $findValue->id_sub_kriteria : 0;
									?>

									<tr>
										<th><?= $val->kriteria ?></th>
										<td>:</td>
										<td>
											<?=
												form_dropdown('subkriteria['.$val->id.']', $dropdownSubkriteria, $id_sub_kriteria, 'class="form-control"');
											?>
										</td>
									</tr>

									<?php
											}
										}
									?>
								</table>
								<div class="form-group">
									<button class="btn btn-primary">
										Simpan
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>

	<?php $this->load->view('admin/_partials/footer.php') ?>

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<?php if($this->session->flashdata('message')): ?>
		<script>
			const Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
				timerProgressBar: true,
				didOpen: (toast) => {
					toast.addEventListener('mouseenter', Swal.stopTimer)
					toast.addEventListener('mouseleave', Swal.resumeTimer)
				}
			})

			Toast.fire({
				icon: 'success',
				title: '<?= $this->session->flashdata('message') ?>'
			})
		</script>
	<?php endif ?>
</body>

</html>
