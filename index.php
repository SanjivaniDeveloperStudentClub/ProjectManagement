<?php
require_once "db_connection.php"; // Include the database connection file
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // echo "om";
  $email = $_POST["username"];
  $password = $_POST["password"];
  // echo $email;
  try {

    // Prepare and execute a query to check if the user exists
    $query = "SELECT * FROM Employee WHERE Email = '$email' AND Password = '$password'";
    $result = $conn->query($query);
    $username;
    $row;
    // echo $result->num_rows;
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        // Access individual fields by column name
        $username = $row["Employee_Name"];
        // echo $column1Value;
        break;
      }
    }
    if ($result && $result->num_rows == 1) {
      // Login successful
      setcookie('useremail', $email);
      // print_r($row);
      if ($row['Organization_Name'] == "Your Organization") {
        header("Location:OrgRequestPage.php"); // Redirect to the home page

      } else {
        // Login failed
        header("Location:home.php"); // Redirect to the home page
      }
    } else {
       // Login failed
       $error_message = "Cant find your account";
       echo '<script>
        function showPopup() {
          var popup = document.createElement("div");
          popup.classList.add("error-box");

          var header = document.createElement("div");
          header.classList.add("header");
          var heading = document.createElement("h1");
          heading.innerText = "Login Failed";
          header.appendChild(heading);

          var body = document.createElement("div");
          body.classList.add("body");
          var paragraph = document.createElement("p");
          paragraph.innerText = "' . $error_message . '";
          body.appendChild(paragraph);

          var footer = document.createElement("div");
          footer.classList.add("footer");
          var button = document.createElement("button");
          button.classList.add("ok-button");
          button.innerText = "OK";
          button.addEventListener("click", function() {
            window.location.href = "index.php";
          });
          footer.appendChild(button);

          popup.appendChild(header);
          popup.appendChild(body);
          popup.appendChild(footer);

          document.body.appendChild(popup);
        }

        window.onload = showPopup;
       </script>';
    }
  } catch (error) {
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
  <link rel="stylesheet" href="Styles/error-button.css">
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