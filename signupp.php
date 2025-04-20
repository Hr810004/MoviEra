<?php
include "admin/database/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Create Account</title>

	<!-- Bootstrap 5 CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- FontAwesome for Icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	<!-- Custom Styles -->
	<style>
		body {
			margin: 0;
			padding: 0;
			background: url("https://assets-in.bmscdn.com/moviesmaster/assets/rcap/1_(2)_1691759919866.jpg") no-repeat center center fixed;
			background-size: cover;
			font-family: sans-serif;
		}

		.overlay {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: rgba(0, 0, 0, 0.6);
			/* Dark overlay for readability */
		}

		.card {
			background: rgba(0, 0, 0, 0.85);
			color: white;
			border-radius: 10px;
			padding: 30px;
			width: 480px;
			box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.2);
			opacity: 0;
			transform: translateY(20px);
			animation: fadeUp 0.6s ease-out forwards;
		}

		@keyframes fadeUp {
			from {
				opacity: 0;
				transform: translateY(20px);
			}

			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		.form-control {
			background: #2a2a2a;
			color: white !important;
			border: 1px solid #444;
			font-size: 16px;
			padding: 12px;
		}

		.form-control::placeholder {
			color: rgba(255, 255, 255, 0.7);
		}

		.form-control:focus {
			background: #333;
			color: white !important;
			border-color: #ff4444;
			box-shadow: none;
		}

		.btn-primary {
			background: linear-gradient(45deg, #ff4444, #ff8844);
			border: none;
			padding: 12px;
			transition: 0.3s;
			border-radius: 5px;
			font-size: 16px;
		}

		.btn-primary:hover {
			background: linear-gradient(45deg, #ff8844, #ff4444);
		}

		.input-group-text {
			background: #ff4444;
			color: white;
			border: none;
			font-size: 18px;
		}
	</style>
</head>

<body>
	<div class="overlay d-flex justify-content-center align-items-center">
		<div class="card">
			<h3 class="text-center">Create Account</h3>

			<form action="signupcode.php" method="post">
				<div class="form-group input-group mb-3">
					<span class="input-group-text"><i class="fa fa-user-circle"></i></span>
					<input class="form-control" name="Name" placeholder="Full Name" type="text" required>
				</div>

				<div class="form-group input-group mb-3">
					<span class="input-group-text"><i class="fa fa-user"></i></span>
					<input class="form-control" name="username" placeholder="Username" type="text" required>
				</div>

				<div class="form-group input-group mb-3">
					<span class="input-group-text"><i class="fa fa-envelope"></i></span>
					<input class="form-control" name="gmail" placeholder="Email Address" type="email" required>
				</div>

				<div class="form-group input-group mb-3">
					<span class="input-group-text"><i class="fa fa-phone"></i></span>
					<input class="form-control" name="phone" placeholder="Phone Number" type="text" minlength="10" maxlength="10" required>
				</div>

				<div class="form-group input-group mb-3">
					<span class="input-group-text"><i class="fa fa-lock"></i></span>
					<input class="form-control" name="password" placeholder="Create Password" type="password" required>
				</div>

				<div class="form-group input-group mb-3">
					<span class="input-group-text"><i class="fa fa-lock"></i></span>
					<input class="form-control" name="confirmPassword" placeholder="Repeat Password" type="password" required>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block w-100" name="signup_btn">Create Account</button>
				</div>

				<p class="text-center mt-3">Have an account? <a href="loginn.php" class="text-warning">Log In</a></p>
			</form>
		</div>
	</div>

	<!-- Bootstrap 5 JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>