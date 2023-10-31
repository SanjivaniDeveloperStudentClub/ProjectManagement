<?php
require "../db_connection.php";
// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Get form input values
    $full_name = $_POST['full_name'];
    $branch = $_POST['branch'];
    $department = $_POST['department'];
    $designation = $_POST['designation'];
    $mobile = $_POST['mobile'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];

    // Establish a database connection (assuming you have a database connection setup)

    // Check the connection
    

    // Insert data into the database
    $sql = "INSERT INTO employee_details (FullName, Branch, Department, Designation, Telephone) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $full_name, $branch, $department, $designation, $telephone);

    if ($stmt->execute()) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    echo "Form not submitted.";
}
?>
