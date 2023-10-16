<?php
require "./PHPMailerFile/Exception.php";
require "./PHPMailerFile/SMTP.php";
require "./PHPMailerFile/PHPMailer.php";
require "./db_connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$otp = generateOTP(); // Generate a random OTP
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    if (isset($_POST["getOTP"])) {
        // Handle Get OTP button click
        $check_query = "SELECT Employee_id FROM Employee WHERE Email = '$email'";
        $result = $conn->query($check_query);
        
        if (!($result->num_rows > 0)) {
            echo "Email does not exists. Please use a different email.";
        }
        else{
            
            $mail= new PHPMailer(true);
            // $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->SMTPAuth =true;
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port=587;
            $mail->SMTPSecure = 'tls';
            $mail->Username="pmanagement591@gmail.com";
            $mail->Password="tdqelvwbtycmdjyb";
            // $mail->SMTPOptions = array(
            //     'ssl' => array(
                //         'verify_peer' => false,
            //         'verify_peer_name' => false,
            //         'allow_self_signed' => true
            //     )
            // );
            
            $mail->setFrom("pmanagement591@gmail.com","project management");
            $mail->addAddress($email);
            $mail->Subject="Forget password";
            $mail->Body=$otp;
            $mail->send();
            // Send OTP to the provided email
            setcookie('otp', $otp, time() + 3600, '/');
            setcookie('useremail', $email);
            echo "email send successfully";
        }    
    } elseif (isset($_POST["resetPassword"])) {
        $userotp = $_POST["userotp"];
        if (isset($_COOKIE['otp'])) {
            $otps = $_COOKIE['otp'];
            
    if($otps==$userotp){
        echo "correct otp";
        setcookie('passwordupdatestate', true);
        echo $_COOKIE["passwordupdatestate"];
        header("Location: updatePassword.php"); // Redirect to the home page
    }  
    else{
        echo "incoorect otp";
    }
}
} else {
    echo "otp exppire.";

    }
}

// Function to generate a random 6-digit OTP
function generateOTP() {

    return rand(100000, 999999);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="Styles\All.css" />
    <link rel="stylesheet" href="Styles\Typography.css" />
    <style>
        /* CSS constants */
        :root {

            /* Accent color */
            --accent: #068FFF;

            /* Constants for box shadow */
            --box-shadow: -4px 8px 10px -5px rgba(0, 0, 0, 0.20);
        }
    </style>
</head>

<body>
    <!-- DSC LOGO -->
    <div class="logobox">
        <div class="logo">
            <img src="images/dcslogo.png" alt="Developer Student Club Logo" class="logo-width">
        </div>
    </div>

    <!-- Login Container -->
    <div class="container">
        <div class="wrapper">
            <div class="container-large-head">
                <span>Reset Password</span>
            </div>

            <form action="ForgotPass.php" method="post">
                <!-- Email -->
                <label for="email" class="container-subhead">Email</label>
                <input type="text" placeholder="Enter your email id" id="email" name="email">

                <!-- OTP -->
                <label for="OTP" class="container-subhead">OTP</label>

                <div class="container-row">
                    <input type="tel" name="userotp" placeholder="Enter OTP sent on your email" maxlength="6" id="OTP">
                    <input type="submit" onclick="notrefresh(event)" name="getOTP" value="Get OTP" style="width: 30; background-color: var(--accent); color: var(--body-background);">
                </div>

                <!-- Submit button -->
                <div class="row button">
                    <input type="submit"  name="resetPassword" value="Reset Password" style="margin-top: 20px;">
                </div>

                <!-- Signup -->
                <div class="container-label">Remember your password? <a href="index.php">Login existing account</a></div>
            </form>
        </div>
    </div>
</body>
<script>
    function notrefresh(e){
    }
    </script>
</html>
