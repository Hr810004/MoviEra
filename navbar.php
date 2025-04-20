<?php
session_start();
?>
<link rel="stylesheet" href="css/navbar.css">

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