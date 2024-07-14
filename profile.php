<?php
require './authchecker.php';
require "./db_connection.php";

$useremail = $_COOKIE['useremail'];
if (!$useremail) {
    header("Location: index.php");
    exit();
}

// Fetch organization details
$check_query = "SELECT * FROM Organization WHERE Email = ?";
$stmt = $conn->prepare($check_query);
$stmt->bind_param("s", $useremail);
$stmt->execute();
$result = $stmt->get_result();

// Fetch employee details
$check_query2 = "SELECT * FROM Employee WHERE Email = ?";
$stmt2 = $conn->prepare($check_query2);
$stmt2->bind_param("s", $useremail);
$stmt2->execute();
$result2 = $stmt2->get_result();

$orgName = "";
$Access = "";
$userrow = [];
$AdminLevel = "Normal"; // Default to normal if not set

if ($result2->num_rows > 0) {
    $userrow = $result2->fetch_assoc();
    $orgName = $userrow["Organization_Name"];
    $AdminLevel = $userrow["AdminLevel"];

    if ($orgName != "Your Organization") {
        $check_query2 = "SELECT * FROM $orgName WHERE Employee_Email = ?";
        $stmt3 = $conn->prepare($check_query2);
        $stmt3->bind_param("s", $useremail);
        $stmt3->execute();
        $result3 = $stmt3->get_result();

        if ($result3->num_rows > 0) {
            $row = $result3->fetch_assoc();
            $Access = $row["Access"];
        } else {
            $orgName = "";
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
    <link rel="stylesheet" href="Styles/All.css">
    <link rel="stylesheet" href="Styles/Typography.css">
    <title>Profile</title>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="top">
        <div class="large-head">
            <div name="title">Project</div>
        </div>
        <div class="small-circle">
            <img src="img/search.png" alt="Search icon">
        </div>
    </nav>

    <!-- Profile Overview Container -->
    <div class="container">
        <div class="logobox">
            <div class="medium-logo">
                <img src="<?php echo isset($userrow["Profile_img"]) ? $userrow["Profile_img"] : './images/default-img.jpg'; ?>" alt="Profile Image" class="logo-width">
            </div>
        </div>

        <!-- User Name -->
        <div class="clientname">
            <p class="container-head"><?php echo htmlspecialchars($userrow['Employee_Name']); ?></p>
        </div>

        <!-- Organization Name -->
        <div class="clientname">
            <p class="container-head"><?php echo htmlspecialchars($orgName); ?></p>
        </div>

        <!-- Edit Profile Button -->
        <a href="EditProfile.php">
            <div class="container">
                <input type="button" value="Edit Profile" class="edit-button">
            </div>
        </a>

        <!-- Admin Section -->
        <?php if ($result->num_rows > 0 || $AdminLevel != "Normal") { ?>
            <div class="container container-large-head">
                <span style="text-align: left;">Admin</span>
            </div>

            <div class="container">
                <a href="dashboard.php">
                    <div class="wrapper">
                        <div class="container-row">
                            <div class="small-logo">
                                <img src="img/admin-panel.png" alt="Admin logo" style="width: 30px;">
                            </div>
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
                                <img src="img/admin-panel.png" alt="Admin logo" style="width: 30px;">
                            </div>
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
                                <img src="img/admin-panel.png" alt="Admin logo" style="width: 30px;">
                            </div>
                            <div class="container-text">
                                <p class="container-head">Project Management</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>

        <!-- Others Section -->
        <div class="container container-large-head">
            <span style="text-align: left;">Others</span>
        </div>

        <div class="container">
            <a href="Help_Support.php">
                <div class="wrapper">
                    <div class="container-row">
                        <div class="small-logo">
                            <img src="images/help and support.svg" alt="Help and Support" style="width: 30px;">
                        </div>
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
                            <img src="images/About us.svg" alt="About us" style="width: 30px;">
                        </div>
                        <div class="container-text">
                            <p class="container-head">About us</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Logout Button -->
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
    </div>
</body>

</html>