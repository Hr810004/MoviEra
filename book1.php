<?php
session_start();
include 'admin/database/config.php';

if (isset($_SESSION["userid"])) {
	if (isset($_GET["cin_id"]) && isset($_GET["show_id"]) && isset($_GET["mov_id"])) {
		$_SESSION["cin_id"] = $_GET['cin_id'];
		$_SESSION["show_id"] = $_GET['show_id'];
		$_SESSION["mov_id"] = $_GET['mov_id'];
	}



	$c = $_SESSION["cin_id"] ?? "";
	$m = $_SESSION["mov_id"] ?? "";
	$s = $_SESSION["show_id"] ?? "";
	$u = $_SESSION["userid"];

	$myArr = array();
	if ($m && $s && $c) {
		$query = "SELECT book_seat FROM booking WHERE mov_id=$m AND show_id=$s AND cin_id=$c";
		$resultset = mysqli_query($conn, $query) or die("database error:" . mysqli_error($conn));
		while ($record = mysqli_fetch_array($resultset)) {
			$ex = explode(',', $record['book_seat']);
			foreach ($ex as $out) {
				$myArr[] = $out;
			}
		}
	}
} else {
	$_SESSION["iv_user"] = "Please Login To Book Ticket <a href='loginn.php'>Login</a>";
	header("Location: home1.php");
	exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/navbar.css">
	<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
	<link rel="stylesheet" href="css/navbar.css">
	<style>
		body {
			margin: 0;
			padding: 0;
			background: url("https://rajhanscinemas.com/CinemaImages/s4.jpg") repeat center center fixed;
			background-size: cover;
			font-family: cursive;
			color: white;
			position: relative;
			z-index: 1;
		}

		body::before {
			content: "";
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: rgba(20, 20, 20, 0.91);
			background-repeat: repeat;
			z-index: -1;
		}

		.container {
			display: flex;
			justify-content: center;
		}

		.wrapper {
			display: grid;
			grid-template-columns: repeat(11, 1fr);
			grid-gap: 0.5em;
		}

		.seattable {
			width: 700px;
			padding: 3.5vw;
			background: rgba(128, 128, 128, 0.34);
		}
	</style>
	<script type="text/javascript">
		var values = [];
		var pricePerSeat = 200;

		// Pass PHP session values into JavaScript
		var mov_id = "<?php echo $_SESSION['mov_id'] ?? ''; ?>";
		var cin_id = "<?php echo $_SESSION['cin_id'] ?? ''; ?>";
		var show_id = "<?php echo $_SESSION['show_id'] ?? ''; ?>";

		$(document).ready(function() {
			$(".sat").click(function() {
				var uid = this.id;

				if (values.includes(uid)) {
					$(this).attr("src", "seat-empty.png");
					values.splice(values.indexOf(uid), 1);
				} else {
					$(this).attr("src", "seat-selected.png");
					values.push(uid);
				}
				updateTotal();
			});

			$("#btn_seat_book").click(function() {
				if (values.length === 0) {
					alert("Please select at least one seat.");
					return;
				}
				var totalPrice = values.length * pricePerSeat;
				window.location.href = "payment.php?seats=" + values.join(",") +
					"&price=" + totalPrice +
					"&mov_id=" + mov_id +
					"&cin_id=" + cin_id +
					"&show_id=" + show_id;
			});
		});

		function updateTotal() {
			var total = values.length * pricePerSeat;
			$("#total_price").text("Total Price: ₹" + total);
		}
	</script>

</head>

<body>


	<nav class="navbar navbar-expand-md bg-dark border2">
		<div class="container">
			<a href="home1.php" class="navbar-brand brand">
				<h2>Movi<span style="color: cyan;">era</span></h2>
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav">
					<li class="nav-item">
						<?php if (isset($_SESSION["userid"])) { ?>
							<a class="nav-link" href="logout.php">Logout</a>
						<?php } else { ?>
							<a class="nav-link" href="loginn.php">Signup/Login</a>
						<?php } ?>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item move"><a class="nav-link" href="home1.php">Home</a></li>
					<li class="nav-item move"><a class="nav-link" href="movies1.php">Movies</a></li>
					<li class="nav-item move"><a class="nav-link" href="cinema.php">Cinemas</a></li>
					<li class="nav-item move"><a class="nav-link" href="aboutus.php">About Us</a></li>
					<?php if (isset($_SESSION["userid"])) { ?>
						<li class="nav-item"><a class="nav-link" href="bookinghistory.php">Booking History</a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<div class="seattable">
			<div class="wrapper">
				<?php for ($i = 0; $i <= 10; $i++) { ?>
					<h5 style="color:white"><?php echo ($i == 0) ? "" : $i; ?></h2>
					<?php } ?>
			</div>

			<?php
			$rows = range('A', 'J');
			foreach ($rows as $row) {
				echo '<div class="wrapper"><h3 style="color:white">' . $row . '</h3>';
				for ($i = 1; $i <= 10; $i++) {
					$seatId = $row . $i;
					$imgSrc = in_array($seatId, $myArr) ? "seat-booked.png" : "seat-empty.png";
					$clickable = in_array($seatId, $myArr) ? "" : "class='sat'";
					echo "<img $clickable id='$seatId' src='$imgSrc' height='40px'>";
				}
				echo '</div>';
			}

			?>

			<ul>
				<li style="color:white"><span><img src="seat-selected.png" height="24px"></span> Selected Seat</li>
				<li style="color:white"><span><img src="seat-booked.png" height="24px"></span> Reserved Seat</li>
				<li style="color:white"><span><img src="seat-empty.png" height="24px"></span> Empty Seat</li>
			</ul>

			<h3 id="total_price" style="color:white">Total Price: ₹0</h3>
			<button type="button" id="btn_seat_book" class="btn btn-warning btn-lg btn-block">Pay Now</button>
		</div>
	</div>
</body>

</html>