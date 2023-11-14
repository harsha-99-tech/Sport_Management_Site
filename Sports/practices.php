<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>View Practices Schedule</title>
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

            </div>
        </nav>
    </header>
    <div class="container-fluid">
        <div class="container">
            <h2>View Practices Schedule</h2>

            <!-- Display Practices Schedule -->
            <?php
            // Include your database connection configuration
            include 'db_config.php';

            $practicesQuery = "SELECT practices_schedule.PracticeID, sports.SportName, coaches.FirstName, coaches.LastName, 
                   practices_schedule.PracticeDate, practices_schedule.StartTime, practices_schedule.EndTime, practices_schedule.Location
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

</body>

</html>