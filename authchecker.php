<?php
require "./db_connection.php";
$useremail = $_COOKIE['useremail'];
$query = "SELECT * FROM Employee WHERE Email = '$useremail'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    // Access individual fields by column name
    $Organization_Name = $row["Organization_Name"];
    if (!($Organization_Name == "Your Organization")) {
    } else {
      echo "alert('join orgnization first')";
      header("Location:index.php");
    }
    // echo $column1Value;
  }
} else {
  header("Location:index.php");
}
