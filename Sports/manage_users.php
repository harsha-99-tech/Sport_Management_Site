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
    <link rel="stylesheet" href="assets/css/manage_users.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Manage Users</title>
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

    <div class="container-fluid mb-4">
        <div class="container heights">
            <h2 class="">Manage Users</h2>

            <!-- Form to input User ID and Type -->
            <form class="mt-4 mb-5" action="" method="post">
                <div class="form-group">
                    <label for="UserID">User ID:</label>
                    <input type="number" class="form-control" name="UserID" required>
                </div>

                <div class="form-group">
                    <label for="UserType">User Type:</label>
                    <select class="form-control" name="UserType" required>
                        <option value="player">Player</option>
                        <option value="coach">Coach</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Show User Data</button>
            </form>

            <?php
            include 'db_config.php'; // Include your database connection configuration

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Get user input
                $userID = $_POST['UserID'];
                $userType = $_POST['UserType'];

                // Check if the "Edit" button is clicked
                if (isset($_POST['editUser'])) {
                    // Generate HTML to display the editable fields for the selected user
                    $result = getUserData($conn, $userType, $userID);

                    if ($result->num_rows > 0) {
                        $userDetails = '';

                        while ($row = $result->fetch_assoc()) {
                            $userDetails .= "<h3 class='mt-4'>User Data</h3>";
                            $userDetails .= "<form action='manage_users.php' method='post'>";
                            $userDetails .= "<table class='table table-bordered'>";
                            $userDetails .= "<tr><th>" . ucfirst($userType) . " ID</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th><th>Email</th><th>Phone Number</th><th>Action</th></tr>";
                            $userDetails .= "<tr>";
                            $userDetails .= "<td>" . $row[ucfirst($userType) . "ID"] . "</td>";
                            $userDetails .= "<td><input type='text' class='form-control' name='FirstName' value='" . $row['FirstName'] . "'></td>";
                            $userDetails .= "<td><input type='text' class='form-control' name='LastName' value='" . $row['LastName'] . "'></td>";
                            $userDetails .= "<td><input type='date' class='form-control' name='DateOfBirth' value='" . $row['DateOfBirth'] . "'></td>";
                            $userDetails .= "<td><input type='text' class='form-control' name='Email' value='" . $row['Email'] . "'></td>";
                            $userDetails .= "<td><input type='text' class='form-control' name='PhoneNumber' value='" . $row['PhoneNumber'] . "'></td>";
                            $userDetails .= "<td>
                            <input type='hidden' name='UserID' value='" . $row[ucfirst($userType) . "ID"] . "'>
                            <input type='hidden' name='UserType' value='" . $userType . "'>
                            <button type='submit' name='saveUser' class='btn btn-primary'>Save</button>
                        </td>";
                            $userDetails .= "</tr>";
                            $userDetails .= "</table>";
                            $userDetails .= "</form>";
                        }

                        echo $userDetails;
                    }
                }

                // Check if the "Save" button is clicked
                if (isset($_POST['saveUser'])) {
                    // Get updated user data from the form
                    $updatedFirstName = $_POST['FirstName'];
                    $updatedLastName = $_POST['LastName'];
                    $updatedDateOfBirth = $_POST['DateOfBirth'];
                    $updatedEmail = $_POST['Email'];
                    $updatedPhoneNumber = $_POST['PhoneNumber'];

                    // Update the user record in the respective table
                    updateUser($conn, $userType, $userID, $updatedFirstName, $updatedLastName, $updatedDateOfBirth, $updatedEmail, $updatedPhoneNumber);
                }

                // Query the database based on user ID and type
                $result = getUserData($conn, $userType, $userID);

                if ($result->num_rows > 0) {
                    $userDetails = '';

                    // Display user data with "Edit" and "Delete" buttons for each user
                    $userDetails .= "<h3 class='mt-4'>User Data</h3>";
                    $userDetails .= "<form action='manage_users.php' method='post'>";
                    $userDetails .= "<table class='table table-bordered'>";
                    $userDetails .= "<tr><th>" . ucfirst($userType) . " ID</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th><th>Email</th><th>Phone Number</th><th>Action</th></tr>";

                    while ($row = $result->fetch_assoc()) {
                        $userDetails .= "<tr>";
                        $userDetails .= "<td>" . $row[ucfirst($userType) . "ID"] . "</td>";
                        $userDetails .= "<td>" . $row['FirstName'] . "</td>";
                        $userDetails .= "<td>" . $row['LastName'] . "</td>";
                        $userDetails .= "<td>" . $row['DateOfBirth'] . "</td>";
                        $userDetails .= "<td>" . $row['Email'] . "</td>";
                        $userDetails .= "<td>" . $row['PhoneNumber'] . "</td>";
                        $userDetails .= "<td>
                        <form action='manage_users.php' method='post'>
                            <input type='hidden' name='UserID' value='" . $row[ucfirst($userType) . "ID"] . "'>
                            <input type='hidden' name='UserType' value='" . $userType . "'>
                            <button type='submit' name='editUser' class='btn btn-primary col' style='margin-bottom:10px;'>Edit</button>
                        </form>

                        <form action='manage_users.php' method='post'>
                            <input type='hidden' name='UserID' value='" . $row[ucfirst($userType) . "ID"] . "'>
                            <input type='hidden' name='UserType' value='" . $userType . "'>
                            <button type='submit' name='deleteUser' class='btn btn-danger col' style='margin-bottom:10px;'>Delete</button>
                        </form>
                    </td>";
                        $userDetails .= "</tr>";
                    }

                    $userDetails .= "</table>";
                    $userDetails .= "</form>";

                    echo $userDetails;
                } else {
                    echo "User not found.";
                }

                // Check if the "Delete" button is clicked
                if (isset($_POST['deleteUser'])) {
                    // Delete the user record from the respective table
                    deleteUser($conn, $userType, $userID);
                }
            }

            // Function to get user data based on user ID and type
            function getUserData($conn, $userType, $userID)
            {
                $sql = "SELECT * FROM " . $userType . "s WHERE " . $userType . "ID = $userID";
                return $conn->query($sql);
            }

            // Function to update user data
            function updateUser($conn, $userType, $userID, $updatedFirstName, $updatedLastName, $updatedDateOfBirth, $updatedEmail, $updatedPhoneNumber)
            {
                $updateSQL = "UPDATE " . $userType . "s 
                                  SET FirstName = '$updatedFirstName', LastName = '$updatedLastName', DateOfBirth = '$updatedDateOfBirth', Email = '$updatedEmail', PhoneNumber = '$updatedPhoneNumber'
                                  WHERE " . $userType . "ID = $userID";

                if ($conn->query($updateSQL) === TRUE) {
                    echo "User data updated successfully.";
                } else {
                    echo "Error updating user data: " . $conn->error;
                }
            }

            // Function to delete user
            function deleteUser($conn, $userType, $userID)
            {
                $deleteSQL = "DELETE FROM " . $userType . "s WHERE " . $userType . "ID = $userID";

                if ($conn->query($deleteSQL) === TRUE) {
                    echo "User with ID $userID has been deleted.";
                } else {
                    echo "Error deleting user: " . $conn->error;
                }
            }

            $conn->close();
            ?>

            <!-- Display Players -->
            <div class="container">
                <h2 class="mt-4">Players</h2>
                <?php
                include 'db_config.php';

                $playersQuery = "SELECT * FROM players";
                $playersResult = $conn->query($playersQuery);

                if ($playersResult->num_rows > 0) {
                    echo '<table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Player ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Date of Birth</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                        </tr>
                    </thead>
                    <tbody>';

                    while ($player = $playersResult->fetch_assoc()) {
                        echo '<tr>
                        <td>' . $player['PlayerID'] . '</td>
                        <td>' . $player['FirstName'] . '</td>
                        <td>' . $player['LastName'] . '</td>
                        <td>' . $player['DateOfBirth'] . '</td>
                        <td>' . $player['Email'] . '</td>
                        <td>' . $player['PhoneNumber'] . '</td>
                    </tr>';
                    }

                    echo '</tbody>
            </table>';
                } else {
                    echo '<p>No players found.</p>';
                }

                $conn->close();
                ?>
            </div>

            <!-- Display Coaches -->
            <div class="container">
                <h2 class="mt-4">Coaches</h2>
                <?php
                include 'db_config.php';

                $coachesQuery = "SELECT * FROM coaches";
                $coachesResult = $conn->query($coachesQuery);

                if ($coachesResult->num_rows > 0) {
                    echo '<table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Coach ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Date of Birth</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                        </tr>
                    </thead>
                    <tbody>';

                    while ($coach = $coachesResult->fetch_assoc()) {
                        echo '<tr>
                        <td>' . $coach['CoachID'] . '</td>
                        <td>' . $coach['FirstName'] . '</td>
                        <td>' . $coach['LastName'] . '</td>
                        <td>' . $coach['DateOfBirth'] . '</td>
                        <td>' . $coach['Email'] . '</td>
                        <td>' . $coach['PhoneNumber'] . '</td>
                    </tr>';
                    }

                    echo '</tbody>
            </table>';
                } else {
                    echo '<p>No coaches found.</p>';
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>
</body>

</html>