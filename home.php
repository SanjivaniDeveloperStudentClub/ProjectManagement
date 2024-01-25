<?php
require './db_connection.php';
require './authchecker.php';
require "./php/currentuser_details.php";

$userdetail = currentuserdetails();
$proresult = null;
if ($userdetail) {
    $employeeId = $userdetail["Employee_id"];

    $orgcheck = "SELECT * FROM Organization WHERE Employee_id = ?";
    $stmt = $conn->prepare($orgcheck);

    if ($stmt) { // Check if the prepare method succeeded
        $stmt->bind_param("i", $employeeId);
        $stmt->execute();
        $orgResult = $stmt->get_result();

        if ($orgResult->num_rows > 0) {
            $orgrow = $orgResult->fetch_assoc();
            $organizationName = $orgrow["Organization_Name"];
            $query = "SELECT * FROM Project Where Organization_Name='$organizationName'";
            $proresult = $conn->query($query);
        } else {
            $OrgName =  $userdetail["Organization_Name"];
            $query = "SELECT * FROM Project WHERE Organization_Name = '$OrgName'";
            $proresult = $conn->query($query);
        }
    } else {
        echo "Error preparing the organization query: " . $conn->error;
    }
} else {
    echo "Error: User details not found.";
}
// print_r();
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

    <title>Home</title>
</head>
<style>
    .container-subhead {
        overflow: hidden;
    }

    .milestone-container-dot {
        min-width: 3vh;
        max-width: 3vh;
        height: 3vh;
        border-radius: 50%;
    }

    .milestone-due {
        background: red;
        /* background-color: green; */
    }

    .milestone-complete {
        background: green;
    }

    .milestone-ongoing {
        background: burlywood;
    }

    .milestone-coming {
        background: yellow;
    }
</style>

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
    </div>

    <!-- Home page body -->
    <div class="container">

        <!-- Project and Staff tab -->
        <div class="top_btn">
            <button class="active_btn" id="btn1" onclick="window.location.href='home.php'">Project</button>
            <button class="inactive_btn" id="btn2" onclick="window.location.href='Staff.php'">Staff</button>
        </div>
        <div class="scroll">
            <!-- Project Overview Container -->
            <?php
            try {
                if ($proresult && $proresult->num_rows > 0) {
                    while ($row = $proresult->fetch_assoc()) {
                        // Access individual fields by column name
                        $pid = $row["Project_ID"];
                        $title = $row["Title"];
                        $cost = $row["Cost"];
                        $Status = $row["Status"];
                        $estimated_completion = $row["Estimated_Completion"];
                        $startedDate = $row["Started_Date"];
                        $Organization_Name = $row['Organization_Name'];
            ?>
                        <a href="Details.php?pid=<?php echo $pid ?>">
                            <div class="wrapper">
                                <div class="container-row">
                                    <div class="small-logo">
                                        <img src="images/dcslogo.png" alt="dsc_logo" class="container-img">
                                    </div>
                                    <div class="clientname" style="margin-bottom: 10px;">
                                        <p class="container-subhead">
                                            <?php echo $Organization_Name ?>
                                        </p>
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
                                            <p class="container-body">
                                                <?php echo $Status ?>
                                            </p>
                                        </h3>
                                    </div>
                                    <div class="container-row space">

                                        <h3>
                                            <p class="container-body">Started on -</p>
                                        </h3>
                                        <h3>
                                            <p class="container-body">
                                                <?php echo $startedDate ?>
                                            </p>
                                        </h3>
                                    </div>
                                    <div class="container-row space">

                                        <h3>
                                            <p class="container-body">Estimated completion -</p>
                                        </h3>
                                        <h3>
                                            <p class="container-body">
                                                <?php echo $estimated_completion ?>
                                            </p>
                                        </h3>
                                    </div>
                                    <div class="container-row space">

                                        <h3>
                                            <p class="container-body">Cost -</p>
                                        </h3>
                                        <h3>
                                            <p class="container-body">
                                                <?php echo " $cost ₹" ?>
                                            </p>
                                        </h3>
                                    </div>
                                    <div class="milestone-container">
                                        <?php
                                        $serializedDataFromDatabase = $row['Milestones'];
                                        $serializedDataFromDatabase_status = $row['Milestones_status'];
                                        $serializedDataFromDatabase_dates = $row['Milestones_dates'];
                                        $milestones = unserialize($serializedDataFromDatabase);
                                        $milestones_status = unserialize($serializedDataFromDatabase_status);
                                        $milestones_dates = unserialize($serializedDataFromDatabase_dates);
                                        $currentDate = date("Y-m-d");

                                        for ($ind = 0; $ind < count($milestones); $ind++) {
                                            $date1 = strtotime($currentDate);
                                            $date2 = strtotime($milestones_dates[$ind]);
                                            // echo $milestones_dates[$ind];
                                            // echo $date2;
                                            if (($date1 > $date2) && $milestones_status[$ind] != "complete") {
                                                $milestones_status[$ind] = "due";
                                                echo '<div class="milestone-container-dot milestone-due"></div>';
                                            } elseif ($milestones_status[$ind] == "complete") {
                                                echo '<div class="milestone-container-dot milestone-complete"></div>';
                                            } elseif ($milestones_status[$ind] == "ongoing") {
                                                echo '<div class="milestone-container-dot milestone-ongoing"></div>';
                                            } else {
                                                echo '<div class="milestone-container-dot milestone-coming"></div>';
                                            }
                                            if ($ind < count($milestones) - 1) {
                                                echo '<div class="milestone-container-line"></div>';
                                            }
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                <?php
                    }
                }
            } catch (Exception $e) {
                // Code to handle the exception
                echo "An exception occurred: " . $e->getMessage();
            }

                ?>
                        </a>
        </div>
    </div>
    <a href="Submission_form.php">
        <div class="container">
            <button id="fab" class="fab">+</button>
        </div>
    </a>

    <!-- Bottom Navigation Bar -->
    <div class="bnav-wrapper">
        <div class="bnav">
            <a href="">Home</a>
            <a href="Logs.php"><img src="images/Logs.svg" alt="Logs"></a>
            <a href="Notification.php"><img src="images/Notification.svg" alt="Notifications"></a>
            <a href="Profile.php"><img src="images/Profile.svg" alt="Profile"></a>
        </div>
    </div>



    </div>
    </div>


</body>

</html>