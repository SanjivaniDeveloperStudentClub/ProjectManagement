<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="Styles\All.css" />
    <link rel="stylesheet" href="Styles\Typography.css" />

    <title>Edit Profile</title>

    <style>
        /* CSS constants */
        :root {

            /* Accent color */
            --accent: #068FFF;

            
    /* Color const for background */
    --body-background: #F2F2F2;
        }
    </style>

    <script src="JavaScript\dropdown.js"></script>


</head>

<body>
    <div class="container">

        <nav class="top">
            <a href="profile.php">
                <div class="small-circle" style="margin-right: 20px;">
                    <img src="img\Back.png" alt="Back arrow">
                </div>
            </a>
            <div class="large-head">
                <div name="title">Edit</div>
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
                <p class="container-subhead" style="text-align: center; color: var(--accent);">Change</p>
            </div>

        </div>

        <br>

        <label class="container-medhead" style="text-align: left;">Personal - </label>

        <label class="container-subhead">Full Name - </label>
        <input type="text" placeholder="Enter your full name" class="custom-textfield">


        <!-- ------------ Branch ----------- -->
        <label for="Org-email" class="container-subhead">Branch</label>

        <!-- Branch dropdown Container -->
        <div class="custom-dropdown" id="branch">
            <div class="input-bg">
                <input type="text" class="dropdown-input container-subhead" placeholder="Select a branch" readonly>
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
                <input type="text" class="dropdown-input container-subhead" placeholder="Select a department"
                    readonly>
            </div>
            <div class="dropdown-content">
                <div class="dropdown-option container-body">Option 1</div>
                <div class="dropdown-option container-body">Option 2</div>
                <div class="dropdown-option container-body">Option 3</div>
            </div>
        </div>

        <!-- ------------ Department ------------- -->

        <!-- ------------ Designation ----------- -->
        <label for="Org-email" class="container-subhead">Designation</label>

        <!-- Branch dropdown Container -->
        <div class="custom-dropdown" id="designation">
            <div class="input-bg">
                <input type="text" class="dropdown-input container-subhead" placeholder="Select a designation"
                    readonly>
            </div>
            <div class="dropdown-content">
                <div class="dropdown-option container-body">Option 1</div>
                <div class="dropdown-option container-body">Option 2</div>
                <div class="dropdown-option container-body">Option 3</div>
            </div>
        </div>

        <script src="JavaScript\dropdown.js"></script>


        <br>

        <label class="container-medhead" style="text-align: left;">Contact - </label>

        <label class="container-subhead">Mobile - </label>
        <input type="number" placeholder="Enter your mobile number" class="custom-textfield">

        <label class="container-subhead">Telephone - </label>
        <input type="number" placeholder="Enter your telephone number" class="custom-textfield">

        <label class="container-subhead">Email - </label>
        <input type="text" placeholder="Enter your email id" class="custom-textfield">

        <br>
        <br>

        <form action="profile.php">
            <div class="logout" style="margin-bottom: 30px;">
                <input type="submit" value="Submit" class="safe-button container-medhead" style="text-align: center; justify-content: center; color: var(--body-background);">
            </div>
        </form>

</body>

</html>