<?php
include "includes/header.php";
?>

<style>
    body {
        margin: 0;
        padding: 0;
        background: url("https://www.fercoseating.com/files/gallery/project/fercoseating_pvr_veronarecliner.jpg") no-repeat center center fixed;
        background-size: cover;
        font-family: sans-serif;
        color: white;
    }

    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(30, 30, 30, 0.5);
        z-index: 0;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
    }

    .loginbox {
        width: 400px;
        padding: 40px;
        background: rgba(0, 0, 0, 0.85);
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.2);
        text-align: center;
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

    .avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin-bottom: 15px;
        border: 3px solid #ffc107;
    }

    .loginbox h1 {
        font-size: 24px;
        margin-bottom: 20px;
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

    .loginbox input[type="submit"] {
        width: 100%;
        background: linear-gradient(45deg, #ff4444, #ff8844);
        border: none;
        color: white;
        padding: 12px;
        font-size: 18px;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    .loginbox input[type="submit"]:hover {
        background: linear-gradient(45deg, #ff8844, #ff4444);
    }

    .loginbox a {
        color: darkgrey;
        text-decoration: none;
        display: block;
        margin-top: 10px;
    }

    .loginbox a:hover {
        color: #ff4444;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }
</style>

<div class="overlay d-flex justify-content-center align-items-center">
    <div class="loginbox">
        <img src="../images/avatar.png" class="avatar">
        <h1>Admin Login</h1>
        <form action="logincode.php" method="post">
            <p>Username</p>
            <input type="text" name="usergmail" class="form-control" placeholder="Enter Username" required>

            <p>Password</p>
            <input type="password" name="pwd" class="form-control" placeholder="Enter Password" required>

            <input type="submit" name="login_btn" value="Login">

            <a href="signupp.php">Don't have an account?</a>
        </form>
    </div>
</div>

<?php
include "includes/scripts.php";
?>