<?php
require_once "db_connection.php"; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["username"];
    $password = $_POST["password"];
try{

  // Prepare and execute a query to check if the user exists
  $query = "SELECT * FROM Employee WHERE Email = '$email' AND Password = '$password'";
  $result = $conn->query($query);
  $username;
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      // Access individual fields by column name
      $username = $row["Employee_Name"];
  // echo $column1Value;
  }
}
  
  if ($result->num_rows == 1) {
    // Login successful
    setcookie('useremail',$email);

    header("Location: home.php"); // Redirect to the home page
  } else {
    // Login failed
    echo "Invalid email or password. Please try again.";
  }
}catch(error){
  echo "error";
}
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="Styles/All.css">
    <link rel="stylesheet" href="Styles/Typography.css">
</head>

<body>
    <div class="container">
    <div class="logobox">
        <div class="logo">
            <img src="images/dcslogo.png" alt="Developer Student Club Logo" class="logo-width">
        </div>
    </div>

        <div class="wrapper">
            <div class="container-large-head">
                <span>Login</span>
            </div>

            <form method="post" action="index.php">
                <label for="username" class="container-subhead">Email</label>
                <input type="text" placeholder="Enter Email" name="username" class="custom-textfield">

                <label for="password" class="container-subhead">Password</label>
                <input type="password" placeholder="Enter Password" name="password" class="custom-textfield">

                <div class="container-label">Forget Password? <a href="ForgotPass.php">Reset Password</a></div>

                <div class="row button">
                    <input type="submit" value="Login">
                </div>

                <div class="container-label">Don't have an account? <a href="Register.php">Create new account</a></div>
            </form>
        </div>
    </div>
</body>

</html>
