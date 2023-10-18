<?php
require_once "db_connection.php"; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $name = $_POST["name"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Perform input validation here if needed

    // Check if the email already exists
    $check_query = "SELECT Employee_id FROM Employee WHERE Email = '$email'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo "Email already exists. Please use a different email.";
    } else {
        // Check if the passwords match
        if ($password === $confirm_password) {
            // Passwords match; you can proceed with database insertion

            // Define the SQL query to insert data
            $sql = "INSERT INTO Employee (Email, Contact_Number,Employee_Name, Password, Organization_Name) VALUES ('$email', $contact, '$name','$password', 'Your Organization')";

            // Execute the query
            if ($conn->query($sql) === true) {
                setcookie("useremail",$email);
                echo "Registration successful!";
                setcookie('Employee_name',$name);

                header("Location:organization.php");
            } else {
                echo "Fill all fileds properly";
            }
        } else {
            // Passwords do not match; display an error message
            echo "Passwords do not match. Please try again.";
        }
    }
}

// Close the database connection (optional)
$conn->close();
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="Styles/All.css">
    <link rel="stylesheet" href="Styles/Typography.css">
</head>

<body>
    <!-- DSC LOGO -->
    <div class="logobox">
        <div class="logo">
            <img src="images/dcslogo.png" alt="Developer Student Club Logo" class="logo-width">
        </div>
    </div>

    <!-- Registration Container -->
    <div class="container">
        <div class="wrapper">
            <div class="container-large-head">
                <span>Register</span>
            </div>

            <form action="register.php" method="post">
                <!-- Name -->
                <label for="name" class="container-subhead">Full name</label>
                <input type="text" placeholder="Enter your full name" id="name" name="name">

                <!-- Email -->
                <label for="email" class="container-subhead">Email</label>
                <input type="text" placeholder="Enter your email id" id="email" name="email">

                <!-- Phone no -->
                <label for="contact" class="container-subhead">Contact</label>
                <input type="tel" placeholder="Enter your phone number" id="contact" name="contact">

                <!-- Password -->
                <label for "password" class="container-subhead">Password</label>
                <input type="password" placeholder="Enter password" id="password" name="password">

                <!-- Confirm password -->
                <label for="confirm_password" class="container-subhead">Confirm password</label>
                <input type="password" placeholder="Confirm password" id="confirm_password" name="confirm_password">

                <!-- Submit button -->
                <div class="row button">
                    <input type="submit" value="Sign up" style="margin-top: 20px;">
                </div>

                <!-- Signup -->
                <div class="container-label">Already have an account? <a href="index.php">Login to an existing account</a></div>
            </form>
        </div>
    </div>
</body>

</html>
