<?php
include("database/config.php");
session_start();

// Add a new movie
if (isset($_POST['addmovies'])) {
    $mov_name = $_POST['mov_name'];
    $mov_released_date = $_POST['mov_released_date'];
    $mov_tailor = $_POST['mov_tailor'];
    $mov_type = $_POST['mov_type'];
    $mov_trend = $_POST['mov_trend'];
    $mov_status = $_POST['mov_status'];
    $mov_description = $_POST['mov_description'];
    $mov_cast = $_POST['mov_cast'];

    // File upload handling
    $mov_image = "movieImage/" . $_FILES['mov_image']['name'];
    $mov_banner_image = "bannerImage/" . $_FILES['mov_banner_image']['name'];

    move_uploaded_file($_FILES['mov_image']['tmp_name'], $mov_image);
    move_uploaded_file($_FILES['mov_banner_image']['tmp_name'], $mov_banner_image);

    // Insert query
    $query = "INSERT INTO movie (mov_name, mov_released_date, mov_type, mov_trend, mov_status, mov_tailor, mov_description, mov_cast, mov_image, mov_banner_image) 
              VALUES ('$mov_name', '$mov_released_date', '$mov_type', '$mov_trend', '$mov_status', '$mov_tailor', '$mov_description', '$mov_cast', '$mov_image', '$mov_banner_image')";
    mysqli_query($conn, $query);

    $_SESSION['response'] = "Movie added successfully!";
    $_SESSION['res_type'] = "success";
    header('location:movies.php');
}

// Delete a movie
if (isset($_GET['delete'])) {
    $mov_id = $_GET['delete'];

    // Get movie image paths
    $result = mysqli_query($conn, "SELECT mov_image, mov_banner_image FROM movie WHERE mov_id='$mov_id'");
    $row = mysqli_fetch_assoc($result);

    // Delete associated images
    if (file_exists($row['mov_image'])) unlink($row['mov_image']);
    if (file_exists($row['mov_banner_image'])) unlink($row['mov_banner_image']);

    // Delete movie, bookings, and showtimes
    mysqli_query($conn, "DELETE FROM booking WHERE mov_id='$mov_id'");
    mysqli_query($conn, "DELETE FROM showtime WHERE mov_id='$mov_id'");
    mysqli_query($conn, "DELETE FROM movie WHERE mov_id='$mov_id'");

    $_SESSION['response'] = "Movie deleted successfully!";
    $_SESSION['res_type'] = "danger";
    header('location:movies.php');
}

// Update a movie
if (isset($_POST['update_btn'])) {
    $id = $_POST['editt_id'];
    $edit_mov_name = $_POST['edit_mov_name'];
    $edit_mov_released_date = $_POST['edit_mov_released_date'];
    $edit_mov_tailor = $_POST['edit_mov_tailor'];
    $edit_mov_type = $_POST['edit_mov_type'];
    $edit_mov_status = $_POST['edit_mov_status'];
    $edit_mov_description = $_POST['edit_mov_description'];
    $edit_mov_cast = $_POST['edit_mov_cast'];

    // File upload handling
    $edit_mov_image = $_FILES['edit_mov_image']['name'] ? "movieImage/" . $_FILES['edit_mov_image']['name'] : "";
    $edit_mov_banner_image = $_FILES['edit_mov_banner_image']['name'] ? "bannerImage/" . $_FILES['edit_mov_banner_image']['name'] : "";

    if ($edit_mov_image) move_uploaded_file($_FILES['edit_mov_image']['tmp_name'], $edit_mov_image);
    if ($edit_mov_banner_image) move_uploaded_file($_FILES['edit_mov_banner_image']['tmp_name'], $edit_mov_banner_image);

    // Update query
    $query = "UPDATE movie SET mov_name='$edit_mov_name', mov_released_date='$edit_mov_released_date', mov_tailor='$edit_mov_tailor', 
              mov_type='$edit_mov_type', mov_status='$edit_mov_status', mov_description='$edit_mov_description', mov_cast='$edit_mov_cast'";

    if ($edit_mov_image) $query .= ", mov_image='$edit_mov_image'";
    if ($edit_mov_banner_image) $query .= ", mov_banner_image='$edit_mov_banner_image'";

    $query .= " WHERE mov_id='$id'";
    mysqli_query($conn, $query);

    $_SESSION['response'] = "Movie updated successfully!";
    $_SESSION['res_type'] = "success";
    header('location:movies.php');
}
?>
