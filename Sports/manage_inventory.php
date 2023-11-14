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
    <link rel="stylesheet" href="assets/css/inventory.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
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
        <div class="container padding-bottom mt-4">
            <h2 class="text-center">Manage Inventory</h2>

            <!-- Add Equipment Form -->
            <div class="mt-4">
                <h3>Add Equipment</h3>
                <form action="manage_inventory.php" method="post">
                    <div class="form-group">
                        <label for="equipmentName">Equipment Name:</label>
                        <input type="text" class="form-control" name="equipmentName" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control" name="quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="availability">Availability:</label>
                        <select class="form-control" name="availability" required>
                            <option value="Available">Available</option>
                            <option value="Not Available">Not Available</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="addEquipment">Add</button>
                </form>
            </div>

            <?php
            // Include database configuration
            include 'db_config.php';

            // Check database connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['addEquipment'])) {
                    $equipmentName = $_POST['equipmentName'];
                    $quantity = $_POST['quantity'];
                    $availability = $_POST['availability'];

                    // Insert new equipment
                    $sql = "INSERT INTO inventory (equipmentName, quantity, availability) VALUES (?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sds", $equipmentName, $quantity, $availability);

                    if ($stmt->execute()) {
                        echo "Equipment added successfully.";
                    } else {
                        echo "Error adding equipment: " . $stmt->error;
                    }
                    $stmt->close();
                }

                if (isset($_POST['editEquipment'])) {
                    // Handle editing equipment
                    if (isset($_POST['equipmentID'])) {
                        $equipmentID = $_POST['equipmentID'];
                        $sql = "SELECT * FROM inventory WHERE EquipmentID = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $equipmentID);

                        if ($stmt->execute()) {
                            $result = $stmt->get_result();
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                echo "<h3>Edit Equipment</h3>";
                                echo '<form action="manage_inventory.php" method="post">
                                    <input type="hidden" name="equipmentID" value="' . $row["EquipmentID"] . '">
                                    <div class="form-group">
                                        <label for="equipmentName">Equipment Name:</label>
                                        <input type="text" class="form-control" name="equipmentName" value="' . $row["EquipmentName"] . '" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantity:</label>
                                        <input type="number" class="form-control" name="quantity" value="' . $row["Quantity"] . '" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="availability">Availability:</label>
                                        <select class="form-control" name="availability" required>
                                            <option value="Available" ' . ($row["Availability"] == "Available" ? 'selected' : '') . '>Available</option>
                                            <option value="Not Available" ' . ($row["Availability"] == "Not Available" ? 'selected' : '') . '>Not Available</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="updateEquipment">Update</button>
                                </form>';
                            } else {
                                echo "Equipment not found.";
                            }
                        }
                        $stmt->close();
                    }
                }

                if (isset($_POST['updateEquipment'])) {
                    // Handle updating equipment
                    if (isset($_POST['equipmentID'])) {
                        $equipmentID = $_POST['equipmentID'];
                        $equipmentName = $_POST['equipmentName'];
                        $quantity = $_POST['quantity'];
                        $availability = $_POST['availability'];

                        // Implement the SQL UPDATE statement
                        $sql = "UPDATE inventory SET equipmentName = ?, quantity = ?, availability = ? WHERE EquipmentID = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("sdsi", $equipmentName, $quantity, $availability, $equipmentID);

                        if ($stmt->execute()) {
                            echo "Equipment updated successfully.";
                        } else {
                            echo "Error updating equipment: " . $stmt->error;
                        }
                        $stmt->close();
                    }
                }

                if (isset($_POST['removeEquipment'])) {
                    // Handle removing equipment
                    if (isset($_POST['equipmentID'])) {
                        $equipmentID = $_POST['equipmentID'];
                        $sql = "DELETE FROM inventory WHERE EquipmentID = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $equipmentID);

                        if ($stmt->execute()) {
                            echo "Equipment removed successfully.";
                        } else {
                            echo "Error removing equipment: " . $stmt->error;
                        }
                        $stmt->close();
                    }
                }
            }
            ?>

            <!-- Equipment List -->
            <div class="mt-4">
                <h3>Equipment List</h3>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Equipment Name</th>
                            <th>Quantity</th>
                            <th>Availability</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM inventory";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo '<form action="manage_inventory.php" method="post">';
                                echo '<input type="hidden" name="equipmentID" value="' . $row["EquipmentID"] . '">';
                                echo '<td><input type="text" class="form-control" name="equipmentName" value="' . $row["EquipmentName"] . '"></td>';
                                echo '<td><input type="number" class="form-control" name="quantity" value="' . $row["Quantity"] . '"></td>';
                                echo '<td>
                                    <select class="form-control" name="availability">
                                        <option value="Available" ' . ($row["Availability"] == "Available" ? 'selected' : '') . '>Available</option>
                                        <option value="Not Available" ' . ($row["Availability"] == "Not Available" ? 'selected' : '') . '>Not Available</option>
                                    </select>
                                </td>';
                                echo '<td>
                                    <button type="submit" class="btn btn-primary" name="editEquipment">Edit</button>
                                    <button type="submit" class="btn btn-danger" name="removeEquipment">Remove</button>
                                </td>';
                                echo '</form>';
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Search Equipment Form -->
            <div class="mt-4">
                <h3>Search Equipment</h3>
                <form action="manage_inventory.php" method="post">
                    <div class="form-group">
                        <label for="searchKeyword">Search by Equipment Name:</label>
                        <select class="form-control" name="searchKeyword" required>
                            <option value="Cricket Balls">Cricket Balls</option>
                            <option value="Knee Guards">Knee Guards</option>
                            <option value="Gloves">Gloves</option>
                            <!-- Add more options for other equipment -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="searchEquipment">Search</button>
                </form>
            </div>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['searchEquipment'])) {
                    $searchKeyword = $_POST['searchKeyword'];

                    $sql = "SELECT * FROM inventory WHERE equipmentName = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $searchKeyword);

                    if ($stmt->execute()) {
                        $result = $stmt->get_result();
                        echo "<h3>Search Results</h3>";
                        echo "<table class='table table-bordered'>";
                        echo "<thead>
                            <tr>
                                <th>Equipment Name</th>
                                <th>Quantity</th>
                                <th>Availability</th>
                            </tr>
                        </thead>";

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["EquipmentName"] . "</td>";
                                echo "<td>" . $row["Quantity"] . "</td>";
                                echo "<td>" . $row["Availability"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No results found.</td></tr>";
                        }
                        $stmt->close();
                    }
                }
            }
            ?>

            <?php
            // Close the database connection
            $conn->close();
            ?>
        </div>
    </div>


</body>

</html>