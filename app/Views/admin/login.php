<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | ORA Finance</title>
    <meta name="author" content="ORA Finance">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url() ?>assets/images/favicon.png">
	<link href="<?php echo base_url() ?>assets/plugin/izitoast/css/iziToast.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/font-awesome.min.css" />
    <link href="<?php echo base_url() ?>assets/admin/css/app.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login_card {
            box-shadow: 0 0 3rem 0px rgb(33 37 41 / 10%);
            margin-bottom: 24px;
            border-radius: 8px;
        }

    </style>

</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Welcome back!</h1>
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card login_card">
							<div class="card-body">
								<div class="m-sm-3">
									<form action="<?= base_url('user/login') ?>" method="post">
										<?= csrf_field() ?>
										<div class="form-floating mb-3">
											<input id="username" class="form-control" type="text" name="username" placeholder="Enter your email | Mobile" />
											<label for="username">Email | Mobile</label>
										</div>
										<div class="form-floating mb-3">
											<input id="password" class="form-control" type="password" name="password" placeholder="Enter your password" />
											<label class="password">Password</label>
										</div>
										<!-- <div>
											<div class="form-check align-items-center">
												<input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me" name="remember-me" checked>
												<label class="form-check-label text-small" for="customControlInline">Remember me</label>
											</div>
										</div> -->
										<div class="d-grid gap-2 mt-3">
											<button id="submit_btn" type="submit" class="btn btn-primary">Sign in</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- <div class="text-center mb-3">
							Don't have an account? <a href="pages-sign-up.html">Sign up</a>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</main>
    <script src="<?php echo base_url() ?>assets/admin/js/app.js"></script>
	<script src="<?php echo base_url() ?>assets/plugin/izitoast/js/iziToast.min.js"></script>
    <script>
		iziToast.settings({
			'position' : 'topRight',
			'transitionIn' : 'flipInX',
			'transitionOut' : 'flipOutX',
		});
		$(document).ready(function() {
            let error =  `<?= session()->getFlashdata('error'); ?>`;
			let warning =  `<?= session()->getFlashdata('warning'); ?>`;
            let success =  `<?= session()->getFlashdata('success'); ?>`;
			if(error) {
				iziToast.error({ message : error });
			}
			if(warning) {
				iziToast.warning({ message : warning });
			}
            if(success) {
				iziToast.success({ message : success });
			}
		});
		$("#submit_btn").click(function() {
			$(this).html('<div class="spinner-border spinner-border-sm" role="status"></div> Submiting...');
		});
		function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }
		function delete_cookie(name) {
			document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
		}
		// clear cookie for menu items
		var activeItem = getCookie('activeItem');
		if(activeItem) {
			delete_cookie('activeItem');
		}
	</script>

</body>
</html>