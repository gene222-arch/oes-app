<!DOCTYPE html>
<html lang="en">
<head>
	<title>Online Exam LOGIN</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="login-ui/image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="login-ui/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="login-ui/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="login-ui/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="login-ui/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="login-ui/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="login-ui/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="login-ui/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="login-ui/css/util.css">
	<link rel="stylesheet" type="text/css" href="login-ui/css/main.css">
	<script src="https://kit.fontawesome.com/274560d852.js" crossorigin="anonymous"></script>
	<style>
		.container-login100 {
			background-image: url("login-ui/images/kapayapaan.jpg");
			background-repeat: no-repeat;
			width: 100%;
			background-size: cover;
			height: 80vh;
			backdrop-filter: blur(3px);
		}

		.wrap-login100 {
			width: 670px;
			background: #fff;
			border-radius: 0.25rem;
			overflow: hidden;
			position: relative;
			border-top: 0.25rem solid #574B90;
		}

		.login100-form-btn {
			display: -webkit-box;
			display: -webkit-flex;
			display: -moz-box;
			display: -ms-flexbox;
			display: flex;
			justify-content: center;
			align-items: center;
			padding: 0 20px;
			min-width: 160px;
			height: 50px;
			background-color: #574B90;
			border-radius: 0.25rem;

			font-family: Poppins-Regular;
			font-size: 16px;
			color: #fff;
			line-height: 1.2;

			-webkit-transition: all 0.4s;
			-o-transition: all 0.4s;
			-moz-transition: all 0.4s;
			transition: all 0.4s;
		}

		.login100-form-title::before {
			content: "";
			display: block;
			position: absolute;
			z-index: -1;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			background-color: #574B99;
		}
</style>
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title">
				<i class="fas fa-user-shield mb-2 fa-3x text-white"></i>
					<span class="login100-form-title-1">
						Sign In As Admin
					</span>
				</div>

				<form method="post" id="adminLoginFrm" class="login100-form validate-form">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Enter username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>


					<div class="container-login100-form-btn" align="right">
						<button type="submit" class="login100-form-btn input100">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<script src="login-ui/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="login-ui/vendor/animsition/js/animsition.min.js"></script>
	<script src="login-ui/vendor/bootstrap/js/popper.js"></script>
	<script src="login-ui/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="login-ui/vendor/select2/select2.min.js"></script>
	<script src="login-ui/vendor/daterangepicker/moment.min.js"></script>
	<script src="login-ui/vendor/daterangepicker/daterangepicker.js"></script>
	<script src="login-ui/vendor/countdowntime/countdowntime.js"></script>
	<script src="login-ui/js/main.js"></script>

</body>
</html>