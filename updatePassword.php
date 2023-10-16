<?php
require "./db_connection.php"; // Make sure the database connection file is correctly included

$useremail = $_COOKIE['passwordupdatestate'];
echo $useremail;
setcookie('otp', '', time() - 3600, '/');
if(isset($_COOKIE['passwordupdatestate'])){
    echo "om";
    setcookie('passwordupdatestate',false);
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['update_password'])) {
            // Check if the 'useremail' cookie is set
            // $useremail = $_COOKIE['useremail'];
            $newpassword = $_POST['newpassword'];
            
            $updateQuery = "UPDATE Employee SET Password = ? WHERE Email = ?";
            $stmt = $conn->prepare($updateQuery);
            
            if ($stmt) {
                // Bind the parameters
                $stmt->bind_param("ss", $newpassword, $useremail);
                
                // Execute the query
                if ($stmt->execute()) {
                    echo "Password updated successfully.";
                    header("Location: index.php"); // Redirect to the home page
                    
                } else {
                    echo "Error updating password: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error preparing the statement: " . $conn->error;
            }
            
        }
    }
}
else{
    echo "salunke";
    header("Location:ForgotPass.php"); 
}
?>
<!DOCTYPE html>
<html>
    <body>
        <form method="post" action="updatePassword.php">
            <input type="password" name="newpassword" placeholder="Enter new password" required>
            <button name="update_password" type="submit">Update Password</button>
        </form>
    </body>
    <script>
        document.cookie="";
        </script>
</html>
