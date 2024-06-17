<?php
session_start(); // Start the session
$loggedIn = (isset($_SESSION['user_id']));
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
} else if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_type'] == "player") {
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
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        .modal-backdrop {
            z-index: 1050 !important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Manage Practices</title>
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
        <div class="container">
            <h2 class="my-4">Manage Practices</h2>

            <!-- Add New Practice Section -->
            <div class="row mt-4">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add New Practice</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" action="" method="post">
                                <div class="form-group">
                                    <label for="Sport">Sport:</label>
                                    <select class="form-control" name="Sport" required>
                                        <option value="" disabled selected>Select a Sport</option>
                                        <?php
                                        // Include your database connection configuration
                                        include 'db_config.php';

                                        $sportsQuery = "SELECT * FROM sports";
                                        $sportsResult = $conn->query($sportsQuery);

                                        while ($sport = $sportsResult->fetch_assoc()) {
                                            echo '<option value="' . $sport['SportID'] . '">' . $sport['SportName'] . ' (ID: ' . $sport['SportID'] . ')</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Coach">Coach:</label>
                                    <select class="form-control" name="Coach" required>
                                        <option value="" disabled selected>Select a Coach</option>
                                        <?php
                                        // Fetch coaches for the dropdown list
                                        $coachesQuery = "SELECT * FROM coaches";
                                        $coachesResult = $conn->query($coachesQuery);

                                        while ($coach = $coachesResult->fetch_assoc()) {
                                            echo '<option value="' . $coach['CoachID'] . '">' . $coach['FirstName'] . ' ' . $coach['LastName'] . ' (ID: ' . $coach['CoachID'] . ')</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="PracticeDate">Practice Date:</label>
                                    <input type="date" class="form-control" name="PracticeDate" required>
                                </div>
                                <div class="form-group">
                                    <label for="StartTime">Start Time:</label>
                                    <input type="time" class="form-control" name="StartTime" required>
                                </div>
                                <div class="form-group">
                                    <label for="EndTime">End Time:</label>
                                    <input type="time" class="form-control" name="EndTime" required>
                                </div>
                                <div class="form-group">
                                    <label for="Location">Location:</label>
                                    <input type="text" class="form-control" name="Location" required>
                                </div>
                                <button type="submit" class="btn btn-primary" name="addPractice">Add Practice</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Display Practices Schedule -->
            <div class="row mt-4">
                <div class="col">
                    <?php
                    // Handle adding a new practice
                    if (isset($_POST['addPractice'])) {
                        $newSportID = $_POST['Sport'];
                        $newCoachID = $_POST['Coach'];
                        $newPracticeDate = $_POST['PracticeDate'];
                        $newStartTime = $_POST['StartTime'];
                        $newEndTime = $_POST['EndTime'];
                        $newLocation = $_POST['Location'];

                        $addPracticeQuery = "INSERT INTO practices_schedule (SportID, CoachID, PracticeDate, StartTime, EndTime, Location) 
                                        VALUES ($newSportID, $newCoachID, '$newPracticeDate', '$newStartTime', '$newEndTime', '$newLocation')";

                        if ($conn->query($addPracticeQuery) === TRUE) {
                            echo '<div class="alert alert-success" role="alert">
                                New practice added successfully.
                            </div>';
                        } else {
                            echo '<div class="alert alert-danger" role="alert">
                                Error adding practice: ' . $conn->error . '
                            </div>';
                        }
                    }

                    // Handle updating an existing practice
                    if (isset($_POST['updatePractice'])) {
                        $practiceID = $_POST['PracticeID'];
                        $updatedSportID = $_POST['UpdatedSport'];
                        $updatedCoachID = $_POST['UpdatedCoach'];
                        $updatedPracticeDate = $_POST['UpdatedPracticeDate'];
                        $updatedStartTime = $_POST['UpdatedStartTime'];
                        $updatedEndTime = $_POST['UpdatedEndTime'];
                        $updatedLocation = $_POST['UpdatedLocation'];

                        $updatePracticeQuery = "UPDATE practices_schedule 
                                               SET SportID = $updatedSportID, CoachID = $updatedCoachID, PracticeDate = '$updatedPracticeDate',
                                                   StartTime = '$updatedStartTime', EndTime = '$updatedEndTime', Location = '$updatedLocation'
                                               WHERE PracticeID = $practiceID";

                        if ($conn->query($updatePracticeQuery) === TRUE) {
                            echo '<div class="alert alert-success" role="alert">
                                Practice updated successfully.
                            </div>';
                        } else {
                            echo '<div class="alert alert-danger" role="alert">
                                Error updating practice: ' . $conn->error . '
                            </div>';
                        }
                    }

                    // Handle deleting a practice
                    if (isset($_POST['deletePractice'])) {
                        $practiceIDToDelete = $_POST['PracticeIDToDelete'];

                        $deletePracticeQuery = "DELETE FROM practices_schedule WHERE PracticeID = $practiceIDToDelete";

                        if ($conn->query($deletePracticeQuery) === TRUE) {
                            echo '<div class="alert alert-success" role="alert">
                                Practice deleted successfully.
                            </div>';
                        } else {
                            echo '<div class="alert alert-danger" role="alert">
                                Error deleting practice: ' . $conn->error . '
                            </div>';
                        }
                    }

                    // Include your database connection configuration
                    include 'db_config.php';

                    $practicesQuery = "SELECT practices_schedule.PracticeID, sports.SportID, sports.SportName, coaches.CoachID, 
                                   coaches.FirstName, coaches.LastName, practices_schedule.PracticeDate, 
                                   practices_schedule.StartTime, practices_schedule.EndTime, practices_schedule.Location
                                   FROM practices_schedule
                                   INNER JOIN sports ON practices_schedule.SportID = sports.SportID
                                   INNER JOIN coaches ON practices_schedule.CoachID = coaches.CoachID";

                    $practicesResult = $conn->query($practicesQuery);

                    if ($practicesResult->num_rows > 0) {
                        echo '<table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Sport</th>
                                    <th>Coach</th>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Location</th>
                                    <th>Action</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>';

                        while ($practice = $practicesResult->fetch_assoc()) {
                            echo '<tr>
                                <td>' . $practice['SportName'] . '</td>
                                <td>' . $practice['FirstName'] . ' ' . $practice['LastName'] . '</td>
                                <td>' . $practice['PracticeDate'] . '</td>
                                <td>' . $practice['StartTime'] . '</td>
                                <td>' . $practice['EndTime'] . '</td>
                                <td>' . $practice['Location'] . '</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal' . $practice['PracticeID'] . '">
                                        Update
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="updateModal' . $practice['PracticeID'] . '" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true" data-backdrop="false" data-keyboard="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateModalLabel">Update Practice</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form" action="" method="post">
                                                        <input type="hidden" name="PracticeID" value="' . $practice['PracticeID'] . '">
                                                        <div class="form-group">
                                                            <label for="UpdatedSport">Sport:</label>
                                                            <select class="form-control" name="UpdatedSport" required>
                                                                <option value="' . $practice['SportID'] . '" selected>' . $practice['SportName'] . '</option>';
                            // Fetch sports for the dropdown list
                            $sportsQuery = "SELECT * FROM sports";
                            $sportsResult = $conn->query($sportsQuery);

                            while ($sport = $sportsResult->fetch_assoc()) {
                                echo '<option value="' . $sport['SportID'] . '">' . $sport['SportName'] . ' (ID: ' . $sport['SportID'] . ')</option>';
                            }
                            echo '
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="UpdatedCoach">Coach:</label>
                                                            <select class="form-control" name="UpdatedCoach" required>
                                                                <option value="' . $practice['CoachID'] . '" selected>' . $practice['FirstName'] . ' ' . $practice['LastName'] . '</option>';
                            // Fetch coaches for the dropdown list
                            $coachesQuery = "SELECT * FROM coaches";
                            $coachesResult = $conn->query($coachesQuery);

                            while ($coach = $coachesResult->fetch_assoc()) {
                                echo '<option value="' . $coach['CoachID'] . '">' . $coach['FirstName'] . ' ' . $coach['LastName'] . ' (ID: ' . $coach['CoachID'] . ')</option>';
                            }
                            echo '
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="UpdatedPracticeDate">Practice Date:</label>
                                                            <input type="date" class="form-control" name="UpdatedPracticeDate" value="' . $practice['PracticeDate'] . '" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="UpdatedStartTime">Start Time:</label>
                                                            <input type="time" class="form-control" name="UpdatedStartTime" value="' . $practice['StartTime'] . '" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="UpdatedEndTime">End Time:</label>
                                                            <input type="time" class="form-control" name="UpdatedEndTime" value="' . $practice['EndTime'] . '" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="UpdatedLocation">Location:</label>
                                                            <input type="text" class="form-control" name="UpdatedLocation" value="' . $practice['Location'] . '" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary" name="updatePractice">Update Practice</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <form method="post" action="">
                                        <input type="hidden" name="PracticeIDToDelete" value="' . $practice['PracticeID'] . '">
                                        <button type="submit" class="btn btn-danger" name="deletePractice">Delete</button>
                                    </form>
                                </td>
                            </tr>';
                        }

                        echo '</tbody>
                        </table>';
                    } else {
                        echo '<p>No practices scheduled.</p>';
                    }

                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>