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
								<li class="breadcrumb-item active">List Data Siswa</li>
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
								List Data Siswa
							</h3>
						</div>
						<div class="card-body">
							<div class="form-group text-right">
								<a href="<?= site_url('admin/siswa/new') ?>" class="btn btn-primary" role="button">+ Tambah Siswa</a>
							</div>
							<table class="table">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Email</th>
										<th>Telepon</th>
										<th>Alamat</th>
										<th>Status</th>
										<th style="width: 25%;" class="txt-center">Action</th>
									</tr>
								</thead>
								<?php $sn = 1 ?>
									<tbody>
									
										<?php foreach($siswa as $s){ ?>
										<tr>
											<td>
												<div scope="row"><?= $sn ?></div>
											</td>
											<td>
												<div><?= $s->nama ?></div>
											</td>
											<td>
												<div><?= $s->email ?></div>
											</td>
											<td>
												<div><?= $s->telepon ?></div>
											</td>
											<td>
												<div><?= $s->alamat ?></div>
											</td>
											<td>
												<div><?= $s->verifikasi === '1' ? 'Terverifikasi' : 'Belum diverifikasi' ?></div>
											</td>
											
											<td>
												<div class="action">
													<a href="<?= site_url('admin/siswa/edit/'.$s->id) ?>" class="btn btn-sm btn-warning" role="button">Edit</a>
													<a href="#" 
														data-delete-url="<?= site_url('admin/siswa/delete/'.$s->id) ?>" 
														class="btn btn-sm btn-danger" 
														role="button"
														onclick="deleteConfirm(this)">Delete</a>

													<?php if ($s->verifikasi == 0) { ?>
													<a href="#" 
														data-verif-url="<?= site_url('admin/siswa/verifikasi/'.$s->id) ?>" 
														class="btn btn-sm btn-info" 
														role="button"
														onclick="verifikasi(this)">Verifikasi</a>
													<?php } ?>
												</div>
											</td>
										</tr>
										
									</tbody>
									<?php $sn++; ?>

									<?php } ?>
							</table>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>

	<?php $this->load->view('admin/_partials/footer.php') ?>

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
		function deleteConfirm(event){
			Swal.fire({
				title: 'Delete Confirmation!',
				text: 'Are you sure to delete the item?',
				icon: 'warning',
				showCancelButton: true,
				cancelButtonText: 'No',
				confirmButtonText: 'Yes Delete',
				confirmButtonColor: 'red'
			}).then(dialog => {
				if(dialog.isConfirmed){
					window.location.assign(event.dataset.deleteUrl);
				}
			});
		}

		function verifikasi(event){
			Swal.fire({
				title: 'Confirmation!',
				text: 'Apakah yakin akan memverifikasi user ini?',
				icon: 'warning',
				showCancelButton: true,
				cancelButtonText: 'No',
				confirmButtonText: 'Yes',
				confirmButtonColor: 'red'
			}).then(dialog => {
				if(dialog.isConfirmed){
					window.location.assign(event.dataset.verifUrl);
				}
			});
		}

		$(function() {
			$("table").DataTable();
		});
	</script>

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
