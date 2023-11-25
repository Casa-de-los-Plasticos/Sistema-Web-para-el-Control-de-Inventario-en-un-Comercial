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

<body>
	<!-- wrapper -->
	<div class="wrapper">
		<div class="authentication-reset-password d-flex align-items-center justify-content-center">
			<div class="row">
				<div class="col-12 col-lg-10 mx-auto">
					<div class="card">
						<div class="row g-0">
							<div class="col-lg-5 border-end">
								<div class="card-body">
									<div class="p-5">
										<div class="text-start">
											<img src="<?php echo BASE_URL; ?>assets/images/logo-img.png" width="180" alt="">
										</div>
										<input type="hidden" id="token" value="<?php echo $data['seguridad']['token']; ?>">
										<h4 class="mt-5 font-weight-bold">Genrate New Password</h4>
										<p class="text-muted">We received your reset password request. Please enter your new password!</p>
										<div class="mb-3 mt-5">
											<label class="form-label">Nueva Clave <span class="text-danger fw-bold">*</span></label>
											<input type="text" class="form-control" id="nueva_clave" placeholder="Enter new password" />
										</div>
										<div class="mb-3">
											<label class="form-label">Confirmar Clave <span class="text-danger fw-bold">*</span></label>
											<input type="text" class="form-control" id="confirmar_clave" placeholder="Confirm password" />
										</div>
										<div class="d-grid gap-2">
											<button type="button" class="btn btn-primary" id="btnAccion">Change Password</button> <a href="<?php echo BASE_URL; ?>" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Back to Login</a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-7">
								<img src="<?php echo BASE_URL; ?>assets/images/login-images/forgot-password-frent-img.jpg" class="card-img login-img h-100" alt="...">
							</div>
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
	<script src="<?php echo BASE_URL . 'assets/js/restablecer.js'; ?>"></script>
</body>

</html>