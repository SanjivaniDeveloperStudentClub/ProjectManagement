<?php
function fetchuserdetail(){
    require "./db_connection.php";
    $useremails = $_COOKIE['useremail'];
    $query = "SELECT * FROM Employee WHERE Email = 'useremails'";
    $result = $conn->query($query);
    $username;
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    else{
        return "no user found";
    }
}

?>