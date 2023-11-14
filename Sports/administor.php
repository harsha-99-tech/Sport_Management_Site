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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Administrator Dashboard</title>
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

    <div class="container-fluid admin">
        <div class="container" style="gap:10px">
            <h2>Administrator Dashboard</h2>
            <p>Current Time: <?php echo date('Y-m-d H:i:s'); ?></p>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Inventory Management</h5>
                            <p class="card-text">Manage equipment and inventory.</p>
                            <a href="manage_inventory.php" class="btn btn-primary">Go to Inventory</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">User Management</h5>
                            <p class="card-text">Manage user accounts and permissions.</p>
                            <a href="manage_users.php" class="btn btn-primary">Go to Users</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">News Management</h5>
                            <p class="card-text">Manage and publish news updates.</p>
                            <a href="manage_news.php" class="btn btn-primary">Go to News</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Match Management</h5>
                            <p class="card-text">Manage sports matches and results.</p>
                            <a href="manage_matches.php" class="btn btn-primary">Go to Matches</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Practice Management</h5>
                            <p class="card-text">Manage Practices and Schedule them.</p>
                            <a href="manage_practices.php" class="btn btn-primary">Go to Practices</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>