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
        <div class="container">

            <!-- Project and Staff tab -->
            <div class="top_btn">
                <button class="inactive_btn" id="btn1" onclick="window.location.href='home.php'">Project</button>
                <button class="active_btn" id="btn2" onclick="window.location.href=''">Staff</button>
            </div>

            <!-- ------------ Branch ----------- -->
            <label for="Org-email" class="container-subhead">Branch</label>

            <!-- Branch dropdown Container -->
            <div class="custom-dropdown" id="branch">
                <div class="input-bg">
                    <input type="text" class="dropdown-input container-subhead" style="margin-bottom: 0px;" placeholder="Select a branch" readonly>
                </div>
                <div class="dropdown-content">
                    <div class="dropdown-option container-body">Option 1</div>
                    <div class="dropdown-option container-body">Option 2</div>
                    <div class="dropdown-option container-body">Option 3</div>
                </div>
            </div>

            <!-- ------------ Branch ------------- -->



            <!-- ------------ Department ----------- -->
            <label for="Org-email" class="container-subhead">Department</label>

            <!-- Branch dropdown Container -->
            <div class="custom-dropdown" id="department">
                <div class="input-bg">
                    <input type="text" class="dropdown-input container-subhead"  style="margin-bottom: 0px;" placeholder="Select a department"
                        readonly>
                </div>
                <div class="dropdown-content">
                    <div class="dropdown-option container-body">Option 1</div>
                    <div class="dropdown-option container-body">Option 2</div>
                    <div class="dropdown-option container-body">Option 3</div>
                </div>
            </div>

            <!-- ------------ Department ------------- -->

            <script src="JavaScript\dropdown.js"></script>


            <!-- -------------- Staffs ----------- -->
            <!-- Staff Overview Container -->
            <div class="wrapper">
                <div class="container-row">
                    <div class="small-logo">
                        <img src="images/Mirikar-sir.png" alt="dsc_logo" class="container-img">
                    </div>
                    <div class="clientname">
                        <p class="container-head">Mr. A. R. Mirikar</p>
                    </div>
                </div>
                <div class="track">
                    <h3>
                        <p class="container-subhead">Principal, Polytechnic</p>
                    </h3>
                </div>
            </div>




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