<?php
require "./db_connection.php";
require "./authchecker.php";
require "./php/currentuser_details.php";

$sql_1 = null;
$userdetail = currentuserdetails();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['dep']) && isset($_POST['bar'])) {
        $dep = $_POST['dep'];
        $bar = $_POST['bar'];
        $sql_1 = "SELECT * FROM Employee Where Organization_Name = 'testom' AND Branch = '$bar' AND Department= '$dep'";
    } else if (isset($_POST['dep'])) {
        $dep = $_POST['dep'];
        $sql_1 = "SELECT * FROM Employee Where Organization_Name = 'testom' AND Department= '$dep'";
    } else if (isset($_POST['bar'])) {
        $bar = $_POST['bar'];
        $sql_1 = "SELECT * FROM Employee Where Organization_Name = 'testom' AND Branch = '$bar'";
    } else {
        $sql_1 = null;
    }
}
$OrgName = $userdetail['Organization_Name'];
$sql = "SELECT * FROM Organization Where Organization_Name = '$OrgName'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$Branch = $row['Branch'];
$Branch = unserialize($Branch);
$posts = $row['Posts'];
$posts = unserialize($posts);
$Departments = $row['Department'];
$Departments = unserialize($Departments);
if ($sql_1 == null) {
    $sql_1 = "SELECT * FROM Employee Where Organization_Name = 'testom'";
}
$result_1 = $conn->query($sql_1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dep = $_POST['dep'];
    $bar = $_POST['bar'];
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

    <title>Staff</title>

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
        <form id="myform" action="./Staff.php" method="post" class="container">

            <!-- Project and Staff tab -->
            <div class="top_btn">
                <a style="display: flex; align-item:center; justify-content:center;" class="inactive_btn" id="btn1" href='home.php'>Project</a>
                <button class="active_btn" id="btn2" onclick="window.location.href=''">Staff</button>
            </div>

            <!-- ------------ Branch ----------- -->
            <label for="Org-email" class="container-subhead">Branch</label>

            <!-- Branch dropdown Container -->

            <select onchange="submitform()" name="bar">
                <?php
                for ($i = 0; $i < count($Branch); $i++) {
                    if ($bar == $Branch[$i]) {
                        echo '<option selected class="dropdown-option container-body" value="' . $Branch[$i] . '">' . $Branch[$i] . '</option>';
                    } else {

                        echo '<option class="dropdown-option container-body" value="' . $Branch[$i] . '">' . $Branch[$i] . '</option>';
                    }
                }
                ?>
            </select>

            <!-- ------------ Branch ------------- -->



            <!-- ------------ Department ----------- -->
            <label for="Org-email" class="container-subhead">Department</label>

            <!-- Branch dropdown Container -->
            <select onchange="submitform()" name="dep">
                <?php
                for ($i = 0; $i < count($Departments); $i++) {
                    if ($dep == $Departments[$i]) {
                        echo '<option selected class="dropdown-option container-body" value="' . $Departments[$i] . '">' . $Departments[$i] . '</option>';
                    } else {
                        echo '<option class="dropdown-option container-body" value="' . $Departments[$i] . '">' . $Departments[$i] . '</option>';
                    }
                }
                ?>
            </select>

            <!-- ------------ Department ------------- -->

            <script src="JavaScript\dropdown.js"></script>


            <!-- -------------- Staffs ----------- -->
            <!-- Staff Overview Container -->
            <?php
            if ($result_1 && $result_1->num_rows > 0) {
                while ($row = $result_1->fetch_assoc()) {
                    $Employee_name = $row['Employee_Name'];
                    $Department = $row['Department'];
                    $Branch = $row['Branch'];
                    $Post = $row['Post'];



            ?>
                    <div class="wrapper">
                        <div class="container-row">
                            <div class="small-logo">
                                <img src="images/Mirikar-sir.png" alt="dsc_logo" class="container-img">
                            </div>
                            <div class="clientname">
                                <p class="container-head"><?php echo $Employee_name; ?></p>
                            </div>
                        </div>
                        <div class="track">
                            <h3>
                                <p class="container-subhead"><?php echo $Post; ?>, <?php echo $Department; ?></p>
                            </h3>
                        </div>
                    </div>
            <?php
                }
            }
            ?>



            <!-- Bottom Navigation Bar -->
            <div class="bnav-wrapper">
                <div class="bnav">
                    <a href="">Home</a>
                    <a href="Logs.php"><img src="images/Logs.svg" alt="Logs"></a>
                    <a href="Notification.php"><img src="images/Notification.svg" alt="Notifications"></a>
                    <a href="Profile.php"><img src="images/Profile.svg" alt="Profile"></a>
                </div>
            </div>


        </form>

    </div>
</body>
<script>
    function submitform() {
        myform.submit();

    }
</script>

</html>