<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL; ?>assets/images/favicon.ico">
	<!-- loader-->
	<link href="<?php echo BASE_URL; ?>assets/css/pace.min.css" rel="stylesheet" />
	<script src="<?php echo BASE_URL; ?>assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>assets/css/app.css" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>assets/css/icons.css" rel="stylesheet">
	<title><?php echo $data['title']; ?></title>
</head>

<body class="bg-forgot">
	<!-- wrapper -->
	<div class="wrapper">
		<div class="authentication-forgot d-flex align-items-center justify-content-center">
			<div class="card forgot-box">
				<div class="card-body">
					<div class="p-4 rounded  border">
						<div class="text-center">
							<img src="<?php echo BASE_URL; ?>assets/images/icons/forgot-2.png" width="120" alt="" />
						</div>
						<h4 class="mt-5 font-weight-bold">Forgot Password?</h4>
						<p class="text-muted">Enter your registered email ID to reset the password</p>
						<div class="my-4">
							<label class="form-label">Correo Electrónico</label>
							<input type="email" class="form-control form-control-lg" id="correo" placeholder="angelsifuentes2580@gmail.com" autocomplete="off" />
						</div>
						<div class="d-grid gap-2">
							<button type="button" class="btn btn-primary btn-lg" id="btnAccion">Send</button> <a href="<?php echo BASE_URL; ?>" class="btn btn-light btn-lg"><i class='bx bx-arrow-back me-1'></i>Back to Login</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- end wrapper -->
	<script>
		const base_url = '<?php echo BASE_URL; ?>';
	</script>
	<script src="<?php echo BASE_URL . 'assets/js/sweetalert2.all.min.js'; ?>"></script>
	<script src="<?php echo BASE_URL . 'assets/js/reset.js'; ?>"></script>
</body>

</html>