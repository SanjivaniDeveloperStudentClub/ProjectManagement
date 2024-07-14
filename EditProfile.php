<?php
require "./db_connection.php";
require "./authchecker.php";
require "./php/currentuser_details.php";

$userdetail = currentuserdetails();
$OrgName = $userdetail['Organization_Name'];
$Profile_img = $userdetail['Profile_img'];
$Email = $userdetail['Email'];
$dep = $userdetail['Department'];
$branch = $userdetail['Branch'];
$post1 = $userdetail['Post'];
$Telephone = $userdetail['Telephone'];
$Contact = $userdetail['Contact_Number'];
$Full_Name = $userdetail['Employee_Name'];

// Fetch organization details using prepared statements
$stmt = $conn->prepare("SELECT * FROM Organization WHERE Organization_Name = ?");
$stmt->bind_param("s", $OrgName);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$Branch = unserialize($row['Branch']);
$posts = unserialize($row['Posts']);
$Departments = unserialize($row['Department']);
?>
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

        select {
            border: 2px solid black;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="./php/profile_insert_data.php" method="post" enctype="multipart/form-data">
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
                        <?php
                        if ($Profile_img) {
                            echo '<img src="' . $Profile_img . '" id="pic-img" alt="Profile Image" class="logo-width">';
                        } else {
                            echo '<img src="./images/default-img.jpg" id="pic-img" alt="Default Image" class="logo-width">';
                        }
                        ?>
                    </div>
                </div>
                <div class="clientname" style="display:flex; justify-content:center;">
                    <label for="pic" class="container-subhead" style="text-align: center; color: var(--accent); cursor: pointer;">Change</label>
                    <input onchange="uploadImage()" accept="image/jpeg,image/png,image/jpg" style="display:none;" id="pic" name="pic" type="file" class="container-subhead">
                </div>
            </div>
            <input id="picimg" style="display: none;" value="" name="picimg" type="text">
            <br>

            <label class="container-medhead" style="text-align: left;">Personal - </label>

            <label class="container-subhead">Full Name - </label>
            <input type="text" value="<?php echo htmlspecialchars($Full_Name); ?>" name="full_name" placeholder="Enter your full name" class="custom-textfield">

            <!-- Branch Dropdown -->
            <label class="container-subhead">Branch</label>
            <select name="branch" class="custom-dropdown" id="branch">
                <?php
                foreach ($Branch as $branchOption) {
                    $selected = ($branchOption == $branch) ? 'selected' : '';
                    echo '<option value="' . htmlspecialchars($branchOption) . '" ' . $selected . '>' . htmlspecialchars($branchOption) . '</option>';
                }
                ?>
            </select>

            <!-- Department Dropdown -->
            <label class="container-subhead">Department</label>
            <select name="department" class="custom-dropdown" id="department">
                <?php
                foreach ($Departments as $departmentOption) {
                    $selected = ($departmentOption == $dep) ? 'selected' : '';
                    echo '<option value="' . htmlspecialchars($departmentOption) . '" ' . $selected . '>' . htmlspecialchars($departmentOption) . '</option>';
                }
                ?>
            </select>

            <!-- Designation Dropdown -->
            <label class="container-subhead">Post</label>
            <select name="designation" class="custom-dropdown" id="designation">
                <?php
                foreach ($posts as $postOption) {
                    $selected = ($postOption == $post1) ? 'selected' : '';
                    echo '<option value="' . htmlspecialchars($postOption) . '" ' . $selected . '>' . htmlspecialchars($postOption) . '</option>';
                }
                ?>
            </select>

            <label class="container-medhead" style="text-align: left;">Contact - </label>

            <label class="container-subhead">Mobile - </label>
            <input type="text" value="<?php echo htmlspecialchars($Contact); ?>" name="mobile" placeholder="Enter your mobile number" class="custom-textfield">

            <label class="container-subhead">Telephone - </label>
            <input type="text" value="<?php echo htmlspecialchars($Telephone); ?>" name="telephone" placeholder="Enter your telephone number" class="custom-textfield">

            <label class="container-subhead">Email - </label>
            <input type="text" value="<?php echo htmlspecialchars($Email); ?>" name="email" placeholder="Enter your email id" class="custom-textfield">

            <br>
            <br>

            <div class="logout" style="margin-bottom: 30px;">
                <input type="submit" name="submit" value="Submit" class="safe-button container-medhead" style="text-align: center; justify-content: center; color: var(--body-background);">
            </div>
        </form>
    </div>

    <script>
        async function uploadImage() {
            const picImg = document.getElementById('pic-img');
            const fileInput = document.getElementById('pic');
            const file = fileInput.files[0];
            const data = new FormData();
            data.append("file", file);
            data.append("upload_preset", "projectmanagement");
            data.append("cloud_name", "dq0ngkijj");

            try {
                const response = await fetch("https://api.cloudinary.com/v1_1/dq0ngkijj/image/upload", {
                    method: "POST",
                    body: data
                });
                const result = await response.json();
                const uploadUrl = result.url;

                if (file) {
                    picImg.src = uploadUrl;
                    document.getElementById('picimg').value = uploadUrl;
                } else {
                    console.error('No file selected.');
                }
            } catch (error) {
                console.error('Error uploading image:', error);
            }
        }
    </script>
</body>

</html>
