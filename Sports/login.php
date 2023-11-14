<?php
session_start(); // Start the session to store user information

$loggedIn = !(isset($_SESSION['user_id']));

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_type'] == "admin") {
        header("Location: index.php"); // Redirect to the dashboard if already logged in
        exit();
    } else {
        header("Location: index.php"); // Redirect to the dashboard if already logged in
        exit();
    }
}

// Include your database connection configuration
include 'db_config.php';

// Handle login form submission
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];

    // Check user type and perform login accordingly
    switch ($userType) {
        case 'player':
            $loginQuery = "SELECT * FROM players WHERE PlayerID=? AND Password=?";
            $redirectPage = "index.php";
            break;

        case 'coach':
            $loginQuery = "SELECT * FROM coaches WHERE CoachID=? AND Password=?";
            $redirectPage = "index.php";
            break;

        case 'admin':
            $loginQuery = "SELECT * FROM admins WHERE Username=? AND Password=?";
            $redirectPage = "index.php";
            break;

        default:
            $loginError = "Invalid user type";
    }

    // Check if the entered credentials match a user in the database
    if (isset($loginQuery)) {
        $stmt = $conn->prepare($loginQuery);
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // User found, set session variables and redirect to the appropriate dashboard
            $userData = $result->fetch_assoc();
            $_SESSION['user_id'] = $userData['PlayerID'] ?? $userData['CoachID'] ?? $userData['Username'];
            $_SESSION['user_type'] = $userType;
            header("Location: " . $redirectPage);
            exit();
        } else {
            $loginError = "Invalid username or password";
        }

        $stmt->close();
    }
}
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
    <title>User Login</title>
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
                            <a href="registration.php">
                                <button class="btn primary-bg-color text-white">Register</button>
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container-fluid">
        <div class="container">
            <h2 class="my-4">User Login</h2>

            <?php
            if (isset($loginError)) {
                echo '<div class="alert alert-danger" role="alert">' . $loginError . '</div>';
            }
            ?>

            <form class="form" action="" method="post">
                <div class="form-group">
                    <label for="username">Player/Coach/Admin ID:</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="form-group">
                    <label for="userType">User Type:</label>
                    <select class="form-control" name="userType" required>
                        <option value="player">Player</option>
                        <option value="coach">Coach</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="login">Login</button>
            </form>
        </div>
    </div>

</body>

</html>