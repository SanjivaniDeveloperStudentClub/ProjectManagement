<?php
// Include your database connection code here
require "./db_connection.php";
//getting employee ud
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if(isset($_POST['submit'])){
    $orgName = $_POST["org_name"];
    $orgEmail = $_POST["org_email"];
    $orgContact = $_POST["org_contact"];
$useremail = $_COOKIE['useremail'];
echo $useremail;
$column1Value;
$result = "SELECT *from employee where email=$useremail";
$check_query = "SELECT * FROM Organization WHERE Organization_Name = '$orgName'";
$check1_query = "SELECT * FROM Organization WHERE Email = '$useremail'";

$result = $conn->query($check1_query);
if (!($result->num_rows > 0)) {

$result = $conn->query($check_query);
if (!($result->num_rows > 0)) {

$check_query = "SELECT Employee_id FROM Employee WHERE Email = '$useremail'";
$check_query2 = "SELECT Organization_Email FROM Organization WHERE Organization_Email = '$orgEmail'";
$result = $conn->query($check_query);
$result2 = $conn->query($check_query2);
// echo "result2";
// echo $result2;

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    // Access individual fields by column name
    $column1Value = $row["Employee_id"];
// echo $column1Value;
}
if ($result2->num_rows > 0) {
echo "email already exist ";
// return 0;
}else{
  

    $designation = "Default";
    $department = "Default";
    $branch = "Default";
    $employee = "Default";

$insertQuery = "INSERT INTO Organization (Organization_Name,Organization_Email, Designation, Department, Branch, Employee_id,Contact_No,Email) VALUES ('$orgName', '$orgEmail', '$designation', '$department','$branch','$column1Value','$orgContact','$useremail')";
$CreateQuery = "CREATE TABLE " . $orgName . "_" . $column1Value . " (
  Request_id INT AUTO_INCREMENT PRIMARY KEY,
  REmployee_id INT,
  REmployee_Name TEXT,
  Role TEXT
)";
$CreateQuery2 = "CREATE TABLE $orgName (
  Employee_Id integer ,
  Employee_Name text,
  Access text,
  Employee_Email text
)";

// Assuming you have default values for Designation, Department, Branch, and Employee

if ($conn->query($insertQuery)) {
  echo "Orginzation created successful!";
  // header("Location:organization.php");
} else {
  echo "Fill all fileds properly $conn->error";
}
if ($conn->query($CreateQuery)) {
  //dont show this message
  echo "table created successful!";
  // header("Location:organization.php");
} else {
  echo " orginazation already exist1";
}
if ($conn->query($CreateQuery2)) {
  //dont show this message
  echo "table created successful!";
  $upate_query ="UPDATE employee
SET Organization_Name = '$orgName'
WHERE Email='$useremail'";
$update_result = $conn->query($upate_query);
  header("Location:home.php");
} else {
  echo " orginazation already exist2";
  echo $conn->error;
}
}
  }
  else{
    echo "try to login first";
  }
}
else {
  echo "organization already exist";
}
}
else{
  echo "you can create only one orignization";
}
}
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Organization</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="Styles\All.css" />
    <link rel="stylesheet" href="Styles\Typography.css" />
</head>

<body>

    <!-- DSC LOGO -->
    <div class="logobox">
        <div class="logo">
            <img src="images/dcslogo.png" alt="Developer Student Club Logo" class="logo-width">
        </div>
    </div>

    <!-- Organization Registration Container -->
    <div class="container">
        <div class="wrapper">
            <div class="container-large-head">
                <span>Organization Registration</span>
            </div>

            <form action="CreateOrg.php" method="post">

                <!-- Organization Name -->
                <label for="org-name" class="container-subhead">Organization Name</label>
                <input type="text" name="org_name" id="org-name" placeholder="Enter organization name" required>

                <!-- Email -->
                <label for="org-email" class="container-subhead">Email</label>
                <input type="email" name="org_email" id="org-email" placeholder="Enter email id" required>

                <!-- Helpline Number -->
                <label for="org-contact" class="container-subhead">Helpline Number</label>
                <input type="tel" name="org_contact" id="org-contact" placeholder="Enter helpline number" required>

                <!-- Submit button -->
                <div class="row button">
                    <input type="submit" value="Register" name="submit" style="margin-top: 20px;">
                </div>

                <!-- Join an existing organization -->
                <div class="container-label">Join an existing organization? <a href="organization.php">Join organization</a></div>

            </form>
        </div>
    </div>

</body>
<script>
if(window.history.replaceState){
window.history.replaceState(null,null,window.location.href);

}
</script>
</html>
