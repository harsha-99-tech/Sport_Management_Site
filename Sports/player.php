<?php
session_start();
$loggedIn = (isset($_SESSION['user_id']));

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

include 'db_config.php';

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the PlayerID from the session
$playerID = $_SESSION['user_id'];

// Fetch player information
$sql = "SELECT * FROM players WHERE PlayerID = $playerID";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $player = $result->fetch_assoc();

    // Fetch sport names associated with the player
    $sqlSportNames = "SELECT s.SportName 
                      FROM sports s
                      INNER JOIN player_sports ps ON s.SportID = ps.SportID
                      WHERE ps.PlayerID = $playerID";

    $resultSportNames = $conn->query($sqlSportNames);
    $sportNames = [];

    // Close the database connection (free up resources)
    $conn->close();
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/admin.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <title>Player Profile</title>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="index.php">
                    <div class="logo"></div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav ml-auto">
                        <?php if ($loggedIn) : ?>
                            <li class="nav-item">
                                <a href="logout.php">
                                    <button class="btn primary-bg-color text-white">Logout</button>
                                </a>
                            </li>
                        <?php endif ?>
                    </ul>
                </div>
            </nav>
        </header>

        <div class="container-fluid">
            <div class="container pb-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Player Profile</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <th>Name:</th>
                                        <td><?= $player['FirstName'] ?> <?= $player['LastName'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Date of Birth:</th>
                                        <td><?= $player['DateOfBirth'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Gender:</th>
                                        <td><?= $player['Gender'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td><?= $player['Email'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Phone Number:</th>
                                        <td><?= $player['PhoneNumber'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Address:</th>
                                        <td><?= $player['Address'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Emergency Contact Name:</th>
                                        <td><?= $player['EmergencyContactName'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Emergency Contact Number:</th>
                                        <td><?= $player['EmergencyContactNumber'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Medical Conditions:</th>
                                        <td><?= $player['MedicalConditions'] ?></td>
                                    </tr>
                                </table>

                                <!-- Display sport names associated with the player -->
                                <h4 class="card-title mt-4">Sports</h4>
                                <?php if ($resultSportNames->num_rows > 0) : ?>
                                    <ul class="list-group">
                                        <?php while ($row = $resultSportNames->fetch_assoc()) : ?>
                                            <li class='list-group-item'><?= $row['SportName'] ?></li>
                                        <?php endwhile; ?>
                                    </ul>
                                <?php else : ?>
                                    <p>No sports associated.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>

    </html>
<?php
} else {
    echo "Player not found.";
}
?>