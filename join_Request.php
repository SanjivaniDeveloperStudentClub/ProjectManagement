<?php
require "./db_connection.php";
$email = $_COOKIE['useremail'];
$query_11 = "SELECT * FROM Employee WHERE Email = '$email'";
$result_11 = $conn->query($query_11);
$orgName;
$employee_id;
$query;
if ($result_11 === false) {
    // Handle the query error here
    echo "no account found";
}
else{
if($result_11->num_rows > 0){
    $row_11 = $result_11->fetch_assoc();
    $orgName = $row_11["Organization_Name"];
}
if($orgName=="Your Organization"){
    $query = "SELECT * FROM Organization WHERE Email = '$email'";
    $result = $conn->query($query);
}
else{
    $query = "SELECT * FROM Organization WHERE Organization_Name = '$orgName'";
    $result = $conn->query($query);
    
}
if ($result->num_rows > 0){
  $row = $result->fetch_assoc();
    // Access individual fields by column name
    $orgName = $row["Organization_Name"];
    $employee_id = $row["Employee_id"];
// echo $orgName;
}
else{
    echo "error";
}

$query1 = "SELECT * FROM $orgName"."_" ."$employee_id";
// echo $query1;
$result1 = $conn->query($query1);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
    <link rel="stylesheet" href="Styles\All.css" />  
    <link rel="stylesheet" href="Styles\Typography.css" />  
    
    <title>Dashboard</title>
</head>

<body>
    <!-- <div class="help-support-main-section"> -->

    <div class="container">

        <!-- Back button with page name -->
        <nav class="top">
            <a href="profile.php">
                <div class="small-circle" style="margin-right: 20px;">
                    <img src="img\Back.png" alt="Back arrow">
                </div>
            </a>
            <div class="large-head">
                <div name="title">Requests</div>
            </div>
        </nav>

    </div>

    <div class="container container-subhead">
        <span style="text-align: left;"></span>
    </div>

    <div class="container">
        <table>
            <thead class="container-body">
                <tr>
                    <td>Empoyeee id</td>
                
                    <td>Name</td>
                    <td style="margin: 0 6vh;">Role</td>
                
                    <td>Accept</td>
                
                    <td>Delete</td>
                </tr>
            </thead>
            <tbody class="container-label">
                <?php
     if ($result1->num_rows > 0) {
  while ($row1 = $result1->fetch_assoc()) {
    // Access individual fields by column name
    $id = $row1["Request_id"];
    $REmployee_Name = $row1["REmployee_Name"];
    $REmployee_id = $row1["REmployee_id"];
    $Role = $row1["Role"];

                ?>
                <tr>
                    <td>
                        <?php echo $REmployee_id; ?>
                    </td>
                    <td>
                    <?php echo $REmployee_Name; ?>
                    </td>
                    <td>
                    <?php echo $Role; ?>
                </td>
                    <td>
                            <button type="button" class="small-button safe-button" value="Accept"  name="Accept"  ><?php echo '<a href="./Accept.php?emp_id='.$id.'"> Accept </a>'; ?></button>
                    </td>
                    <td>
                    <?php  echo '<button type="button" class="small-button danger-button"  ><a value="Accept" href="./Accept.php?empid='.$id.'">Reject</a></button>'; ?>
                    </td>
                </tr>
                <?php
                }
            }
                ?>
            </tbody>
        </table>
    </div>
    
   
</body>
<script>
    // function hello(){
    // hello("om");
    // }
    </script>
</html>