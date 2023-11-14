<?php
include 'db_config.php';

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect data from the form
$FirstName = $_POST['FirstName'];
$LastName = $_POST['LastName'];
$password = $_POST['Password'];
$DateOfBirth = $_POST['DateOfBirth'];
$Gender = $_POST['Gender'];
$Email = $_POST['Email'];
$PhoneNumber = $_POST['PhoneNumber'];
$Address = $_POST['Address'];
$EmergencyContactName = $_POST['EmergencyContactName'];
$EmergencyContactNumber = $_POST['EmergencyContactNumber'];
$MedicalConditions = $_POST['MedicalConditions'];
$RegistrationNo = $_POST['RegistrationNo'];

// Insert data into the "players" table
$sql = "INSERT INTO players (Password,FirstName, LastName,DateOfBirth, Gender, Email, PhoneNumber, Address, EmergencyContactName, EmergencyContactNumber, MedicalConditions, RegistrationNo)
            VALUES ('$password', '$FirstName', '$LastName', '$DateOfBirth', '$Gender', '$Email', '$PhoneNumber', '$Address', '$EmergencyContactName', '$EmergencyContactNumber', '$MedicalConditions', '$RegistrationNo')";

if ($conn->query($sql) === TRUE) {
    $playerID = $conn->insert_id; // Get the PlayerID of the newly inserted player

    // Handle multiple sports selections
    if (isset($_POST['Sports']) && is_array($_POST['Sports'])) {
        foreach ($_POST['Sports'] as $sportID) {
            $insertPlayerSportSQL = "INSERT INTO player_sports (PlayerID, SportID) VALUES ('$playerID', '$sportID')";
            if ($conn->query($insertPlayerSportSQL) !== TRUE) {
                echo "Error inserting sports: " . $conn->error;
            }
        }
    }

    echo "Player registered successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
header('location: player_registration.php');
