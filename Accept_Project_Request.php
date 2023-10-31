<?php 
require "./db_connection.php";
if(isset($_GET['pid'])){
    $pid = $_GET['pid'];
    $upate_query ="UPDATE Project
    SET Status = 'On-Going'
    WHERE Project_ID=$pid";
    $update_result = $conn->query($upate_query);
    // echo $update_result;
    header("Location:Project_Request.php");
}
?>