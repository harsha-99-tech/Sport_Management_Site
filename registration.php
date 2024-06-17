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
    <title>Registration Page</title>
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

    <div class="container-fluid heights text-center d-flex flex-column align-items-center justify-content-center">
        <h2>Choose Your Registration Type</h2>
        <div>
            <form method="post" action="">
                <button type="submit" class="btn btn-primary" name="registrationType" value="player">I'm a Player</button>
                <button type="submit" class="btn btn-secondary" name="registrationType" value="coach">I'm a Coach</button>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['registrationType'])) {
        $registrationType = $_POST['registrationType'];

        if ($registrationType === "player") {
            header('location:player_registration.php');
        } elseif ($registrationType === "coach") {
            header('location: coach_registration.php');
        } else {
            echo "Invalid choice.";
        }
    }
    ?>
</body>

</html>