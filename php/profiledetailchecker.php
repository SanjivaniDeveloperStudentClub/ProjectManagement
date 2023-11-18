<?php
require "./db_connection.php";
$useremail = $_COOKIE['useremail'];

$sql = "SELECT * from Employee Where Email=$useremail";
$result  = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row['Deparment'] && $row['Branch'] && $row['Post']) {
} else {
    header("Location:EditProfile.php");
}
