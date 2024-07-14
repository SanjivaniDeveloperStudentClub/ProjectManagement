<?php
require "./db_connection.php";

// Use prepared statements to prevent SQL injection
$useremail = $_COOKIE['useremail'] ?? null;
if (!$useremail) {
    die("User email is not set in the cookie.");
}

$stmt1 = $conn->prepare("SELECT * FROM Employee WHERE Email = ?");
if (!$stmt1) {
    die("Error preparing statement: " . $conn->error);
}
$stmt1->bind_param("s", $useremail);
$stmt1->execute();
$result1 = $stmt1->get_result();
if ($result1->num_rows === 0) {
    die("No employee found with the given email.");
}
$row1 = $result1->fetch_assoc();
$Organization_Name = $row1['Organization_Name'];
$AdminLevel = $row1['AdminLevel'];

$stmt2 = $conn->prepare("SELECT * FROM Project WHERE Status = 'pending' AND Organization_Name = ?");
if (!$stmt2) {
    die("Error preparing statement: " . $conn->error);
}
$stmt2->bind_param("s", $Organization_Name);
$stmt2->execute();
$result2 = $stmt2->get_result();

$stmt3 = $conn->prepare("SELECT * FROM Organization WHERE Organization_Name = ?");
if (!$stmt3) {
    die("Error preparing statement: " . $conn->error);
}
$stmt3->bind_param("s", $Organization_Name);
$stmt3->execute();
$result3 = $stmt3->get_result();
if ($result3->num_rows === 0) {
    die("No organization found with the given name.");
}
$row3 = $result3->fetch_assoc();
$Approval_status = $row3['Access_Level'];

function sanitize_output($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
    <link rel="stylesheet" href="Styles/All.css" />
    <link rel="stylesheet" href="Styles/Typography.css" />
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
                <img src="img/search.png" alt="Search">
            </div>
        </nav>

        <!-- Home page body -->
        <?php if ($result2->num_rows > 0): ?>
            <?php while ($row2 = $result2->fetch_assoc()): ?>
                <?php
                $pid = sanitize_output($row2["Project_ID"]);
                $title = sanitize_output($row2["Title"]);
                $cost = sanitize_output($row2["Cost"]);
                $Status = sanitize_output($row2["Status"]);
                $estimated_completion = sanitize_output($row2["Estimated_Completion"]);
                $startedDate = sanitize_output($row2["Started_Date"]);
                $Organization_Name = sanitize_output($row2["Organization_Name"]);
                $ss = $row2["Approval_status"];
                $Approval_status = unserialize($ss);
                $lastApprovalIndex = count($Approval_status) - 1;

                while ($lastApprovalIndex >= 0 && $Approval_status[$lastApprovalIndex] == "Normal") {
                    $lastApprovalIndex--;
                }

                if ($Approval_status[$lastApprovalIndex] == $AdminLevel):
                ?>
                    <a href="Details.php?pid=<?= $pid ?>">
                        <div class="wrapper">
                            <div class="container-row">
                                <div class="small-logo">
                                    <img src="images/dcslogo.png" alt="dsc_logo" class="container-img">
                                </div>
                                <div class="clientname" style="margin-bottom: 10px;">
                                    <p class="container-subhead"><?= $Organization_Name ?></p>
                                </div>
                            </div>
                            <div class="track">
                                <h3><p style="overflow: hidden;" class="container-subhead"><?= $title ?></p></h3>
                            </div>
                            <div class="track">
                                <div class="container-row space">
                                    <h3><p class="container-body">Status -</p></h3>
                                    <h3><p class="container-body"><?= $Status ?></p></h3>
                                </div>
                                <div class="container-row space">
                                    <h3><p class="container-body">Started on -</p></h3>
                                    <h3><p class="container-body"><?= $startedDate ?></p></h3>
                                </div>
                                <div class="container-row space">
                                    <h3><p class="container-body">Estimated completion -</p></h3>
                                    <h3><p class="container-body"><?= $estimated_completion ?></p></h3>
                                </div>
                                <div class="container-row space">
                                    <h3><p class="container-body">Cost -</p></h3>
                                    <h3><p class="container-body"><?= $cost ?> ₹</p></h3>
                                </div>
                                <a href="./Accept_Project_Request.php?pid=<?= $pid ?>">Accept</a>
                                <a href="./Reject_Project_Request.php?pid=<?= $pid ?>">Reject</a>
                            </div>
                        </div>
                    </a>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No pending projects found.</p>
        <?php endif; ?>

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
</body>

</html>
