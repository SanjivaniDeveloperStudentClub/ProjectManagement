<?php
<<<<<<< HEAD
$servername = "sql12.freesqldatabase.com";
$username = "sql12657141";
$password = "Cqqf9XFQUz";
$database = "sql12657141";
=======
$servername = "localhost";
$username = "root";
$password = "Omi@2005";
$database = "PM";
>>>>>>> ad65ea441c30aa30a382564da3b4c2dd0b8322bc

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
