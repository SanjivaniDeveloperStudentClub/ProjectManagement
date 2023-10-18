<?php
  // Set up a database connection
  require "./db_connection.php";
  // require "./userdetails.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the organization name and role from the form
    $useremail = $_COOKIE['useremail'];
    $orgName = $_POST["organization-name"];
    $role = $_POST["Role"];
    //checking orginaztion

    $check_query_1 = "SELECT * FROM Organization WHERE Organization_Name = '$orgName'";
    $result_1 = $conn->query($check_query_1);
if($result_1->num_rows>0){
    //gettin user details
    $check_query = "SELECT * FROM Employee WHERE Email = '$useremail'";
    $result = $conn->query($check_query);
$userid;
$Employee_name;
    if ($result->num_rows > 0) {
      $row=$result->fetch_assoc();
$userid= $row["Employee_id"];
$Employee_name = $row['Employee_Name'];
echo "userid".$userid;
    } 
    else{
      header("Location:register.php");
    }
$employee_id;
//find organization name and employee id
$check_query = "SELECT Employee_id FROM Organization WHERE Organization_Name = '$orgName'";
$result = $conn->query($check_query);
echo $result->num_rows;
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    //     // Access individual fields by column name
        $employee_id = $row["Employee_id"];
    }
  }
  else{
    // header("Location:");
    echo "no orignaztion exist";
  }
$check_query2 = "SELECT * FROM $orgName WHERE Employee_Email = '$useremail'";
echo $orgName;
try{
$result_2 = $conn->query($check_query2);
echo $result_2->num_rows;
if ($result_2->num_rows > 0) {
 echo "already join the orignization";
}else{
  // if()
  $row = $result_2->fetch_assoc();
  $check_query3 = "SELECT * FROM " . $orgName . "_" . $employee_id . " WHERE REmployee_id = '$userid'";
  echo $check_query3;
  $result_3 = $conn->query($check_query3);
  echo $result_3->num_rows;
  if (!$result_3->num_rows > 0) {
    
    // Construct the table name based on the orgName and role
    $tableName = $orgName . "_" . $employee_id;

    // Insert data into the specified table
    $insertQuery = "INSERT INTO " . $tableName . " (REmployee_id, REmployee_Name,Role) VALUES (?, ?,?)";
    
    // Prepare the statement
    $stmt = $conn->prepare($insertQuery);
    
    if ($stmt === false) {
        die("Error in SQL query: " . $conn->error);
    }

    // Bind parameters

    $stmt->bind_param("sss", $userid, $Employee_name,$role);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
  
}else{
  echo $conn->error;
  echo "you already had a requested wait for accepting the request";
}

}
}catch(error){
// echo "orginaztion doest not exist";
}
}
else{
  
  echo "orginaztion doest not exist";
}
}
 
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Join organization</title> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
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

    <!-- Login Container -->
    <div class="container">
      <div class="wrapper">
        <div class="container-large-head">
          <span>Organization</span>
        </div>
        
        <form action="organization.php" method="POST">  

          <!-- Email -->
          <label for="organization-name" class="container-subhead">Organization Name</label>
          <input type="text" name="organization-name" placeholder="Enter Organization name" id="organization-name" class="textfield">

          <!-- Role selector -->
          <label for="Role" class="container-subhead">Enter role</label>
          <input type="text" name="Role" placeholder="Enter your role in organization" id="email">
          
          <!-- Request to join button -->
          <div class="row button">
            <input type="submit" value="Request to join" style="margin-top:20px ;">
          </div>
          
          <!-- Create an organization -->
          <div class="container-label">Want to create an organization? <a href="CreateOrg.php">Register organization</a></div>

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