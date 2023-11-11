<?php
require './db_connection.php';
require './authchecker.php';
$query = "SELECT * FROM Project";

$result = $conn->query($query);
$username;
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
                <div name="title">Project</div>
            </div>

            <div class="small-circle">
                <img src="img\search.png" alt="Back arrow">
            </div>
        </nav>

        <!-- Home page body -->
        <!-- <div class="container"> -->
        <!-- Scrolling tabs for filtering the data -->
        <div class="tab-container">
            <div class="tabs" id="tabs">
                <button class="tab active" data-tab="all">All</button>
                <button class="tab" data-tab="approved">Approved</button>
                <button class="tab" data-tab="disapproved">Disapproved</button>
                <button class="tab" data-tab="action"><a style="text-decoration: none;" href="Action_Required.php">Action Required</a></button>
                <button class="tab" data-tab="updated">Updated</button>
            </div>
        </div>
        <script src="JavaScript\dragtabs.js"></script>
        <!-- Project Overview Container -->
        <?php
        if ($result  && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Access individual fields by column name
                $pid = $row["Project_ID"];
                $title = $row["Title"];
                $cost = $row["Cost"];
                $Status = $row["Status"];
                $estimated_completion = $row["Estimated_Completion"];
                $startedDate = $row["Started_Date"];
                $Organization_Name  = $row['Organization_Name'];
                $employee_id  = $row['Employee_id'];
                $query1 = "SELECT * FROM employee where Employee_id=" . $employee_id;
                $result1 = $conn->query($query1);
                $row1 = $result1->fetch_assoc();
                $projectUsername = $row1['Employee_Name'];

        ?>
                <a href="Details.php?pid=<?php echo $pid ?>">
                    <div class="wrapper">
                        <div class="container-row">
                            <div class="small-logo">
                                <img src="images/dcslogo.png" alt="dsc_logo" class="container-img">
                            </div>
                            <div class="clientname" style="margin-bottom: 10px;">
                                <p class="container-subhead"> <?php echo $projectUsername ?></p>
                            </div>
                        </div>
                        <div class="track">
                            <h3>
                                <p class="container-subhead">
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
                                    <p class="container-body">Estimated completion -</p>
                                </h3>
                                <h3>
                                    <p class="container-body"> <?php echo $estimated_completion ?></p>
                                </h3>
                            </div>
                            <div class="container-row space">

                                <h3>
                                    <p class="container-body">Cost -</p>
                                </h3>
                                <h3>
                                    <p class="container-body"> <?php echo " $cost ₹" ?></p>
                                </h3>
                            </div>

                        </div>
                    </div>
            <?php
            }
        }
            ?>
                </a>


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