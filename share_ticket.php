<?php
session_start();
include 'admin/database/config.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'admin/database/config.php';
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["userid"];
$user_query = "SELECT name,phone,email FROM userlogin WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $user_query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $user_name = $row['name'];
    $user_phone = $row['phone'];
    $user_email = $row['email'];
}

if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];

    $query = "SELECT b.book_id,b.book_seat, u.name AS sender_name, c.cin_name AS theater_name, m.mov_name AS movie_name, 
                     s.show_date, s.show_starttime, s.show_endtime 
              FROM booking b 
              LEFT JOIN cinema c ON c.cin_id = b.cin_id 
              LEFT JOIN movie m ON m.mov_id = b.mov_id 
              LEFT JOIN showtime s ON s.show_id = b.show_id 
              LEFT JOIN userlogin u ON u.user_id = b.user_id 
              WHERE b.book_id = $book_id AND u.user_id = $user_id    
              ORDER BY s.show_date DESC, s.show_starttime DESC";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $booking = mysqli_fetch_assoc($result);
    } else {
        $_SESSION['response'] = "Booking details not found.";
        $_SESSION['res_type'] = "danger";
        header("Location: bookinghistory.php");
        exit();
    }
} else {
    $_SESSION['response'] = "Invalid request.";
    $_SESSION['res_type'] = "danger";
    header("Location: bookinghistory.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receiver_email = $_POST['receiver_email'];
    $movie_name = $booking['movie_name'];
    $cinema_name = $booking['theater_name'];
    $seats = $booking['book_seat'];
    $show_date = $booking['show_date'];
    $show_starttime = $booking['show_starttime'];
    $show_endtime = $booking['show_endtime'];

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'movieera.confirmation@gmail.com';
        $mail->Password = 'wake ekot fmdn ivdp';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('movieera.confirmation@gmail.com', 'MovieEra');
        $mail->addAddress($receiver_email);

        $mail->isHTML(true);
        $mail->Subject = 'MovieEra Ticket Confirmation';

        $mail->Body = "
            <h2>Thank you for booking with MovieEra!</h2>
            <p><strong>Movie :</strong> $movie_name</p>
            <p><strong>Cinema :</strong> $cinema_name</p>
            <p><strong>Seats :</strong> $seats</p>
            <p><strong>Show Date :</strong> $show_date</p>
            <p><strong>Show Timing :</strong> $show_starttime - $show_endtime</p>
            <p><strong>Booking Time :</strong> " . date("Y-m-d H:i:s") . "</p>
            <p><strong>Sender's Name :</strong> $user_name</p>
            <p><strong>Sender's Email :</strong> $user_email</p>
            <p><strong>Sender's No :</strong> $user_phone</p>
            <hr>
            <p>Enjoy your movie!<br><strong>- Team MovieEra</strong></p>
        ";

        $mail->send();
        echo "<script>alert('Ticket shared successfully! Confirmation Email Sent.'); window.location.href='bookinghistory.php';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Ticket shared, but email failed: {$mail->ErrorInfo}'); window.location.href='bookinghistory.php';</script>";
    }
}

if (isset($_POST['share_ticket'])) {
    $_SESSION['response'] = "Ticket successfully shared!";
    $_SESSION['res_type'] = "success";

    header("Location: bookinghistory.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Share Ticket</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url("https://www.fercoseating.com/files/gallery/project/fercoseating_pvr_veronarecliner.jpg") no-repeat center center fixed;
            background-size: cover;
            font-family: sans-serif;
            color: white;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
        }

        .sharebox {
            width: 400px;
            padding: 30px;
            background: rgba(0, 0, 0, 0.85);
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.2);
            text-align: center;
        }

        .movie-details {
            text-align: left;
            background: rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .movie-details p {
            margin: 5px 0;
            color: #ffdd57;
        }

        .form-control {
            background: #2a2a2a;
            color: white !important;
            border: 1px solid #444;
            font-size: 16px;
            padding: 12px;
            margin-bottom: 15px;
        }

        .form-control:focus {
            background: #333;
            color: white !important;
            border-color: #ff4444;
            box-shadow: none;
        }

        .btn-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn-share {
            width: 100%;
            background: linear-gradient(45deg, #ff4444, #ff8844);
            border: none;
            color: white;
            padding: 12px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            text-align: center;
            display: block;
            text-decoration: none;
        }

        .btn-share:hover {
            background: linear-gradient(45deg, #ff8844, #ff4444);
        }

        .btn-back {
            margin: auto;
            width: 80%;
            background: #555;
            color: white;
            padding: 8px;
            font-size: 14px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
        }

        .btn-back:hover {
            background: #777;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
    </style>
</head>

<body>
    <div class="overlay d-flex justify-content-center align-items-center">
        <div class="sharebox">
            <h1>Share Ticket</h1>

            <!-- Movie Details -->
            <div class="movie-details">
                <p><strong>🎬 Movie Name:</strong> <?php echo $booking['movie_name']; ?></p>
                <p><strong>🎬 Seats:</strong> <?php echo $booking['book_seat']; ?></p>
                <p><strong>📅 Show Date:</strong> <?php echo $booking['show_date']; ?></p>
                <p><strong>⏰ Start Time:</strong> <?php echo $booking['show_starttime']; ?></p>
                <p><strong>⏳ End Time:</strong> <?php echo $booking['show_endtime']; ?></p>
                <p><strong>🎭 Theater:</strong> <?php echo $booking['theater_name']; ?></p>
                <p><strong>🧑 Sender:</strong> <?php echo $booking['sender_name']; ?></p>
            </div>

            <!-- Share Ticket Form -->
            <form action="" method="post">
                <p>Your Name</p>
                <input type="text" name="sender_name" class="form-control" value="<?php echo $user_name; ?>" required readonly>
                <p>Your Contact No</p>
                <input type="text" name="sender_no" class="form-control" value="<?php echo $user_phone; ?>" required minlength="10" maxlength="10" readonly>
                <p>Sender's Email</p>
                <input type="email" name="receiver_email" class="form-control" placeholder="Enter Email" required>

                <div class="btn-container">
                    <input type="submit" name="share_ticket" value="Share Ticket" class="btn-share">
                    <a href="bookinghistory.php" class="btn-back">Go Back</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>