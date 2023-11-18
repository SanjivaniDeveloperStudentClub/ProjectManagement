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

//org details
$sql = "SELECT * FROM Organization Where Organization_Name = '$OrgName'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$Branch = $row['Branch'];
$Branch = unserialize($Branch);
$posts = $row['Posts'];
$posts = unserialize($posts);
$Departments = $row['Department'];
$Departments = unserialize($Departments);
// echo $result->num_ro
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
        <form action="./php/profile_insert_data.php" method="post">
            <nav class="top">
                <a href="profile.php">
                    <div class="small-circle" style="margin-right: 20px;">
                        <img src="img/Back.png" alt="Back arrow">
                    </div>
                </a>
                <div class="large-head">
                    <div name="title">Edit</div>
                    <!-- </div> -->
                </div>
            </nav>

            <div class="container">
                <div class="logobox">
                    <div class="medium-logo">
                        <?php
                        if ($Profile_img == null) {

                            echo ' <img src="images/dcslogo.png" id="pic-img" alt="Developer Student Club Logo" class="logo-width">';
                        } else {
                            echo ' <img src="' . $Profile_img . '" id="pic-img" alt="Developer Student Club Logo" class="logo-width">';
                        }
                        ?>
                    </div>
                </div>
                <div class="clientname" style="display:flex; justify-content:center;">
                    <label onselect="uploadImage()" for="pic">Change</label>
                    <input onchange="uploadImage()" accept="image/jpeg,image/png,image/jpg" style="display:none;" id="pic" name="pic" type="file" class="container-subhead" style="text-align: center; color: var(--accent);">
                </div>
            </div>
            <input id="picimg" style="display: none;" value="om" name="picimg" type="text">
            <br>

            <label class="container-medhead" style="text-align: left;">Personal - </label>

            <label class="container-subhead">Full Name - </label>
            <?php echo '<input type="text" value="' . $Full_Name . '" name="full_name" placeholder="Enter your full name" class="custom-textfield">';
            ?>

            <!-- Branch Dropdown -->
            <label class="container-subhead">Branch</label>
            <select name="branch" class="custom-dropdown" id="branch">
                <?php
                if ($result->num_rows) {
                    for ($i = 0; $i < count($Branch); $i++) {
                        if ($Branch[$i] == $branch) {

                            echo '<option selected value="' . $Branch[$i] . '">' . $Branch[$i] . '</option>';
                        } else {

                            echo '<option value="' . $Branch[$i] . '">' . $Branch[$i] . '</option>';
                        }
                    }
                }
                ?>

            </select>

            <!-- Department Dropdown -->
            <label class="container-subhead">Department</label>
            <select name="department" class="custom-dropdown" id="department">
                <?php
                if ($result->num_rows) {
                    for ($i = 0; $i < count($Departments); $i++) {
                        if ($Departments[$i] == $dep) {

                            echo '<option selected value="' . $Departments[$i] . '">' . $Departments[$i] . '</option>';
                        } else {

                            echo '<option value="' . $Departments[$i] . '">' . $Departments[$i] . '</option>';
                        }
                    }
                }
                ?>

            </select>

            <!-- Designation Dropdown -->
            <label class="container-subhead">Post</label>
            <select name="designation" class="custom-dropdown" id="designation">
                <?php
                if ($result->num_rows) {
                    for ($i = 0; $i < count($posts); $i++) {
                        if ($posts[$i] == $post1) {

                            echo '<option selected value="' . $posts[$i] . '">' . $posts[$i] . '</option>';
                        } else {
                            echo '<option value="' . $posts[$i] . '">' . $posts[$i] . '</option>';
                        }
                    }
                }
                ?>
            </select>


            <label class="container-medhead" style="text-align: left;">Contact - </label>

            <label class="container-subhead">Mobile - </label>
            <?php echo ' <input type="text" value="' . $Contact . '" name="mobile" placeholder="Enter your mobile number" class="custom-textfield">';
            ?>

            <label class="container-subhead">Telephone - </label>
            <?php echo '<input value="' . $Telephone . '" type="text" name="telephone" placeholder="Enter your telephone number" class="custom-textfield">';
            ?>
            <label class="container-subhead">Email - </label>
            <?php
            echo '<input value="' . $Email . '" type="text" name="email" placeholder="Enter your email id" class="custom-textfield">';
            ?>

            <br>
            <br>

            <div class="logout" style="margin-bottom: 30px;">
                <input type="submit" name="submit" value="Submit" class="safe-button container-medhead" style="text-align: center; justify-content: center; color: var(--body-background);">
            </div>
        </form>
    </div>
</body>
<script>
    async function uploadImage() {
        console.log("error");
        let uploadurl = null;
        const pic_img = document.getElementById('pic-img');
        const fileInput = document.getElementById('pic');
        const file = fileInput.files[0];
        const data = new FormData();
        data.append("file", file);
        data.append("upload_preset", "projectmanagement");
        data.append("cloud_name", "dq0ngkijj");

        await fetch("https://api.cloudinary.com/v1_1/dq0ngkijj/image/upload", {
            method: "POST",
            body: data
        }).then((res) => res.json()).then((data) => uploadurl = data.url).catch((error) => console.log(error));

        if (file) {
            if (window.URL) {
                const imageUrl = URL.createObjectURL(file);
                pic_img.src = uploadurl;
                picimg.value = uploadurl;
                console.log(imageUrl);
            } else {
                console.error('createObjectURL is not supported in this browser');
            }
        } else {
            console.error('No file selected.');
        }
    }

    let image = ""
    const data = new FormData();
    data.append("file", image);
    data.append("upload_preset", "projectmanagement");
    data.append("cloud_name", "dq0ngkijj");

    fetch("https://api.cloudinary.com/v1_1/dq0ngkijj/image/upload", {
        method: "POST",
        body: data
    }).then((res) => res.json()).then((data) => console.log(data)).catch((error) => console.log(error));
    // 289535213843854:ZDqnmrM46TEOZLxal5qrux-_0Mc@dq0ngkijj")
</script>

</html>