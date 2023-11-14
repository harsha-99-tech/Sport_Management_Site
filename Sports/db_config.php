<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "sms";

    // Create a database connection
    $conn = mysqli_connect($hostname, $username, $password, $database);

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
