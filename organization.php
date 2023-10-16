<?php
  // Set up a database connection
  require "./db_connection.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the organization name and role from the form
    $useremail = $_COOKIE['useremail'];
    $Employee_name = $_COOKIE['Employee_name'];

    $orgName = $_POST["organization-name"];
    $role = $_POST["Role"];
    $employeeId;
    $organizationName;
//find organization name and employee id
$check_query = "SELECT Employee_id FROM Organization WHERE Organization_Name = '$orgName'";
$result = $conn->query($check_query);
echo $result->num_rows;
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
//     // Access individual fields by column name
    $employeeId = $row["Employee_id"];
echo $employeeId;
}
    // Construct the table name based on the orgName and role
    $tableName = $orgName . "_" . $employeeId;

    // Insert data into the specified table
    $insertQuery = "INSERT INTO " . $tableName . " (REmployee_id, REmployee_Name,Role) VALUES (?, ?,?)";
    
    // Prepare the statement
    $stmt = $conn->prepare($insertQuery);
    
    if ($stmt === false) {
        die("Error in SQL query: " . $conn->error);
    }

    // Bind parameters

    $stmt->bind_param("sss", $employeeId, $Employee_name,$role);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
  }
  else{
    echo "organization not exist";
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
</html>