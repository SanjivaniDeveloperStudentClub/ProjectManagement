<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/All.css" />
    <link rel="stylesheet" href="Styles/Typography.css" />
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
</head>

<body>
    <div class="container">
        <form action="./php/profile_insert_data.php" method="post">
            <nav class="top">
                <a href="profile.php">
                    <div class="small-circle" style="margin-right: 20px;">
                        <img src="img/Back.png" alt="Back arrow">
                    </div>
                </a>
                <div class="large-head">
                    <div name="title">Edit</div>
                </div>
            </nav>

            <div class="container">
                <div class="logobox">
                    <div class="medium-logo">
                        <img src="images/dcslogo.png" alt="Developer Student Club Logo" class="logo-width">
                    </div>
                </div>
                <div class="clientname">
                    <p class="container-subhead" style="text-align: center; color: var(--accent);">Change</p>
                </div>
            </div>
            <br>

            <label class="container-medhead" style="text-align: left;">Personal - </label>

            <label class="container-subhead">Full Name - </label>
            <input type="text" name="full_name" placeholder="Enter your full name" class="custom-textfield">

            <!-- Branch Dropdown -->
            <label class="container-subhead">Branch</label>
            <select name="branch" class="custom-dropdown" id="branch">
                <option value="Option 1">Option 1</option>
                <option value="Option 2">Option 2</option>
                <option value="Option 3">Option 3</option>
            </select>

            <!-- Department Dropdown -->
            <label class="container-subhead">Department</label>
            <select name="department" class="custom-dropdown" id="department">
                <option value="Option 1">Option 1</option>
                <option value="Option 2">Option 2</option>
                <option value="Option 3">Option 3</option>
            </select>

            <!-- Designation Dropdown -->
            <label class="container-subhead">Designation</label>
            <select name="designation" class="custom-dropdown" id="designation">
                <option value="Option 1">Option 1</option>
                <option value="Option 2">Option 2</option>
                <option value="Option 3">Option 3</option>
            </select>


            <label class="container-medhead" style="text-align: left;">Contact - </label>

            <label class="container-subhead">Mobile - </label>
            <input type="text" name="mobile" placeholder="Enter your mobile number" class="custom-textfield">

            <label class="container-subhead">Telephone - </label>
            <input type="text" name="telephone" placeholder="Enter your telephone number" class="custom-textfield">

            <label class="container-subhead">Email - </label>
            <input type="text" name="email" placeholder="Enter your email id" class="custom-textfield">

            <br>
            <br>

            <div class="logout" style="margin-bottom: 30px;">
                <input type="submit" name="submit" value="Submit" class="safe-button container-medhead" style="text-align: center; justify-content: center; color: var(--body-background);">
            </div>
        </form>
    </div>
</body>

</html>
