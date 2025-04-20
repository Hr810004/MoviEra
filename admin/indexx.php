<?php
session_start();
include "database/config.php";
include "includes/header.php";
include "includes/navbar.php";

// Fetching Data
$moviesNo = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM movie"));
$cinemaNo = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM cinema"));
$userNo = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM userlogin"));
$bookingNo = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM booking"));
?>

<!-- AOS CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

<!-- Custom Styles -->
<style>
    body {
        background: url("https://www.fercoseating.com/files/gallery/project/fercoseating_pvr_veronarecliner.jpg") no-repeat center center fixed;
        background-size: cover;
        font-family: 'Poppins', sans-serif;
        color: white;
    }

    .container-fluid {
        padding: 30px;
    }

    .card {
        border-radius: 12px;
        background: rgba(0, 0, 0, 0.8);
        box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.1);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.2);
    }

    .card-body {
        padding: 25px;
    }

    .text-uppercase {
        font-size: 14px;
        font-weight: bold;
    }

    .h5 {
        font-size: 24px;
        font-weight: bold;
        color: #ffc107;
    }

    .card i {
        color: #ffc107;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-light">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Movies -->
        <div class="col-xl-3 col-md-6 mb-4" data-aos="fade-up">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Movies</div>
                            <div class="h5 mb-0"><?php echo $moviesNo ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-film fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cinemas -->
        <div class="col-xl-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Cinemas</div>
                            <div class="h5 mb-0"><?php echo $cinemaNo ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-expand fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users -->
        <div class="col-xl-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Users</div>
                            <div class="h5 mb-0"><?php echo $userNo ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bookings -->
        <div class="col-xl-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Bookings</div>
                            <div class="h5 mb-0"><?php echo $bookingNo ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ticket-alt fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- AOS Animation Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        easing: "ease-in-out",
        once: true,
        mirror: false
    });
</script>

<?php
include "includes/scripts.php";
include "includes/footer.php";
?>