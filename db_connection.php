<?php
$servername = "localhost";
$username = "root";
$password = "Omi@2005";
$database = "PM";

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
