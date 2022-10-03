<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Daftar</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="theme-color" content="#0f5934">
		<meta name="msapplication-navbutton-color" content="#0f5934">
		<meta name="apple-mobile-web-app-status-bar-style" content="#0f5934">
		<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/css/adminlte.min.css">
	</head>

	<body class="hold-transition register-page">
		<div class="register-box">
			<div class="register-logo">
			</div>
			<div class="card">
				<div class="card-body register-card-body">
					<p class="login-box-msg">Daftar Siswa Baru</p>
					<?php if ($this->session->flashdata('message_register_error')) { ?>
					<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?=  $this->session->flashdata('message_register_error'); ?>
          </div>
       	 	<?php } ?>
       	 	<?php if ($this->session->flashdata('message_register_success')) { ?>
					<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?=  $this->session->flashdata('message_register_success'); ?>
          </div>
       	 	<?php } ?>
					<form action="" method="post">
						<div class="mb-3">
							<input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
						</div>
						<div class="mb-3">
							<input type="email" name="email" class="form-control" placeholder="Email" required>
						</div>
						<div class="mb-3">
							<input type="text" name="telepon" class="form-control" placeholder="Telepon">
						</div>
						<div class="mb-3">
							<textarea name="alamat" cols="5" rows="5" class="form-control" placeholder="Alamat"></textarea>
						</div>
						<div class="mb-3">
							<input type="password" name="password" class="form-control" placeholder="Password" required>
						</div>
						<div class="mb-3">
							<input type="password" name="repassword" class="form-control" placeholder="Ketik Ulang password" required>
						</div>
						<div class="row">
							<div class="col-4">
								<button type="submit" class="btn btn-primary btn-block">Daftar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>


		<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
		<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="<?= base_url() ?>assets/js/adminlte.min.js"></script>
	</body>
</html>