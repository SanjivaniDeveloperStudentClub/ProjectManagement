<?php

function currentuserdetails(){
    // Check if the useremail is set and not empty
    require "./db_connection.php";
    if (isset($_COOKIE['useremail']) && !empty($_COOKIE['useremail'])) {
    $userEmail = $_COOKIE['useremail'];

    // Use a prepared statement to prevent SQL injection
    $query = "SELECT * FROM Employee WHERE Email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();

    // Check for errors
    if ($stmt->error) {
        echo "Query execution error: " . $stmt->error;
        return false;
    } else {
        // Get the result set
return $stmt;
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
} else {
}
}
?>
