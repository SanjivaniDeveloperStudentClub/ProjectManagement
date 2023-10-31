<?php

function userdetails(){
    // Check if the useremail is set and not empty
    require "./db_connection.php";
    if (isset($_POST['id']) && !empty($_POST['id'])) {
    $empid = $_POST['id'];

    // Use a prepared statement to prevent SQL injection
    $query = "SELECT * FROM Employee WHERE Employee_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $empid);
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
function organizationdetails(){
    // Check if the useremail is set and not empty
    require "./db_connection.php";
    if (isset($_POST['orgName']) && !empty($_POST['orgName'])) {
    $orgName = $_POST['orgName'];

    // Use a prepared statement to prevent SQL injection
    $query = "SELECT * FROM Organization WHERE Organization_Name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $orgName);
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
function projectdetails(){
    // Check if the useremail is set and not empty
    require "./db_connection.php";
    if (isset($_POST['orgName']) && !empty($_POST['orgName'])) {
    $orgName = $_POST['orgName'];

    // Use a prepared statement to prevent SQL injection
    $query = "SELECT * FROM Project WHERE Organization_Name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $orgName);
    $stmt->execute();

    // Check for errors
    if ($stmt->error) {
        $stmt->close();
        $conn->close();
        echo "Query execution error: " . $stmt->error;
        return false;
    } else {
        // Get the result set

return $stmt;
    }

    // Close the statement and database connection
   
} else {
}
}
?>
