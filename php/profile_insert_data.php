<?php
require "../db_connection.php";
// Check if the form was submitted
if (isset($_POST['submit'])) {
    $pic = $_POST['picimg'];
    print_r($_POST);
    // Get form input values
    $full_name = $_POST['full_name'];
    $branch = $_POST['branch'];
    $department = $_POST['department'];
    $designation = $_POST['designation'];
    $mobile = $_POST['mobile'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $useremail = $_COOKIE['useremail'];

    // Establish a database connection (assuming you have a database connection setup)

    // Check the connection

    // Update data in the database
    $Updatequery = "UPDATE Employee 
                SET Employee_Name = '$full_name',
                    Branch = '$branch',
                    Department = '$department',
                    Post = '$designation',
                    Contact_Number = '$mobile',
                    Telephone = '$telephone',
                    Profile_img = '$pic'
                WHERE Email = '$useremail'";
    $result = $conn->query($Updatequery);

    if ($result) {
        echo "Update successful!";
    } else {
        echo $conn->error;
    }
}
