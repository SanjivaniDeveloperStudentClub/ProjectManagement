<?php
// Include your database connection code here
require "./db_connection.php";

// Include your database connection code here
$useremail = $_COOKIE['useremail'];
if(!($useremail)){
header("Location:index.php");
}
$check_query = "SELECT * FROM Organization WHERE Email = '$useremail'";
$result = $conn->query($check_query);
$Access;
$check_query2 = "SELECT * FROM Employee WHERE Email = '$useremail'";
$result2 = $conn->query($check_query2);
   if($result2->num_rows > 0){
    $row = $result2->fetch_assoc();
    $orgName = $row["Organization_Name"];
    if($orgName=="Your Organization"){
        $orgName = "";

    }
    else{
        $check_query2 = "SELECT * FROM $orgName WHERE Employee_Email = '$useremail'";
        $result2 = $conn->query($check_query2);
        if( $result2->num_rows > 0){
            $row = $result2->fetch_assoc();
            $Access = $row["Access"];
    }
    else{
        $orgName="";
    }
   }
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

    <title>Profile</title>

</head>

<body>
<!-- <div class="container"> -->
        <!-- App Name -->
        <nav class="top">
            <div class="large-head">
                <div name="title">Project</div>
            </div>
            <div class="small-circle">
                <img src="img\search.png" alt="Back arrow">
            </div>
        </nav>

        <!-- Home page body -->
        <div class="container">

            <!-- Profile Overview Container -->
            <div class="logobox">
                <div class="medium-logo">
                    <img src="images/dcslogo.png" alt="Developer Student Club Logo" class="logo-width">
                </div>
            </div>

            <!-- User Name -->
            <div class="clientname">
                <p class="container-head">Developer Students Club</p>
            </div>

            <!-- Post -->
            <div class="clientname">
                <p class="container-head">Club</p>
            </div>
        </div>

        <a href="EditProfile.php">
            <!-- Submit button -->
            <div class="container">
                <input type="button" value="Edit Profile" class="edit-button">
            </div>
        </a>
<?php
if (($result->num_rows > 0)||$Access=="admin"||$Access=="Admin") {
    
?>
        <div class="container container-large-head">
            <span style="text-align: left;">Admin</span>
        </div>

        <div class="container">

            <a href="dashboard.php">
                <div class="wrapper">
                    <div class="container-row">
                        <div class="small-logo">
                            <img src="img\admin-panel.png" alt="Admin logo" style="width: 30px;">
                        </div>
                        <!-- <div class="clientname" > -->
                        <div class="container-text">
                            <p class="container-head">Dashboard</p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="join_Request.php">
                <div class="wrapper">
                    <div class="container-row">
                        <div class="small-logo">
                            <img src="img\admin-panel.png" alt="Admin logo" style="width: 30px;">
                        </div>
                        <!-- <div class="clientname" > -->
                        <div class="container-text">
                            <p class="container-head">Request to join</p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="Project_Request.php">
                <div class="wrapper">
                    <div class="container-row">
                        <div class="small-logo">
                            <img src="img\admin-panel.png" alt="Admin logo" style="width: 30px;">
                        </div>
                        <!-- <div class="clientname" > -->
                        <div class="container-text">
                            <p class="container-head">Project Management</p>
                        </div>
                    </div>
                </div>
            </a>

        </div>
<?php
}

?>
        <div class="container container-large-head">
            <span style="text-align: left;">Others</span>
        </div>

        <div class="container">

            <a href="Help_Support.php">
                <div class="wrapper">
                    <div class="container-row">
                        <div class="small-logo">
                            <img src="images\help and support.svg" alt="dsc_logo" style="width: 30px;">
                        </div>
                        <!-- <div class="clientname" > -->
                        <div class="container-text">
                            <p class="container-head">Help and Support</p>
                        </div>
                    </div>
                </div>
            </a>

            <a href="About.php">
                <div class="wrapper">
                    <div class="container-row">
                        <div class="small-logo">
                            <img src="images\About us.svg" alt="dsc_logo" style="width: 30px;">
                        </div>
                        <!-- <div class="clientname" > -->
                        <div class="container-text">
                            <p class="container-head">About us</p>
                        </div>
                    </div>
                </div>
            </a>

        </div>


        <form action="index.php">
            <div class="logout" style="margin-bottom: 100px;">
                <input type="submit" value="Logout" class="danger-button container-medhead" style="text-align: center; justify-content: center; color: var(--body-background);">
            </div>
        </form>

        <!-- Bottom Navigation Bar -->
        <div class="bnav-wrapper">
            <div class="bnav">
                <a href="Home.php"><img src="images/home.svg" alt="Home"></a>
                <a href="Logs.php"><img src="images/Logs.svg" alt="Logs"></a>
                <a href="Notification.php"><img src="images/Notification.svg" alt="Notifications"></a>
                <a href="Profile.php">Profile</a>
            </div>
        </div>

    <!-- </div> -->


</body>

</html>