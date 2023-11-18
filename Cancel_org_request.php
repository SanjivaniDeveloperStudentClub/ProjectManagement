<?php
require "./db_connection.php";
require "./php/currentuser_details.php";

if (isset($_COOKIE['orgname'])) {

    // Enable error reporting for debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $row1 = currentuserdetails();
    $empid = $row1['Employee_id'];
    $orgname = $_COOKIE['orgname']; // Assuming you have a sanitization function

    $check_query_1 = "SELECT * FROM Organization WHERE Organization_Name = '$orgname'";
    $result_1 = $conn->query($check_query_1);
    $row = $result_1->fetch_assoc();
    $id = $row['Employee_id'];
    $tablename = $orgname . '_' . $id;

    $sql = "SELECT * FROM $tablename WHERE REmployee_id = " . $empid;
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {


        $sql = "DELETE FROM $tablename WHERE REmployee_id = " . $empid;
        $result = $conn->query($sql);

        if ($result) {
            echo "Delete successful";
            header("Location:organization.php");
        } else {
            echo "Error: " . $conn->error;
        }
    } else {

        echo "no request found";
    }
} else {
    echo "no request found";
}
