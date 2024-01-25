<?php
require "./db_connection.php";
if (isset($_GET['pid'])) {
    $useremail = $_COOKIE['useremail'];

    $pid = $_GET['pid'];
    $query1 = "SELECT * FROM Employee WHERE Email = '$useremail'";
    $result1 = $conn->query($query1);
    $row1 = $result1->fetch_assoc();
    $AdminLevel = $row1['AdminLevel'];
    $query = "SELECT * FROM Project WHERE Project_ID= $pid";
    $result2 = $conn->query($query);
    $row2 = $result2->fetch_assoc();
    $Approval_status = $row2['Approval_status'];
    $Approval_status = unserialize($Approval_status);
    for ($i = 0; $i < count($Approval_status) - 1; $i++) {
        
        if ($Approval_status[$i] == $AdminLevel) {
            $Approval_status[$i] = "Normal";
            break;
        }
    }
    if ($Approval_status[0] == "Normal") {
        $upate_query = "UPDATE Project
        SET Status = 'On-Going'
        WHERE Project_ID=$pid";
        $update_result = $conn->query($upate_query);
    }
    print_r($Approval_status);
    $Approval_status = serialize($Approval_status);
    $upate_query = "UPDATE Project
    SET Approval_status = '$Approval_status'
    WHERE Project_ID=$pid";
    $update_result = $conn->query($upate_query);
}
// echo $update_result;
header("Location:Project_Request.php");
