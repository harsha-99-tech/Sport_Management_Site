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
    <title>Notices</title>
    <style>
        .notice-card {
            margin: 20px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s;
        }

        .notice-card:hover {
            transform: scale(1.03);
        }
        .card-header{
            background-color: red;
        }

        .card-title {
            color: #fff;
        }
        .card-body{
            color: #fff;
            background-color: #444;
        }
        .container-fluid{
            background-color: #fafafa;
            padding-bottom: 20px;
            padding-top: 20px;
            position: absolute;
            top:75px;
            bottom: 0;
            z-index: -99;
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
    <div class="container-fluid">
        <div class="container">
            <h2 >Notices</h2>

            <!-- Display Notices with Animation -->
            <?php
            // Include your database connection configuration
            include 'db_config.php';

            $noticesQuery = "SELECT newsTitle, newsBody FROM news";
            $noticesResult = $conn->query($noticesQuery);

            while ($notice = $noticesResult->fetch_assoc()) {
                echo '<div class="card notice-card">';
                echo '<div class="card-header">';
                echo '<h5 class="card-title">' . $notice['newsTitle'] . '</h5>'; // Add card-title class
                echo '</div>';
                echo '<div class="card-body">';
                echo '<p class="card-text">' . $notice['newsBody'] . '</p>';
                echo '</div>';
                echo '</div>';
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>

</html>