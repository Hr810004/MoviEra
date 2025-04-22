<?php
session_start();
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include "admin/database/config.php";

// Check if session variables are set
if (!isset($_SESSION['Name'], $_SESSION['username'], $_SESSION['gmail'], $_SESSION['phone'], $_SESSION['password'])) {
    header("Location: signupp.php");
    exit();
}

// Avoid inserting user data again if we're verifying or resending OTP
if (!isset($_POST['verify_otp']) && !isset($_POST['resend_otp'])) {
    $otp = rand(100000, 999999);

    // Get session data
    $name = $_SESSION['Name'];
    $username = $_SESSION['username'];
    $email = $_SESSION['gmail'];
    $phone = $_SESSION['phone'];
    $password = $_SESSION['password'];
    $hashedpwd = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data and OTP into the database
    $sql = "INSERT INTO userlogin (name, username, password, email, phone, otp) 
            VALUES ('$name', '$username', '$hashedpwd', '$email', '$phone', '$otp')";
    $stmt = mysqli_query($conn, $sql);

    if ($stmt) {
        // Send OTP email
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
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Your MovieEra OTP Code';
            $mail->Body    = "<h3>Your OTP is: <strong>$otp</strong></h3><p>Please enter this to complete your signup.</p>";

            $mail->send();
        } catch (Exception $e) {
            header("Location: signupp.php?message=" . urlencode("Failed to send OTP. Please try again."));
            exit();
        }
    } else {
        header("Location: signupp.php?message=" . urlencode("Failed to save user data. Please try again."));
        exit();
    }
}


// Handle OTP submission
if (isset($_POST['verify_otp'])) {
    // Get user OTP input
    $user_otp = $_POST['otp'];

    // Retrieve OTP from the database for the specific username
    $username = $_SESSION['username'];
    $sql = "SELECT otp FROM userlogin WHERE username = '$username'";
    $stmt = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($stmt);

    if ($row) {
        // Check if OTP matches
        if ($user_otp == $row['otp']) {
            unset($_SESSION['Name'], $_SESSION['username'], $_SESSION['gmail'], $_SESSION['phone'], $_SESSION['password']);
            header("Location: loginn.php?message=" . urlencode("Signup successful! You can now log in."));
            exit();
        } else {
            // OTP does not match, delete the entire row from the database
            $sql = "DELETE FROM userlogin WHERE username = '$username'";
            mysqli_query($conn, $sql);

            // Show an error message
            $error_message = "Invalid OTP. Please try again.";
            header("Location: signupp.php?message=" . urlencode($error_message));
            exit();
        }
    }
}

if (isset($_POST['resend_otp'])) {
    // Generate a new OTP
    $otp = rand(100000, 999999);
    $username = $_SESSION['username'];
    $email = $_SESSION['gmail'];

    // Update the OTP in the database
    $sql = "UPDATE userlogin SET otp = '$otp' WHERE username = '$username'";
    $stmt = mysqli_query($conn, $sql);

    if ($stmt) {
        // Send the new OTP email
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
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Your new MovieEra OTP Code';
            $mail->Body    = "<h3>Your new OTP is: <strong>$otp</strong></h3><p>Please enter this to complete your signup.</p>";

            $mail->send();
            $message = "A new OTP has been sent to your email.";
        } catch (Exception $e) {
            header("Location: signupp.php?message=" . urlencode("Failed to resend OTP. Please try again."));
            exit();
        }
    } else {
        $message = "Failed to update OTP. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OTP Verification</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url("https://assets-in.bmscdn.com/moviesmaster/assets/rcap/1_(2)_1691759919866.jpg") no-repeat center center fixed;
            background-size: cover;
            font-family: sans-serif;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
        }

        .card {
            background: rgba(0, 0, 0, 0.85);
            color: white;
            border-radius: 10px;
            padding: 30px;
            width: 480px;
            box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.2);
            opacity: 0;
            transform: translateY(20px);
            animation: fadeUp 0.6s ease-out forwards;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-control {
            background: #2a2a2a;
            color: white !important;
            border: 1px solid #444;
            font-size: 16px;
            padding: 12px;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .form-control:focus {
            background: #333;
            color: white !important;
            border-color: #ff4444;
            box-shadow: none;
        }

        .btn-primary {
            background: linear-gradient(45deg, #ff4444, #ff8844);
            border: none;
            padding: 12px;
            transition: 0.3s;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #ff8844, #ff4444);
        }

        .input-group-text {
            background: #ff4444;
            color: white;
            border: none;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="overlay d-flex justify-content-center align-items-center">
        <div class="card">
            <h3 class="text-center">OTP Verification</h3>
            <form action="" method="post">
                <div class="form-group input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    <input class="form-control" name="otp" placeholder="Enter OTP" type="text" pattern="\d{6}" title="Enter a 6-digit OTP">
                </div>

                <div class="form-group">
                    <button type="submit" name="verify_otp" class="btn btn-primary btn-block w-100">Verify OTP</button>
                </div>

                <div class="form-group text-center mt-3">
                    <!-- Resend OTP Button -->
                    <button type="submit" name="resend_otp" class="btn btn-warning btn-block w-100">Resend OTP</button>
                </div>

                <?php
                if (isset($_GET['message'])) {
                    $message = $_GET['message'];
                    echo "<p class='text-center text-danger'>$message</p>";
                }
                ?>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>