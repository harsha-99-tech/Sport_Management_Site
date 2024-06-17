<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/features.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Matches</title>
    <style>
        body{
            background-color: #fafafa;
        }
        .container {
            padding:0;
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

            </div>
        </nav>
    </header>

    <div class="container d-flex flex-column align-items-start">
        <?php
        // Database connection and query to fetch matches
        include 'db_config.php'; // Include your database connection configuration

        $matchesQuery = "SELECT matches.Date, matches.Location, matches.Teams, matches.Winners, sports.SportName
                    FROM matches
                    INNER JOIN sports ON matches.SportID = sports.SportID";
        $matchesResult = $conn->query($matchesQuery);

        $upcomingMatchesTable = '
            <div class="container">
                <h3 class="mt-5">Upcoming Matches</h3>
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sport</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Teams</th>
                        </tr>
                    </thead>';

        $previousMatchesTable = '
                <h3 class="mt-5">Previous Matches</h3>
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sport</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Teams</th>
                            <th>Winners</th>
                        </tr>
                    </thead>';

        while ($match = $matchesResult->fetch_assoc()) {
            if (empty($match['Winners'])) {
                // Match is upcoming
                $upcomingMatchesTable .= '
                    <tr>
                        <td>' . $match['SportName'] . '</td>
                        <td>' . $match['Date'] . '</td>
                        <td>' . $match['Location'] . '</td>
                        <td>' . $match['Teams'] . '</td>
                    </tr>';
            } else {
                // Match is previous
                $previousMatchesTable .= '
                    <tr>
                        <td>' . $match['SportName'] . '</td>
                        <td>' . $match['Date'] . '</td>
                        <td>' . $match['Location'] . '</td>
                        <td>' . $match['Teams'] . '</td>
                        <td>' . $match['Winners'] . '</td>
                    </tr>';
            }
        }

        $upcomingMatchesTable .= '
                </table>
            </div>';

        $previousMatchesTable .= '
                </table>
            </div>';

        echo $upcomingMatchesTable;
        echo $previousMatchesTable;

        $conn->close();
        ?>
    </div>
</body>

</html>
