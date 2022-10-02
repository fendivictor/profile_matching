<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Log in</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="theme-color" content="#0f5934">
		<meta name="msapplication-navbutton-color" content="#0f5934">
		<meta name="apple-mobile-web-app-status-bar-style" content="#0f5934">
		<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/css/adminlte.min.css">
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="card">
				<div class="card-body login-card-body">
					<p class="login-box-msg">Sign in to start your session</p>
					<?php if ($this->session->flashdata('message_login_error')) { ?>
					<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?=  $this->session->flashdata('message_login_error'); ?>
          </div>
       	 	<?php } ?>
					<form action="<?= base_url() ?>Auth/login" method="post">
						<div class="input-group mb-3">
							<input type="text" class="form-control" placeholder="Username" id="username" name="username" required="required">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-envelope"></span>
								</div>
							</div>
						</div>
						<div class="input-group mb-3">
							<input type="password" class="form-control" placeholder="Password" id="password" name="password" required="required">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-lock"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-8">
								<div class="icheck-primary">
									<input type="checkbox" id="remember" name="remember" value="1">
									<label for="remember">
										Remember Me
									</label>
								</div>
							</div>
							<!-- /.col -->
							<div class="col-4">
								<button type="submit" class="btn btn-primary btn-block">Sign In</button>
							</div>
							<!-- /.col -->
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