<?php 
require "./db_connection.php";
if(isset($_GET['pid'])){
    $pid = $_GET['pid'];
    $upate_query ="DELETE FROM Project WHERE Project_ID=$pid";
    $update_result = $conn->query($upate_query);
    header("Location:Project_Request.php");

}
else{
}
?>