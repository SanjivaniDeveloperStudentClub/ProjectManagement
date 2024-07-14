<?php
// $servername = "sql12.freesqldatabase.com";
// $username = "sql12657141";
// $password = "Cqqf9XFQUz";
// $database = "sql12657141";
$servername = "localhost";
$username = "root";
// $password = "luffy@0852";
$password = "sidd";
$database = "pm";

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
