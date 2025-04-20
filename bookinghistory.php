<?php
include 'admin/database/config.php';

session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
$u = $_SESSION["userid"];
// Handle ticket cancellation
if (isset($_GET['cancel_ticket'])) {
	$book_id = $_GET['cancel_ticket'];

	$delete_query = "DELETE FROM booking WHERE book_id = $book_id AND user_id = $u";

	if (mysqli_query($conn, $delete_query)) {
		$_SESSION['response'] = "Ticket successfully canceled!";
		$_SESSION['res_type'] = "success";
	} else {
		$_SESSION['response'] = "Failed to cancel ticket.";
		$_SESSION['res_type'] = "danger";
	}

	header("Location: bookinghistory.php");
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Movie Booking</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/userstyle.css">
	<link rel="stylesheet" href="css/navbar.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
	<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<style>
		body {
			overflow-y: scroll;
			font-family: cursive;
			margin: 0;
			padding: 0;
			background: url("https://assets-in.bmscdn.com/moviesmaster/assets/rcap/3_1691759911556.jpg") repeat center center fixed;
			background-size: cover;
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

		.carousel-inner img {
			width: 100%;
			height: 500px;
			object-fit: cover;
		}
	</style>
</head>

<body>
	<nav class="navbar navbar-expand-md bg-dark" data-aos="fade-down">
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
					<li class="nav-item"><a class="nav-link" href="home1.php">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="movies1.php">Movies</a></li>
					<li class="nav-item"><a class="nav-link" href="cinema.php">Cinemas</a></li>
					<li class="nav-item"><a class="nav-link" href="aboutus.php">About Us</a></li>
					<?php if (isset($_SESSION["userid"])) { ?>
						<li class="nav-item"><a class="nav-link" href="bookinghistory.php">Booking History</a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</nav>

	<br>

	<div class="container">
		<div id="demo" class="carousel slide" data-ride="carousel" data-aos="fade-up">

			<!-- Indicators -->
			<ul class="carousel-indicators">
				<li data-target="#demo" data-slide-to="0" class="active"></li>
				<li data-target="#demo" data-slide-to="1"></li>
				<li data-target="#demo" data-slide-to="2"></li>
			</ul>

			<!-- The slideshow -->
			<div class="carousel-inner">
				<div class="carousel-item active" data-aos="zoom-in">
					<img src="images/cinema1.jpg" alt="Los Angeles">
				</div>
				<div class="carousel-item" data-aos="zoom-in" data-aos-delay="200">
					<img src="images/cinema2.jpg" alt="Chicago">
				</div>
				<div class="carousel-item" data-aos="zoom-in" data-aos-delay="300">
					<img src="images/cinema3.jpeg" alt="New York">
				</div>
			</div>

			<!-- Left and right controls -->
			<a class="carousel-control-prev" href="#demo" data-slide="prev">
				<span class="carousel-control-prev-icon"></span>
			</a>
			<a class="carousel-control-next" href="#demo" data-slide="next">
				<span class="carousel-control-next-icon"></span>
			</a>
		</div>

		<br>

		<div class="card shadow mb-4" data-aos="fade-up">
			<div class="card-body">
				<?php if (isset($_SESSION['response'])) { ?>
					<div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible text-center alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<?= $_SESSION['response']; ?>
					</div>
				<?php }
				unset($_SESSION['response']); ?>

				<div class="table-responsive">
					<?php
					$query = "SELECT b.book_id, u.name, c.cin_name, m.mov_name, s.show_date, s.show_starttime, s.show_endtime 
                              FROM booking b 
                              LEFT JOIN cinema c ON c.cin_id = b.cin_id 
                              LEFT JOIN movie m ON m.mov_id = b.mov_id 
                              LEFT JOIN showtime s ON s.show_id = b.show_id 
                              LEFT JOIN userlogin u ON u.user_id = b.user_id 
                              WHERE u.user_id = $u 
                              ORDER BY s.show_date DESC, s.show_starttime DESC";

					$result = mysqli_query($conn, $query);
					?>

					<table class="table table-bordered" id="dataTable" width="100%" cellspacing='0'>
						<thead class="thead-dark text-center">
							<tr>
								<th>Name</th>
								<th>Cinema Name</th>
								<th>Movie Name</th>
								<th>Show Date</th>
								<th>Show Starttime</th>
								<th>Show Endtime</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php $delay = 100;
							while ($row = $result->fetch_assoc()) { ?>
								<tr data-aos="fade-up" data-aos-delay="<?= $delay; ?>">
									<td><?= $row['name']; ?></td>
									<td><?= $row['cin_name']; ?></td>
									<td><?= $row['mov_name']; ?></td>
									<td><?= $row['show_date']; ?></td>
									<td><?= $row['show_starttime']; ?></td>
									<td><?= $row['show_endtime']; ?></td>
									<td class="text-center">
										<a href="display.php" class="btn btn-info btn-sm">View</a>
										<a href="bookinghistory.php?cancel_ticket=<?= $row['book_id']; ?>" class="btn btn-danger btn-sm">Cancel</a>
										<a href="share_ticket.php?book_id=<?= $row['book_id']; ?>" class="btn btn-primary btn-sm">Share</a>
									</td>
								</tr>
							<?php $delay += 100;
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
	<script>
		AOS.init({
			duration: 1000,
			once: true,
		});
	</script>
</body>

</html>
<?php
include "footer.php";
?>