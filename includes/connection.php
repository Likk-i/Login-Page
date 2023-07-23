<?php
$db_host = "localhost";
$db_name = "registration_details";
$db_pass = "root";
$db_user = "root";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (mysqli_connect_error()) {
    // Display the exact error message
    echo "Connection failed: " . mysqli_connect_error();
    exit(); // Return null on connection failure
}
