<?php
$sid = base64_decode(urldecode($_GET['id']));
$_SESSION['mov_id'] = $sid;
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
include "admin/database/config.php";
?>
<!DOCTYPE html>
<html>

<head>
	<title>Movie Booking</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/userstyle1.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
</head>

<body>

	<style>
		#movie-image {
			width: 100%;
		}
	</style>

	<?php include 'navbar.php'; ?>

	<div class="container">
		<br>
		<?php
		$query = "SELECT mov_tailor, mov_banner_image FROM movie WHERE mov_id=$sid";
		$result = mysqli_query($conn, $query) or die("database error:" . mysqli_error($conn));
		$row = mysqli_fetch_assoc($result);
		?>

		<div class="video_preview" data-aos="fade-up" style="width: 100%;">
			<a href="<?php echo $row["mov_tailor"]; ?>" target="_blank">
				<img src="admin/<?php echo $row['mov_banner_image']; ?>" class="video_img" alt="" style="width: 100%; height: auto;">
			</a>
		</div>

		<ul class="nav nav-tabs nav-fill">
			<li class="nav-item">
				<a class="nav-link active btn-outline-danger text-size" data-toggle="tab" href="#showtime" data-aos="fade-right">Showtime</a>
			</li>
			<li class="nav-item">
				<a class="nav-link btn-outline-danger text-size" data-toggle="tab" href="#aboutmovie" data-aos="fade-left">About Movie</a>
			</li>
		</ul><br>

		<?php
		$date_arr = [];
		$tab_menuquery = "SELECT DISTINCT show_date FROM showtime ORDER BY show_date";
		$menu_result = mysqli_query($conn, $tab_menuquery);
		while ($record = mysqli_fetch_assoc($menu_result)) {
			$date_arr[] = $record["show_date"];
		}
		?>

		<div class="tab-content">
			<div id="showtime" class="tab-pane active">
				<ul class="nav nav-pills">
					<?php for ($i = 0; $i < min(5, count($date_arr)); $i++) { ?>
						<li class="btn btn-group nav-item">
							<button class="btn btn-outline-danger nav-link <?php echo ($i == 0) ? 'active' : ''; ?>" data-toggle="tab" href="#day<?php echo $i + 1; ?>" data-aos="zoom-in">
								<?php echo date("F j", strtotime($date_arr[$i])); ?>
							</button>
						</li>
					<?php } ?>
				</ul>

				<br><br>

				<div class="tab-content">
					<?php for ($i = 0; $i < 5; $i++) { ?>
						<div id="day<?php echo $i + 1; ?>" class="tab-pane <?php echo ($i == 0) ? 'active' : ''; ?>">
							<?php
							$query = "SELECT cin_id, cin_name FROM cinema";
							$resultset = mysqli_query($conn, $query);
							while ($record = mysqli_fetch_assoc($resultset)) {
								$c = $record['cin_id'];
							?>
								<h4 data-aos="fade-right"><?php echo $record['cin_name']; ?></h4>
								<?php
								$query1 = "SELECT show_id, show_starttime FROM showtime WHERE cin_id=$c AND mov_id=$sid AND show_date='$date_arr[$i]'";
								$resultset1 = mysqli_query($conn, $query1);
								while ($record1 = mysqli_fetch_assoc($resultset1)) {
								?>
									<a class="btn btn-info mar" href="book1.php?cin_id=<?php echo $record['cin_id']; ?>&show_id=<?php echo $record1['show_id']; ?>&mov_id=<?php echo $sid; ?>" data-aos="zoom-in">
										<?php echo date("H:i", strtotime($record1['show_starttime'])); ?>
									</a>
								<?php } ?>
								<hr class="line">
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>

			<?php
			$movieQuery = "SELECT * FROM movie WHERE mov_id = $sid";
			$movieDetails = mysqli_query($conn, $movieQuery);
			$row = mysqli_fetch_array($movieDetails);
			?>

			<div id="aboutmovie" class="tab-pane">
				<div class="jumbotron" style='background-color:black;' data-aos="fade-up">
					<div class="d-flex align-items-stretch">
						<div class="col-lg-3 col-md-6">
							<img id="movie-image" src="admin/<?php echo $row['mov_image']; ?>" alt="">
						</div>
						<div class="table-responsive">
							<table class="table text-center font-weight-normal">
								<tr>
									<td class="text-warning">NAME</td>
									<td class="text-white"><?php echo $row['mov_name']; ?></td>
								</tr>
								<tr>
									<td class="text-warning">MOVIE TYPE</td>
									<td class="text-white"><?php echo $row['mov_type']; ?></td>
								</tr>
								<tr>
									<td class="text-warning">RELEASE DATE</td>
									<td class="text-white"><?php echo $row['mov_released_date']; ?></td>
								</tr>
								<tr>
									<td class="text-warning">CAST</td>
									<td class="text-white"><?php echo $row['mov_cast']; ?></td>
								</tr>
								<tr>
									<td class="text-warning">DESCRIPTION</td>
									<td class="text-white"><?php echo $row['mov_description']; ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		AOS.init();
	</script>
</body>

</html>
<?php include("footer.php"); ?>