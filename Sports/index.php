<?php
session_start();
$loggedIn = isset($_SESSION['user_id']);
$isAdmin = ($loggedIn && $_SESSION['user_type'] == "admin");
$isPlayer = ($loggedIn && $_SESSION['user_type'] == "player");
$isCoach = ($loggedIn && $_SESSION['user_type'] == "coach");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/features.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <title>Sports Management System</title>
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
                    <?php if ($isAdmin) : ?>
                        <li class="nav-item mr-4">
                            <a class="nav-link" href="administor.php">Admin</a>
                        </li>
                    <?php elseif ($isPlayer) : ?>
                        <li class="nav-item mr-4">
                            <a class="nav-link" href="player.php">Player Profile</a>
                        </li>
                    <?php elseif ($isCoach) : ?>
                        <li class="nav-item mr-4">
                            <a class="nav-link" href="manage_practices.php">Manage Practices</a>
                        </li>
                    <?php endif ?>
                    <?php if ($loggedIn) : ?>
                        <li class="nav-item">
                            <form action="logout.php" method="post">
                                <button type="submit" class="btn primary-bg-color text-white">Logout</button>
                            </form>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a href="login.php" class="btn btn-primary text-white">Login</a>
                        </li>&emsp;
                        <li class="nav-item">
                            <a href="registration.php" class="btn primary-bg-color text-white">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>

    <div class="slider">
        <div id="carouselCaptions" class="carousel slide" data-ride="carousel" data-interval="2500">
            <?php include 'slider_handler.php' ?>
            <button class="carousel-control-prev" type="button" data-target="#carouselCaptions" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#carouselCaptions" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </button>
        </div>

    </div>

    <div class="container-fluid">
        <?php include 'features.php'; ?>
    </div>

</body>

</html>