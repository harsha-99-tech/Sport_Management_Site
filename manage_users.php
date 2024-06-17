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

            </div>
        </nav>
    </header>

    <div class="container-fluid">
        <div class="container heights">
            <h2 class="">Manage Users</h2>

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
                    $userID = $_POST['UserID'];
                    $userType = $_POST['UserType'];

                    // Generate HTML to display the editable fields for the selected user
                    if ($userType == "player") {
                        $sql = "SELECT * FROM " . $userType . "s WHERE " . $userType . "ID = $userID";
                    }
                    if ($userType == "coach") {
                        $sql = "SELECT * FROM " . $userType . "es WHERE " . $userType . "ID = $userID";
                    }

                    $result = $conn->query($sql);

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
                    $userID = $_POST['UserID'];
                    $userType = $_POST['UserType'];

                    // Get updated user data from the form
                    $updatedFirstName = $_POST['FirstName'];
                    $updatedLastName = $_POST['LastName'];
                    $updatedDateOfBirth = $_POST['DateOfBirth'];
                    $updatedEmail = $_POST['Email'];
                    $updatedPhoneNumber = $_POST['PhoneNumber'];

                    // Update the user record in the respective table
                    if ($userType == "player") {
                        $updateSQL = "UPDATE " . $userType . "s 
                                  SET FirstName = '$updatedFirstName', LastName = '$updatedLastName', DateOfBirth = '$updatedDateOfBirth', Email = '$updatedEmail', PhoneNumber = '$updatedPhoneNumber'
                                  WHERE " . $userType . "ID = $userID";
                    }
                    if ($userType == "coach") {
                        $updateSQL = "UPDATE " . $userType . "es 
                                  SET FirstName = '$updatedFirstName', LastName = '$updatedLastName', DateOfBirth = '$updatedDateOfBirth', Email = '$updatedEmail', PhoneNumber = '$updatedPhoneNumber'
                                  WHERE " . $userType . "ID = $userID";
                    }

                    if ($conn->query($updateSQL) === TRUE) {
                        echo "User data updated successfully.";
                    } else {
                        echo "Error updating user data: " . $conn->error;
                    }
                }

                // Query the database based on user ID and type
                if ($userType == "player") {
                    $sql = "SELECT * FROM " . $userType . "s WHERE " . $userType . "ID = $userID";
                }
                if ($userType == "coach") {
                    $sql = "SELECT * FROM " . $userType . "es WHERE " . $userType . "ID = $userID";
                }
                $result = $conn->query($sql);

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
                    $deleteUserID = $_POST['UserID'];
                    $deleteUserType = $_POST['UserType'];

                    // Delete the user record from the respective table
                    if ($deleteUserType == 'player') {
                        $deleteSQL = "DELETE FROM " . $deleteUserType . "s WHERE " . $deleteUserType . "ID = $deleteUserID";
                    }
                    if ($deleteUserType == 'coach') {
                        $deleteSQL = "DELETE FROM " . $deleteUserType . "es WHERE " . $deleteUserType . "ID = $deleteUserID";
                    }

                    if ($conn->query($deleteSQL) === TRUE) {
                        echo "User with ID $deleteUserID has been deleted.";
                    } else {
                        echo "Error deleting user: " . $conn->error;
                    }
                }
            }

            $conn->close();
            ?>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>