<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
    <?php
    include 'db_config.php'; // Include your database connection configuration

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the PlayerID of the player whose profile you want to display
    $playerID = 7; // You should retrieve this from the URL or another source

    // Fetch player information
    $sql = "SELECT * FROM players WHERE PlayerID = $playerID";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $player = $result->fetch_assoc();

        // Fetch sport names associated with the player
        $sqlSportNames = "SELECT s.SportName FROM sports s
                          INNER JOIN player_sports ps ON s.SportID = ps.SportID
                          WHERE ps.PlayerID = $playerID";

        $resultSportNames = $conn->query($sqlSportNames);
        $sportNames = array();

        ?>
        <div class="container mt-5">
            <h2 class="text-center">Player Profile</h2>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Name: <?= $player['FirstName'] ?> <?= $player['LastName'] ?></h4>
                            <p><strong>Date of Birth:</strong> <?= $player['DateOfBirth'] ?></p>
                            <p><strong>Gender:</strong> <?= $player['Gender'] ?></p>
                            <p><strong>Email:</strong> <?= $player['Email'] ?></p>
                            <p><strong>Phone Number:</strong> <?= $player['PhoneNumber'] ?></p>
                            <p><strong>Address:</strong> <?= $player['Address'] ?></p>
                            <p><strong>Emergency Contact Name:</strong> <?= $player['EmergencyContactName'] ?></p>
                            <p><strong>Emergency Contact Number:</strong> <?= $player['EmergencyContactNumber'] ?></p>
                            <p><strong>Medical Conditions:</strong> <?= $player['MedicalConditions'] ?></p>

                            <!-- Display sport names associated with the player -->
                            <h4 class="card-title">Sports</h4>
                            <ul class="list-group">
                                <?php
                                if ($resultSportNames->num_rows > 0) {
                                    while ($row = $resultSportNames->fetch_assoc()) {
                                        $sportNames[] = $row['SportName'];
                                    }
                                    foreach ($sportNames as $sport) {
                                        echo "<li class='list-group-item'>$sport</li>";
                                    }
                                } else {
                                    echo "<li class='list-group-item'>None</li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else {
        echo "Player not found.";
    }

    // Close the database connection
    $conn->close();
    ?>

</body>

</html>
