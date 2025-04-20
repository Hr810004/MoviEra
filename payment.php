<?php
session_start();
include 'admin/database/config.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if (!isset($_SESSION["userid"])) {
    $_SESSION["iv_user"] = "Please Login To Proceed To Payment <a href='loginn.php'>Login</a>";
    header("Location: home1.php");
    exit();
}

if (isset($_GET['seats']) && isset($_GET['price']) && isset($_GET['mov_id']) && isset($_GET['cin_id']) && isset($_GET['show_id'])) {
    $seats = $_GET['seats'];
    $price = $_GET['price'];
    $mov_id = $_GET['mov_id'];
    $cin_id = $_GET['cin_id'];
    $show_id = $_GET['show_id'];
} else {
    header("Location: book1.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["userid"];

    // Insert booking
    $query = "INSERT INTO booking (user_id, mov_id, cin_id, show_id, book_seat) 
              VALUES ('$user_id', '$mov_id', '$cin_id', '$show_id', '$seats')";

    if (mysqli_query($conn, $query)) {
        // Fetch user email
        $email_query = "SELECT email FROM userlogin WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $email_query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $user_email = $row['email'];

            $details_query = "SELECT m.mov_name, c.cin_name, s.show_starttime, s.show_endtime, s.show_date FROM movie m JOIN cinema c ON c.cin_id = '$cin_id' JOIN showtime s ON s.show_id = '$show_id' WHERE m.mov_id = '$mov_id'";

            $details_result = mysqli_query($conn, $details_query);
            $details = mysqli_fetch_assoc($details_result);

            $movie_name = $details['mov_name'];
            $cinema_name = $details['cin_name'];
            $show_starttime = $details['show_starttime'];
            $show_endtime = $details['show_endtime'];
            $show_date = $details['show_date'];

            // Send email
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
                $mail->addAddress($user_email);

                $mail->isHTML(true);
                $mail->Subject = 'MovieEra Ticket Confirmation';
                $mail->Body = "
                    <h2>Thank you for booking with MovieEra!</h2>
                    <p><strong>Movie:</strong> $movie_name</p>
                    <p><strong>Cinema:</strong> $cinema_name</p>
                    <p><strong>Seats:</strong> $seats</p>
                    <p><strong>Show Date:</strong> $show_date</p>
                    <p><strong>Show Timing:</strong> $show_starttime - $show_endtime</p>
                    <p><strong>Total Price:</strong> ₹$price</p>
                    <p><strong>Booking Time:</strong> " . date("Y-m-d H:i:s") . "</p>
                    <hr>
                    <p>Enjoy your movie!<br><strong>- Team MovieEra</strong></p>
                ";

                $mail->send();
                echo "<script>alert('Payment Successful! Confirmation Email Sent.'); window.location.href='book1.php';</script>";
            } catch (Exception $e) {
                echo "<script>alert('Payment done, but email failed: {$mail->ErrorInfo}'); window.location.href='book1.php';</script>";
            }
        } else {
            echo "<script>alert('Payment Successful, but email not sent: user not found.'); window.location.href='book1.php';</script>";
        }
    } else {
        echo "Database Error: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Summary</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- AOS Animation CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        .background-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("https://assets-in.bmscdn.com/moviesmaster/assets/rcap/1_(2)_1691759919866.jpg") no-repeat center center fixed;
            background-size: cover;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(10px);
            /* Dark overlay for readability */
        }

        .content {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .container {
            background: rgba(0, 0, 0, 0.85);
            padding: 30px;
            border-radius: 12px;
            width: 50%;
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(255, 255, 255, 0.3);
        }

        h2 {
            color: #ffc107;
            font-weight: bold;
        }

        p {
            font-size: 18px;
            margin-bottom: 15px;
            color: white;
        }

        .btn-success {
            background: #ff9800;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            transition: 0.3s;
            border-radius: 8px;
        }

        .btn-success:hover {
            background: #e68900;
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <div class="background-container"></div>
    <div class="overlay"></div>

    <div class="content">
        <div class="container" data-aos="fade-up">
            <h2>Payment Summary</h2>
            <p><strong>Selected Seats:</strong> <?php echo $seats; ?></p>
            <p><strong>Total Price:</strong> ₹<?php echo $price; ?></p>
            <form method="post">
                <button type="submit" class="btn btn-success btn-lg">Pay Now</button>
            </form>
        </div>
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