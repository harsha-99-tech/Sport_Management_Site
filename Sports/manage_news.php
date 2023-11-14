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
    <title>Update or Create News Form</title>
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
        <div class="container" style="padding-bottom:50px">
            <br>
            <h2>Current News</h2>

            <?php
            // Include the database connection code
            include 'db_config.php';

            // Function to safely escape data
            function escapeData($conn, $data)
            {
                return mysqli_real_escape_string($conn, $data);
            }

            // Initialize a variable for the delete message
            $deleteMessage = "";

            // Create or Update News Record
            if (isset($_POST["submit"])) {
                $newID = (int)$_POST["newID"];
                $newsTitle = escapeData($conn, $_POST["newsTitle"]);
                $newsBody = escapeData($conn, $_POST["newsBody"]);
                $important = isset($_POST["important"]) ? 1 : 0; // Convert checkbox value to 1 or 0

                $query = "INSERT INTO news (id, newsTitle, newsBody, important) VALUES ($newID, '$newsTitle', '$newsBody', $important)
                      ON DUPLICATE KEY UPDATE newsTitle = '$newsTitle', newsBody = '$newsBody', important = $important";

                if (mysqli_query($conn, $query)) {
                } else {
                    echo "Error creating or updating news: " . mysqli_error($conn);
                }
            }

            // Delete news record if the delete button is clicked
            if (isset($_POST["deleteNewsID"])) {
                $deleteNewsID = (int)$_POST["deleteNewsID"]; // Cast to integer to prevent SQL injection
                $query = "DELETE FROM news WHERE id = $deleteNewsID";
                if (mysqli_query($conn, $query)) {
                    $deleteMessage = "News (ID: $deleteNewsID) has been deleted.";
                } else {
                    echo "Error deleting news: " . mysqli_error($conn);
                }
            }

            // Display current records in a table
            $query = "SELECT * FROM news";
            $result = mysqli_query($conn, $query);

            echo '<table class="table table-bordered mt-4">';
            echo '<thead class="thead-dark">';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>News Title</th>';
            echo '<th>News Body</th>';
            echo '<th>Important</th>';
            echo '<th>Action</th>';
            echo '</tr>';
            echo '</thead>';

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['newsTitle'] . '</td>';
                    echo '<td>' . $row['newsBody'] . '</td>';
                    echo '<td>' . ($row['important'] ? 'Yes' : 'No') . '</td>';
                    echo '<td>';
                    echo '<form method="POST" action="' . $_SERVER['PHP_SELF'] . '">';
                    echo '<input type="hidden" name="deleteNewsID" value="' . $row['id'] . '">';
                    echo '<input type="submit" class="btn btn-danger" value="Delete" onclick="return confirmDelete();">';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo 'Error: ' . mysqli_error($conn);
            }

            echo '</table><br>';


            ?>

            <!-- New "Add News" section -->
            <h3>Add or Update News</h3>
            <div class="mt-4 p-3 border rounded" style="background-color: #f5f5f5;">
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <?php
                    // Find the last ID and increment it by 1 for the new record
                    $query = "SELECT MAX(id) as max_id FROM news";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    $newID = $row['max_id'] + 1;
                    ?>

                    <div class="form-group">
                        <label for="id">ID (optional):</label>
                        <input type="number" name="newID" id="id" class="form-control" value="<?php echo $newID; ?>">
                    </div>

                    <div class="form-group">
                        <label for="newsTitle">News Title:</label>
                        <input type="text" name="newsTitle" id="newsTitle" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="newsBody">News Body:</label>
                        <textarea name="newsBody" id="newsBody" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" name="important" id="important" class="form-check-input">
                        <label class="form-check-label" for="important">Mark as Important</label>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary" onclick="return confirmCreate();">Create News</button>
                </form>
            </div>
        </div>

        <?php


        // Close the database connection when done
        mysqli_close($conn);
        ?>
    </div>



</body>

</html>