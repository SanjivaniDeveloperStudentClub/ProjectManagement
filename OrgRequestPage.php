<?php
require "./php/currentuser_details.php";
require "./db_connection.php";
$row = currentuserdetails();
if ($row['Organization_Name'] == "Your Organization") {
} else {
    header("Location:EditProfile.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Wait until Organization Accept Your Request</h2>
</body>

</html>