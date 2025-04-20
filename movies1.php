<?php
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/userstyle.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
	<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

	<style>
		body {
			font: caption;
			font-family: cursive;
			margin: 0;
			padding: 0;
			background: url("https://assets-in.bmscdn.com/moviesmaster/assets/rcap/4_1691759905314.jpg") repeat center center fixed;
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
			/* Ensures the image takes the full width of the container */
			height: 500px;
			/* Adjust height as needed */
			object-fit: cover;
			/* Crops the image while maintaining aspect ratio */
		}
	</style>
</head>

<body>
	<?php include 'navbar.php'; ?>
	<div class="container">
		<br>
		<div id="demo" class="carousel slide" data-aos="fade-up" data-aos-delay="100" data-ride="carousel">

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

		<!-- Nav tabs -->
		<ul class="nav" data-aos="fade-up">
			<li class="btn btn-group btn-block nav-item">
				<button class="btn btn-outline-danger nav-link active" data-toggle="tab" href="#running_movies">Running movies</button>
				<button class="btn btn-outline-danger nav-link" data-toggle="tab" href="#coming_soon">Coming soon</button>
			</li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content"><br>
			<div id="running_movies" class="tab-pane active">
				<div class="row">
					<?php
					include 'admin/database/config.php';
					$query = "SELECT * FROM movie WHERE mov_status='Running Movies'";
					$resultset = mysqli_query($conn, $query) or die("database error:" . mysqli_error($conn));
					$delay = 100;
					while ($record = mysqli_fetch_assoc($resultset)) {
					?>
						<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
							<div class="card card-color border-light text-white shadow">
								<div class="inner">
									<img src="admin/<?php echo $record['mov_image']; ?>" class="card-img-top">
								</div>
								<div class="card-body">
									<h4 class="card-title"><?php echo $record['mov_name']; ?></h4>
									<h6 class="card-subtitle mb-2 text-muted"><?php echo $record['mov_type']; ?></h6>
									<a class="btn btn-outline-danger btn-block a_color" href="showtime_movie.php?id=<?php echo urlencode(base64_encode($record["mov_id"])); ?> ">Book Ticket</a>
								</div>
							</div>
						</div>
					<?php
						$delay += 100;
					}
					?>
				</div>
			</div>

			<div id="coming_soon" class="tab-pane fade">
				<div class="row">
					<?php
					$query = "SELECT * FROM movie WHERE mov_status='Comming Soon'";
					$resultset = mysqli_query($conn, $query) or die("database error:" . mysqli_error($conn));
					$delay = 100;
					while ($record = mysqli_fetch_assoc($resultset)) {
					?>
						<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
							<div class="card card-color border-light text-white shadow">
								<div class="inner">
									<img src="admin/<?php echo $record['mov_image']; ?>" class="card-img-top">
								</div>
								<div class="card-body">
									<h4 class="card-title"><?php echo $record['mov_name']; ?></h4>
									<h6 class="card-subtitle mb-2 text-muted"><?php echo $record['mov_type']; ?></h6>
									<a class="btn btn-outline-danger btn-block a_color" href="#">Coming Soon</a>
								</div>
							</div>
						</div>
					<?php
						$delay += 100;
					}
					?>
				</div>
			</div>
		</div>
	</div>

	<!-- AOS Script -->
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