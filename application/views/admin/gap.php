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
								<li class="breadcrumb-item active">List Data Jenis Kriteria</li>
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
								List Data Jenis Kriteria
							</h3>
						</div>
						<div class="card-body">
							<table class="table">
								<thead>
									<tr>
										<th>No</th>
										<th>GAP</th>
										<th>Bobot</th>
										<th>Keterangan</th>
									</tr>
								</thead>
								<?php $sn = 1 ?>
									<tbody>
									
										<?php foreach($gap as $g){ ?>
										<tr>
											<td>
												<div scope="row"><?= $sn ?></div>
											</td>
											<td>
												<div><?= $g->gap ?></div>
											</td>
											<td>
												<div><?= $g->bobot ?></div>
											</td>
											<td>
												<div><?= $g->keterangan ?></div>
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
</body>

</html>
