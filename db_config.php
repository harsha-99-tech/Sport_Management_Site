<?php
$servername = "localhost";
$username = "root";
$password = ""; // Default password is empty for XAMPP
$dbname = "sms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
