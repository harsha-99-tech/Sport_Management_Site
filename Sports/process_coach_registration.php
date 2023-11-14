<?php
include 'db_config.php'; // Include your database connection configuration

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect data from the form
$FirstName = $_POST['FirstName'];
$LastName = $_POST['LastName'];
$Password = $_POST['Password'];
$ConfirmPassword = $_POST['ConfirmPassword'];
$DateOfBirth = $_POST['DateOfBirth'];
$Gender = $_POST['Gender'];
$Email = $_POST['Email'];
$PhoneNumber = $_POST['PhoneNumber'];
$Address = $_POST['Address'];
$Specialty = $_POST['Specialty'];
$Certifications = $_POST['Certifications'];
$Sports = $_POST['Sports']; // This is an array

// Check if the password and confirm password match
if ($Password !== $ConfirmPassword) {
    echo "Error: Passwords do not match.";
    exit();
}

// Hash the password for security (use a suitable hashing algorithm)
$hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

// Insert data into the "coaches" table
$sql = "INSERT INTO coaches (FirstName, LastName, Password, DateOfBirth, Gender, Email, PhoneNumber, Address, Specialty, Certifications)
        VALUES ('$FirstName', '$LastName', '$hashedPassword', '$DateOfBirth', '$Gender', '$Email', '$PhoneNumber', '$Address', '$Specialty', '$Certifications')";

if ($conn->query($sql) === TRUE) {
    $coachID = $FirstName; // Get the CoachID of the newly inserted coach

    // Handle multiple sports selections
    if (isset($Sports) && is_array($Sports)) {
        foreach ($Sports as $sportID) {
            $insertCoachSportSQL = "INSERT INTO coach_sports (CoachID, SportID) VALUES ('$coachID', '$sportID')";
            if ($conn->query($insertCoachSportSQL) !== TRUE) {
                echo "Error inserting sports: " . $conn->error;
            }
        }
    }

    echo "Coach registered successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
header('location: coach_registration.php');
?>
