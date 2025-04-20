<!DOCTYPE html>
<html lang="en">

<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
	<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

	<style type="text/css">
		#team-area {
			height: 100vh;
		}

		body {
			font: caption;
			font-family: cursive;
			margin: 0;
			padding: 0;
			background: url("https://assets-in.bmscdn.com/moviesmaster/assets/rcap/2_1691759915279.jpg") repeat center center fixed;
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

		.team-img {
			position: relative;
			width: 210px;
			height: 210px;
			border: 4px solid #ffce26;
			border-radius: 50%;
			overflow: hidden;
			margin: 0 auto;
		}

		.team-social li {
			display: inline-block;
		}

		@media (min-width: 1200px) {
			.container {
				max-width: 1550px;
			}
		}
			.team-social li a {
				display: block;
				border: 1px solid #fff;
				width: 30px;
				height: 30px;
				line-height: 30px;
				border-radius: 50%;
				color: #fff;
				margin: 0 2px;
			}

			.team-info h3 {
				font-weight: 600;
				margin-top: 20px;
			}

			.team-info p {
				color: #ffce26;
				text-transform: uppercase;
			}

			.section-heading {
				margin-bottom: 54px;
				text-align: center;
			}
	</style>
</head>

<body style="font-family: cursive;">
	<?php include 'navbar.php'; ?>
	<div class="container">
		<br><br>
		<section id="team-area" data-scroll-index="4">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
						<div class="section-heading text-center" data-aos="fade-up">
							<h5>Our creative team</h5>
							<h2>Meet The Team</h2>
							<p>Behind every great project is a strong team. Meet the visionaries shaping the future with creativity and skill!</p>
						</div>
					</div>
				</div>
				<div class="row justify-content-center gx-5">
					<!-- Team Member 1 -->
					<div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="100">
						<div class="team-single text-center">
							<div class="team-img">
								<img src="images/jeet.jpg" class="img-fluid" alt="">
							</div>
							<div class="team-info">
								<h3>Jeet Parsaniya</h3>
							</div>
						</div>
					</div>
					<!-- Team Member 2 -->
					<div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="200">
						<div class="team-single text-center">
							<div class="team-img">
								<img src="images/bhumi.jpg" class="img-fluid" alt="">
							</div>
							<div class="team-info">
								<h3>Bhoomi Gurjar</h3>
							</div>
						</div>
					</div>
					<!-- Team Member 3 -->
					<div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="300">
						<div class="team-single text-center">
							<div class="team-img">
								<img src="images/ashish.jpg" class="img-fluid" alt="">
							</div>
							<div class="team-info">
								<h3>Ashish Chauhan</h3>
							</div>
						</div>
					</div>
					<!-- Team Member 4 -->
					<div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="400">
						<div class="team-single text-center">
							<div class="team-img">
								<img src="images/baliram.jpg" class="img-fluid" alt="">
							</div>
							<div class="team-info">
								<h3>Baliram Sahu</h3>
							</div>
						</div>
					</div>
					<!-- Team Member 5 -->
					<div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="500">
						<div class="team-single text-center">
							<div class="team-img">
								<img src="images/Harshil.jpg" class="img-fluid" alt="">
							</div>
							<div class="team-info">
								<h3>Harshil Panchal</h3>
							</div>
						</div>
					</div>
					<!-- End Team Members -->
				</div>
			</div>
		</section>
	</div>

	<!-- AOS Animation Script -->
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