<?php
require "./db_connection.php";
$useremail = $_COOKIE['useremail'];
$query1 = "SELECT * FROM Employee WHERE Email = '$useremail'";
$result1 = $conn->query($query1);
$row1 = $result1->fetch_assoc();
$Organization_Name = $row1['Organization_Name'];
// $AdminLevel = $row1['AdminLevel'];
$AdminLevel = $row1['AdminLevel'];
$query = "SELECT * FROM Project WHERE Status= 'pending' AND Organization_Name = '$Organization_Name'";
$result = $conn->query($query);

$query_1 = "SELECT * FROM Organization Where Organization_Name='$Organization_Name'";
$result_1 = $conn->query($query_1);
$row_1 = $result_1->fetch_assoc();
$Approval_status = $row_1['Access_Level'];
echo $Approval_status;
// Organization_id
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
    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $pid = $row["Project_ID"];
        $title = $row["Title"];
        $cost = $row["Cost"];
        $Status = $row["Status"];
        $estimated_completion = $row["Estimated_Completion"];
        $startedDate = $row["Started_Date"];
        $Organization_Name = $row["Organization_Name"];
        $ss = $row["Approval_status"];
        $Approval_status = unserialize($ss);
    ?>
        <!-- Project Overview Container -->
        <?php
        $i;
        print_r($Approval_status);
        for ($i = count($Approval_status) - 1; $i >= 0; $i--) {
          if ($Approval_status[$i] == "Normal") {
          } else {
            break;
          }
        }
        echo $AdminLevel;
        echo $Approval_status[$i];
        if ($Approval_status[($i)] == $AdminLevel) {
          echo '<a href="Details.php?pid=' . $pid . '">'
        ?>
          <div class="wrapper">
            <div class="container-row">
              <div class="small-logo">
                <img src="images/dcslogo.png" alt="dsc_logo" class="container-img">
              </div>
              <div class="clientname" style="margin-bottom: 10px;">
                <p class="container-subhead"><?php echo $Organization_Name ?></p>
              </div>
            </div>
            <div class="track">
              <h3>
                <p style="overflow: hidden;" class="container-subhead">
                  <?php echo $title ?>
                </p>
              </h3>
            </div>
            <div class="track">
              <div class="container-row space">

                <h3>
                  <p class="container-body">Status -</p>
                </h3>
                <h3>
                  <p class="container-body"> <?php echo $Status ?></p>
                </h3>
              </div>
              <div class="container-row space">

                <h3>
                  <p class="container-body">Started on -</p>
                </h3>
                <h3>
                  <p class="container-body"> <?php echo $startedDate ?></p>
                </h3>
              </div>
              <div class="container-row space">

                <h3>
                  <ntainer-body class="container-body">Estimated completion -</ntainer-body>
                  </h>
                  <h3>
                    <p class="container-body"> <?php echo $estimated_completion ?></p>
                  </h3>
              </div>
              <dv class="container-row space">

                <h3>
                  <p class="container-body">Cost -</p>
                </h3>
                <h3>
                  <p class="container-body"> <?php echo " $cost ₹" ?></p>
                </h3>
              </dv>

            </div>
            <?php echo '<a href="./Accept_Project_Request.php?pid=' . $pid . '">Acccept</a>' ?>
            <?php echo '<a href="./Reject_Project_Request.php?pid=' . $pid . '">Reject</a>' ?>
          </div>
          <?php
          ?>
          </a>
    <?php
        }
      }
    }

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