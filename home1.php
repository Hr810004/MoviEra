<?php
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>MyMovie - Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/userstyle.css">
	<link rel="stylesheet" href="css/navbar.css"> <!-- Link new navbar styles -->

	<!-- Boxicons for Icons -->
	<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

	<!-- AOS (Animate On Scroll) Library -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

	<!-- jQuery and Bootstrap Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<style>
		body {
			margin: 0;
			padding: 0;
			background: url("https://assets-in.bmscdn.com/moviesmaster/assets/rcap/5_1691759900425.jpg") repeat center center fixed;
			background-size: cover;
			font-family: sans-serif;
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
			/* Ensures the image takes the full width of the container */
			height: 500px;
			/* Adjust height as needed */
			object-fit: cover;
			/* Crops the image while maintaining aspect ratio */
		}

		.card.card-color {
			height: 400px;
			/* Set a fixed height for cinema cards */
			display: flex;
			flex-direction: column;
		}

		.card-img-top {
			width: 100%;
			height: 220px;
			/* Fixed height for images */
			object-fit: cover;
			/* Ensures images fill the space without distortion */
			border-radius: 8px;
			/* Optional: Adds smooth corners */
		}

		.card-body {
			flex-grow: 1;
			display: flex;
			flex-direction: column;
			justify-content: space-between;
			text-align: center;
			/* Ensures uniform alignment */
		}
	</style>
</head>

<body>

	<!-- Include Navbar -->
	<?php include 'navbar.php'; ?>

	<div class="container">
		<div id="demo" class="carousel slide" data-aos="fade-up" data-aos-delay="100" data-ride="carousel">

			<!-- Indicators -->
			<ul class="carousel-indicators">
				<li data-target="#demo" data-slide-to="0" class="active"></li>
				<li data-target="#demo" data-slide-to="1"></li>
				<li data-target="#demo" data-slide-to="2"></li>
			</ul>

			<!-- The slideshow -->
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="images/cinema1.jpg" alt="Los Angeles">
				</div>
				<div class="carousel-item">
					<img src="images/cinema2.jpg" alt="Chicago">
				</div>
				<div class="carousel-item">
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

		<!-- Trending Movies Section -->
		<h5 data-aos="fade-up" data-aos-delay="200">Trending Movies</h5>
		<div class="row">
			<?php
			include 'admin/database/config.php';
			$query = "SELECT * FROM movie WHERE mov_status='Running Movies' AND mov_trend='Trending movie'";
			$resultset = mysqli_query($conn, $query) or die("Database error: " . mysqli_error($conn));
			while ($record = mysqli_fetch_assoc($resultset)) {
			?>
				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6" data-aos="fade-up" data-aos-delay="600">
					<div class="card card-color border-light text-white shadow">
						<div class="inner">
							<img src="admin/<?php echo $record['mov_image']; ?>" class="card-img-top" width="300px">
						</div>
						<div class="card-body">
							<h4 class="card-title"><?php echo $record['mov_name']; ?></h4>
							<h6 class="card-subtitle mb-2 text-muted"><?php echo $record['mov_type']; ?></h6>
							<a class="btn btn-outline-danger btn-block a_color" href="showtime_movie.php?id=<?php echo urlencode(base64_encode($record["mov_id"])); ?>">Book Ticket</a>
						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div>

		<br>

		<!-- Our Cinemas Section -->
		<h5 data-aos="fade-up" data-aos-delay="300">OUR CINEMAS</h5>
		<div class="row">
			<?php
			include 'admin/database/config.php';
			$query = "SELECT * FROM cinema";
			$resultset = mysqli_query($conn, $query) or die("Database error: " . mysqli_error($conn));
			while ($record = mysqli_fetch_assoc($resultset)) {
			?>
				<div class="col-lg-3 col-md-12 col-sm-6 col-xs-6" data-aos="zoom-in" data-aos-delay="1000">
					<div class="card card-color border-light text-white">
						<div class="inner">
							<img src="admin/<?php echo $record['cin_image']; ?>" class="card-img-top">
						</div>
						<div class="card-body">
							<h4 class="card-title"><?php echo $record['cin_name']; ?></h4>
							<h6 class="card-subtitle mb-2 text-muted"><?php echo $record['cin_address']; ?></h6>
							<a class="btn btn-outline-danger btn-block a_color" href="showtime_cinema.php?id=<?php echo urlencode(base64_encode($record["cin_id"])); ?>">Book Here</a>
						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>

	<!-- AOS JS for Animations -->
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