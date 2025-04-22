<?php
session_start();
include "admin/database/config.php";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Step 1: Store user details in session variables
	$_SESSION['Name'] = $_POST['Name'];
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['gmail'] = $_POST['gmail'];
	$_SESSION['phone'] = $_POST['phone'];
	$_SESSION['password'] = $_POST['password'];

	// Check if username or email already exists in the database
	$username = $_POST['username'];
	$email = $_POST['gmail'];

	// Check if passwords match
	if ($_POST['password'] != $_POST['confirmPassword']) {
		$error_message = "Passwords do not match.";
		header("Location: signupp.php?message=" . urlencode($error_message));
		exit();
	}
	
	// Check if username already exists
	$sql = "SELECT * FROM userlogin WHERE username = '$username' LIMIT 1";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		$error_message = "Username already exists. Please choose a different username.";
		header("Location: signupp.php?message=" . urlencode($error_message));
		exit();
	}

	// Check if email already exists
	$sql = "SELECT * FROM userlogin WHERE email = '$email' LIMIT 1";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		$error_message = "Email already exists. Please use a different email address.";
		header("Location: signupp.php?message=" . urlencode($error_message));
		exit();
	}

	 else {
		// Redirect to OTP verification page
		header("Location: otp-verification.php");
		exit();
	}
}
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

			<form action="" method="post">
				<div class="form-group input-group mb-3">
					<span class="input-group-text"><i class="fa fa-user-circle"></i></span>
					<input class="form-control" name="Name" placeholder="Full Name" type="text" pattern="[A-Za-z\s]+" title="Only alphabets and spaces are allowed" required>
				</div>

				<div class="form-group input-group mb-3">
					<span class="input-group-text"><i class="fa fa-user"></i></span>
					<input class="form-control" name="username" placeholder="Username" type="text" pattern=".*" title="Any characters allowed" required>
				</div>

				<div class="form-group input-group mb-3">
					<span class="input-group-text"><i class="fa fa-envelope"></i></span>
					<input class="form-control" name="gmail" placeholder="Email Address" type="email" required>
				</div>

				<div class="form-group input-group mb-3">
					<span class="input-group-text"><i class="fa fa-phone"></i></span>
					<input class="form-control" name="phone" placeholder="Phone Number" type="text" pattern="\d{10}" title="Enter a 10-digit phone number" required>
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
					<button type="submit" name="send_otp" class="btn btn-primary btn-block w-100">Proceed to OTP</button>
				</div>

				<p class="text-center mt-3">Have an account? <a href="loginn.php" class="text-warning">Log In</a></p>
				<?php
				if (isset($_GET['message'])) {
					$message = $_GET['message'];
					echo "<p class='text-center text-danger'>$message</p>";
				}
				?>
			</form>
		</div>
	</div>

	<!-- Bootstrap 5 JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>