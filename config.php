<?php

$conn = new mysqli("localhost", "root", "", "database");

if ($conn->connect_error) {
    die("Could NOt Connect to the Databse" . $conn->connect_error);
}
