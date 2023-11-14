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
    <title>Coach Registration Form</title>
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
        <div class="container registration-margin">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h2 class="mt-4 text-center">Coach Registration</h2>
                    <form action="process_coach_registration.php" method="post">
                        <div class="form-group">
                            <label for="FirstName">First Name:</label>
                            <input type="text" class="form-control" name="FirstName" required>
                        </div>

                        <div class="form-group">
                            <label for="LastName">Last Name:</label>
                            <input type="text" class="form-control" name="LastName">
                        </div>

                        <div class="form-group">
                            <label for="Password">Password:</label>
                            <input type="password" class="form-control" name="Password" required>
                        </div>

                        <div class="form-group">
                            <label for="ConfirmPassword">Confirm Password:</label>
                            <input type="password" class="form-control" name="ConfirmPassword" required>
                        </div>

                        <div class="form-group">
                            <label for="DateOfBirth">Date of Birth:</label>
                            <input type="date" class="form-control" name="DateOfBirth" required>
                        </div>

                        <div class="form-group">
                            <label for="Gender">Gender:</label>
                            <select class="form-control" name="Gender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Email">Email:</label>
                            <input type="email" class="form-control" name="Email">
                        </div>

                        <div class="form-group">
                            <label for="PhoneNumber">Phone Number:</label>
                            <input type="tel" class="form-control" name="PhoneNumber">
                        </div>

                        <div class="form-group">
                            <label for="Address">Address:</label>
                            <textarea class="form-control" name="Address" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="Specialty">Specialty:</label>
                            <input type="text" class="form-control" name="Specialty" required>
                        </div>

                        <div class="form-group">
                            <label for="Certifications">Certifications:</label>
                            <textarea class="form-control" name="Certifications" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="Sports">Select Sports (Hold Ctrl to select multiple sports):</label>
                            <select class="form-control" name="Sports[]" multiple>
                                <?php
                                $startSportID = 101;
                                $sports = ["Cricket", "Tennis", "Soccer", "Basketball", "Badminton", "Athletics", "Volleyball", "Swimming", "Rugby", "Table Tennis"];

                                foreach ($sports as $sport) {
                                    echo "<option value=\"$startSportID\">$sport</option>";
                                    $startSportID++;
                                }
                                ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>