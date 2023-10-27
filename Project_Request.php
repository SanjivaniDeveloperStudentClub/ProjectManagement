<?php 
require "./db_connection.php";
$query = "SELECT * FROM Project WHERE Status= 'pending'";
  $result = $conn->query($query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
  <link rel="stylesheet" href="Styles\All.css" />
  <link rel="stylesheet" href="Styles\Typography.css" />

  <title>Logs</title>

</head>

<body>
  <div class="container">
    <!-- App Name -->
    <nav class="top">
      <div class="large-head">
        <div name="title">Project Management</div>
      </div>

      <div class="small-circle">
        <img src="img\search.png" alt="Back arrow">
      </div>
    </nav>

    <!-- Home page body -->
    <!-- <div class="container"> -->

      <!-- Scrolling tabs for filtering the data -->

<?php
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $pid = $row["Project_ID"];
                    $title = $row["Title"];
                    $cost = $row["Cost"];
                    $Status = $row["Status"];
                    $estimated_completion = $row["Estimated_Completion"];
                    $startedDate = $row["Started_Date"];
                    $Organization_Name = $row["Organization_Name"];
?>
<!-- Project Overview Container -->
<<<<<<< HEAD
      <?php echo'<a href="Details.php?pid='.$pid.'">'hom
=======
      <?php echo'<a href="Details.php?pid='.$pid.'">'
>>>>>>> ad65ea441c30aa30a382564da3b4c2dd0b8322bc
      ?>
            <div class="wrapper">
                <div class="container-row">
                    <div class="small-logo">
                        <img src="images/dcslogo.png" alt="dsc_logo" class="container-img">
                    </div>
                    <div class="clientname" style="margin-bottom: 10px;">
<<<<<<< HEAD
                        <p class="container-subhead"><?php echo $Organization_Name ?></p>
=======
                        <p class="container-subhead"><?php echo $_COOKIE['Employee_name'] ?></p>
>>>>>>> ad65ea441c30aa30a382564da3b4c2dd0b8322bc
                    </div>
                </div>
                <div class="track">
                    <h3>
                        <p style="overflow: hidden;" class="container-subhead">
                        <?php echo $title?>
    </p>
                    </h3>
                </div>
                <div class="track">
                    <div class="container-row space">

                        <h3>
                            <p class="container-body">Status -</p>
                        </h3>
                        <h3>
                            <p class="container-body"> <?php echo $Status?></p>
                        </h3>
                    </div>
                    <div class="container-row space">

                        <h3>
                            <p class="container-body">Started on -</p>
                        </h3>
                        <h3>
                            <p class="container-body"> <?php echo $startedDate?></p>
                        </h3>
                    </div>
                    <div class="container-row space">

                        <h3>
                            <p class="container-body">Estimated completion -</p>
                        </h3>
                        <h3>
                            <p class="container-body"> <?php echo $estimated_completion?></p>
                        </h3>
                    </div>
                    <div class="container-row space">

                        <h3>
                            <p class="container-body">Cost -</p>
                        </h3>
                        <h3>
                            <p class="container-body"> <?php echo " $cost ₹"?></p>
                        </h3>
                    </div>

                </div>
                <?php echo '<a href="./Accept_Project_Request.php?pid='.$pid.'">Acccept</a>' ?>
                <?php echo '<a href="./Reject_Project_Request.php?pid='.$pid.'">Reject</a>' ?>
            </div>
            <?php
            ?>
        </a>
     <?php
    }}
     ?>
    <!-- </div> -->

    <!-- Bottom Navigation Bar -->
    <div class="bnav-wrapper">
      <div class="bnav">
        <a href="Home.php"><img src="images/home.svg" alt="Home"></a>
        <a href="Logs.php"><img src="images/Logs.svg" alt="Logs"></a>
        <a href="Notification.php">Alerts</a>
        <a href="Profile.php"><img src="images/Profile.svg" alt="Profile"></a>
      </div>
    </div>


  </div>
  </div>

</body>

</html>