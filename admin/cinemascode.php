<?php
include("database/config.php");

if (isset($_POST['addcinema'])) {
    $cin_name = $_POST['cin_name'];
    $cin_address = $_POST['cin_address'];
    $cin_description = $_POST['cin_description'];
    $cin_image = $_FILES['cin_image']['name'];

    // Move uploaded file directly to 'cinema/' folder
    move_uploaded_file($_FILES['cin_image']['tmp_name'], "cinema/" . $cin_image);

    // Insert into database
    $query = "INSERT INTO cinema (cin_name, cin_address, cin_description, cin_image) 
              VALUES ('$cin_name', '$cin_address', '$cin_description', 'cinema/$cin_image')";
    mysqli_query($conn, $query);

    $_SESSION['response'] = "Successfully Inserted!";
    $_SESSION['res_type'] = "success";
    header('location:cinemas.php');
}

if (isset($_GET['delete'])) {
    $cinema_id = $_GET['delete'];

    // Delete related data
    mysqli_query($conn, "DELETE FROM booking WHERE cin_id='$cinema_id'");
    mysqli_query($conn, "DELETE FROM showtime WHERE cin_id='$cinema_id'");

    // Get image path before deleting
    $result = mysqli_query($conn, "SELECT cin_image FROM cinema WHERE cin_id='$cinema_id'");
    $row = mysqli_fetch_assoc($result);
    if ($row && file_exists($row['cin_image'])) {
        unlink($row['cin_image']); // Delete image file
    }

    // Delete cinema record
    mysqli_query($conn, "DELETE FROM cinema WHERE cin_id='$cinema_id'");

    $_SESSION['response'] = "Successfully Deleted!";
    $_SESSION['res_type'] = "danger";
    header('location:cinemas.php');
}

if (isset($_POST['update_btn'])) {
    $id = $_POST['editt_id'];
    $edit_cin_name = $_POST['edit_cin_name'];
    $edit_cin_address = $_POST['edit_cin_address'];
    $edit_cin_description = $_POST['edit_cin_description'];
    $edit_cin_image = $_FILES['edit_cin_image']['name'];

    if (!empty($edit_cin_image)) {
        move_uploaded_file($_FILES['edit_cin_image']['tmp_name'], "cinema/" . $edit_cin_image);
        $image_path = "cinema/" . $edit_cin_image;
    } else {
        // Keep old image
        $result = mysqli_query($conn, "SELECT cin_image FROM cinema WHERE cin_id='$id'");
        $row = mysqli_fetch_assoc($result);
        $image_path = $row['cin_image'];
    }

    // Update cinema details
    mysqli_query($conn, "UPDATE cinema SET 
        cin_name='$edit_cin_name', 
        cin_address='$edit_cin_address', 
        cin_description='$edit_cin_description', 
        cin_image='$image_path' 
        WHERE cin_id='$id'");

    $_SESSION['response'] = "Successfully Updated!";
    $_SESSION['res_type'] = "success";
    header('location:cinemas.php');
}
