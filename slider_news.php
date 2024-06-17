<?php
    include 'db_config.php';

    // Define the SQL query to fetch all records from the "news" table
    $query = "SELECT newsTitle, newsBody FROM news";

    // Execute the query
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Initialize an array to store all news records
    $newsRecords = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $newsRecords[] = array(
            'newsTitle' => $row['newsTitle'],
            'newsBody' => $row['newsBody']
        );
    }

    // Close the database connection
    mysqli_close($conn);
?>
