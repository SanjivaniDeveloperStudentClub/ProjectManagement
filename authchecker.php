<?php
require "./db_connection.php";
$useremail =$_COOKIE['useremail'];
$query = "SELECT * FROM Employee WHERE Email = '$useremail'";
$result = $conn->query($query);
$username;
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    // Access individual fields by column name
    $Organization_Name = $row["Organization_Name"];
    if(!($Organization_Name=="Your Organization")){
echo $Organization_Name;
    }
    else{
        echo "alert('join orgnization first')";
        header("Location:organization.php");
    }
// echo $column1Value;
}
}

?>