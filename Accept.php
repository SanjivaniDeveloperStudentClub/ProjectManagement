<?php
require "./db_connection.php";
print_r($_POST);
if (isset($_POST['Accept'])) {
    $email = $_COOKIE['useremail'];
    $orgName;
    $orgid;
    $query_11 = "SELECT * FROM Employee WHERE Email = '$email'";
    $result_11 = $conn->query($query_11);
    $employee_id;
    $AdminLevel;
    $query;
    if ($result_11->num_rows > 0) {
        $row_11 = $result_11->fetch_assoc();
        $orgName = $row_11["Organization_Name"];
        $AdminLevel = $row_11["AdminLevel"];
    }
    if ($orgName == "Your Organization") {
        $query = "SELECT * FROM Organization WHERE Email = '$email'";
        $result = $conn->query($query);
    } else {
        $query = "SELECT * FROM Organization WHERE Organization_Name = '$orgName'";
        $result = $conn->query($query);
    }

    echo $result->num_rows;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Access individual fields by column name
        $orgName = $row["Organization_Name"];
        $orgid = $row["Employee_id"];
        echo $orgName;
        echo $orgid;
    } else {
        echo "error";
    }
    $Search_query = "SELECT * FROM $orgName" . "_" . "$orgid";
    $result2 = $conn->query($Search_query);
    if ($result2->num_rows > 0) {
        $row = $result2->fetch_assoc();
        // Access individual fields by column name
        $Request_id = $row["Request_id"];
        $employee_id = $row["REmployee_id"];
        $employee_name = $row["REmployee_Name"];
        $Role = $_POST['Role'];
        $Search_query = "SELECT * FROM Employee where Employee_id='$employee_id'";
        $result2 = $conn->query($Search_query);
        if ($result2->num_rows > 0) {
            $row = $result2->fetch_assoc();

            $employee_email = $row['Email'];
            // echo $employee_email;
            $delete_query = "DELETE FROM $orgName" . "_" . "$orgid where REmployee_id='$employee_id'";
            //   echo $delete_query;
            // $result11 = $conn->query($delete_query);
            // echo $result11;
            $Accept_query = "INSERT INTO $orgName (Employee_Id, Employee_Name, Access, Employee_Email) VALUES ( '$employee_id', '$employee_name', '$Role','$employee_email')";
            $result1 = $conn->query($Accept_query);
            echo "Request Accepted";

            $upate_query = "UPDATE employee
            SET Organization_Name = '$orgName'
            WHERE Employee_id='$employee_id'";
            $update_result = $conn->query($upate_query);
            $upate_query = "UPDATE employee
            SET AdminLevel = '$Role'
            WHERE Employee_id='$employee_id'";
            $update_result = $conn->query($upate_query);

            $delete_query = "DELETE FROM $orgName" . "_" . "$orgid where Request_id=$Request_id";
            $result11 = $conn->query($delete_query);
            echo $delete_query;
            header("Location:join_Request.php");

            // echo $conn->error;
            // echo $update_result;
            // header("Location:join_Request.php");
        } else {
            echo "invalid access";
            header("Location:index.php");
        }
    } else {
        echo "page not found";
    }
    // $result1 = $conn->query($query1);
} else {
    $email = $_COOKIE['useremail'];
    $empid = $_POST["emp_id"];
    $orgName;
    $orgid;
    $query_11 = "SELECT * FROM Employee WHERE Email = '$email'";
    $result_11 = $conn->query($query_11);
    $employee_id;
    $query;
    if ($result_11->num_rows > 0) {
        $row_11 = $result_11->fetch_assoc();
        $orgName = $row_11["Organization_Name"];
    }
    if ($orgName == "Your Organization") {
        $query = "SELECT * FROM Organization WHERE Email = '$email'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $orgid = $row["Employee_id"];
    } else {
        $query = "SELECT * FROM Organization WHERE Organization_Name = '$orgName'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $orgid = $row["Employee_id"];
    }

    $delete_query = "DELETE FROM $orgName" . "_" . "$orgid where Request_id=$empid";
    $result11 = $conn->query($delete_query);
    echo $delete_query;
    header("Location:join_Request.php");
}
