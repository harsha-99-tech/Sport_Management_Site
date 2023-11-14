<?php
session_start(); // Start the session
$loggedIn = (isset($_SESSION['user_id']));
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
} else if (isset($_SESSION['user_id'])) {
    if (!($_SESSION['user_type'] == "admin")) {
        header("Location: index.php"); // Redirect to the dashboard if already logged in
        exit();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/registration.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Manage Matches</title>
    <style>
        h5 {
            margin-bottom: 0;
        }
    </style>
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
        <div class="container" style="padding-top:20px">
            <h2 class="mt-4">Manage Matches</h2>

            <!-- Add New Match Section -->
            <div class="row mt-4">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h5>Add New Match</h5>
                        </div>
                        <div class="card-body">
                            <form class="form" action="" method="post">
                                <div class="form-group">
                                    <label for="Sport">Sport:</label>
                                    <select class="form-control" name="Sport" required>
                                        <option value="" disabled selected>Select a Sport</option>
                                        <?php
                                        include 'db_config.php'; // Include your database connection configuration

                                        $sportsQuery = "SELECT * FROM sports";
                                        $sportsResult = $conn->query($sportsQuery);

                                        while ($sport = $sportsResult->fetch_assoc()) {
                                            echo '<option value="' . $sport['SportID'] . '">' . $sport['SportName'] . ' (ID: ' . $sport['SportID'] . ')</option>';
                                        }
                                        $conn->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Date">Date:</label>
                                    <input type="date" class="form-control" name="Date" required>
                                </div>
                                <div class="form-group">
                                    <label for="Location">Location:</label>
                                    <input type="text" class="form-control" name="Location" required>
                                </div>
                                <div class="form-group">
                                    <label for="Teams">Teams:</label>
                                    <input type="text" class="form-control" name="Teams" required>
                                </div>
                                <div class="form-group">
                                    <label for="Winners">Winners:</label>
                                    <input type="text" class="form-control" name="Winners" required>
                                </div>
                                <button type="submit" class="btn btn-primary" name="addMatch">Add Match</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Select Sport and Display Matches Section -->
            <div class="row mt-4">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h5>Select Sport and Display Matches</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            include 'db_config.php'; // Include your database connection configuration

                            $sportsQuery = "SELECT * FROM sports";
                            $sportsResult = $conn->query($sportsQuery);

                            echo '<form class="form" action="" method="post">
                            <div class="form-group">
                                <label for="Sport">Select Sport:</label>
                                <select class="form-control mb-3" name="Sport" required>
                                    <option value="" disabled selected>Select a Sport</option>';

                            while ($sport = $sportsResult->fetch_assoc()) {
                                echo '<option value="' . $sport['SportID'] . '">' . $sport['SportName'] . ' (ID: ' . $sport['SportID'] . ')</option>';
                            }

                            echo '</select>
                            <button type="submit" class="btn btn-primary" name="selectSport">Select Sport</button>
                        </div>
                    </form>';
                            $conn->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col">
                    <?php
                    include 'db_config.php'; // Include your database connection configuration

                    if (isset($_POST['selectSport'])) {
                        $selectedSportID = $_POST['Sport'];

                        $matchesQuery = "SELECT matches.MatchID, matches.Date, matches.Location, matches.Teams, matches.Winners, sports.SportName
                                     FROM matches
                                     INNER JOIN sports ON matches.SportID = sports.SportID
                                     WHERE matches.SportID = $selectedSportID";
                        $matchesResult = $conn->query($matchesQuery);

                        echo '<br><table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Match ID</th>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Teams</th>
                                <th>Winners</th>
                                <th>Sport</th>
                            </tr>
                        </thead>
                        <tbody>';

                        while ($match = $matchesResult->fetch_assoc()) {
                            echo '<tr>
                            <td>' . $match['MatchID'] . '</td>
                            <td>' . $match['Date'] . '</td>
                            <td>' . $match['Location'] . '</td>
                            <td>' . $match['Teams'] . '</td>
                            <td>' . $match['Winners'] . '</td>
                            <td>' . $match['SportName'] . '</td>
                        </tr>';
                        }

                        echo '</tbody>
                    </table>';
                    }

                    $conn->close();
                    ?>
                </div>
            </div>
        </div>F
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>