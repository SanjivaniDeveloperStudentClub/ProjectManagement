<?php
// Include your database connection code here
require "./db_connection.php";
//getting employee ud
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST['submit'])) {
    $orgName = $_POST["org_name"];
    $orgEmail = $_POST["org_email"];
    $orgContact = $_POST["org_contact"];
    $useremail = $_COOKIE['useremail'];
    $Branchs = $_POST['Branchs'];
    $Admin_Level = $_POST["Access-Level"];
    $posts = $_POST["posts"];
    $Admin_Level_Arr =  array();
    $Branchs_arr =  array();
    for ($i = 0; $i < count($_POST['Branchs']); $i++) {
      if (isset($_POST['deparment' . ($i + 1)])) {
        for ($j = 0; $j < count($_POST['deparment' . ($i + 1)]); $j++)
          $Branchs_arr[$Branchs[$i]][$j] = $_POST['deparment' . ($i + 1)][$j];
      }
    }
    print_r($Branchs_arr);
    for ($i = 0; $i < $Admin_Level; $i++) {
      $Admin_Level_Arr[] = "Admin " . ($i + 1);
    }
    $Admin_Level_Arr[] = "Normal";
    $serializedAdmin_Level_Arr = serialize($Admin_Level_Arr);
    $serializedBranch_Arr = serialize($Branchs_arr);

    $empid;
    $result = "SELECT *from employee where email=$useremail";
    $check_query = "SELECT * FROM Organization WHERE Organization_Name = '$orgName'";
    $check1_query = "SELECT * FROM Organization WHERE Email = '$useremail'";

    $result = $conn->query($check1_query);
    if (!($result->num_rows > 0)) {

      $result = $conn->query($check_query);
      if (!($result->num_rows > 0)) {

        $check_query = "SELECT Employee_id FROM Employee WHERE Email = '$useremail'";
        $check_query2 = "SELECT Organization_Email FROM Organization WHERE Organization_Email = '$orgEmail'";
        $result = $conn->query($check_query);
        $result2 = $conn->query($check_query2);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            // Access individual fields by column name
            $empid = $row["Employee_id"];
            // echo $empid;
          }
          if ($result2->num_rows > 0) {
            echo "email already exist ";
            // return 0;
          } else {
            $designation = "Default";
            $department = "Default";
            $branch = "Default";
            $employee = "Default";

            $insertQuery = "INSERT INTO Organization (Organization_Name,Organization_Email, Designation, Department, Branch, Employee_id,Contact_No,Email,Access_Level,Branchs,Posts) VALUES ('$orgName', '$orgEmail', 'Admin 1', '$department','$branch','$empid','$orgContact','$useremail','$serializedAdmin_Level_Arr','$serializedBranch_Arr','$postsE')";
            echo $orgName;
            $CreateQuery = "CREATE TABLE " . $orgName . "_" . $empid . " (
  Request_id INT AUTO_INCREMENT PRIMARY KEY,
  REmployee_id INT,
  REmployee_Name TEXT,
  Role TEXT
)";
            $CreateQuery2 = "CREATE TABLE $orgName (
  Employee_Id integer ,
  Employee_Name text,
  Access text,
  Employee_Email text
)";
            $upate_query = "UPDATE employee
            SET AdminLevel = 'Admin 1'
            WHERE Employee_id='$empid'";
            $update_result = $conn->query($upate_query);

            // echo $CreateQuery;
            // echo $CreateQuery2;

            // Assuming you have default values for Designation, Department, Branch, and Employee

            if ($conn->query($insertQuery)) {
              echo "Orginzation created successful!";
              // header("Location:organization.php");
            } else {
              echo "Fill all fileds properly $conn->error";
            }
            if ($conn->query($CreateQuery)) {
              //dont show this message
              echo "table created successful!";
              // header("Location:organization.php");
            } else {
              echo " orginazation already exist1";
            }
            if ($conn->query($CreateQuery2)) {
              //dont show this message
              echo "table created successful!";
              $update_query = "UPDATE Employee
            SET Organization_Name = '$orgName'
            WHERE Email='$useremail'";
              $update_result = $conn->query($update_query);
              echo $conn->error;
              header("Location:home.php");
            } else {
              echo " orginazation already exist2";
              echo $conn->error;
            }
          }
        } else {
          echo "try to login first";
        }
      } else {
        echo "organization already exist";
      }
    } else {
      echo "you can create only one orignization";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Organization</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <link rel="stylesheet" href="Styles\All.css" />
  <link rel="stylesheet" href="Styles\Typography.css" />
  <style>
    .branch-btn {
      width: 24vh;
      display: grid;
      place-items: center;
      height: 5vh;
      font-size: 15px;
      margin-bottom: 2vh;
      /* background-color: red; */
      color: black;
    }
  </style>

</head>

<body onload="loadfun()">

  <!-- DSC LOGO -->
  <div class="logobox">
    <div class="logo">
      <img src="images/dcslogo.png" alt="Developer Student Club Logo" class="logo-width">
    </div>
  </div>

  <!-- Organization Registration Container -->
  <div class="container">
    <div class="wrapper">
      <div class="container-large-head">
        <span>Organization Registration</span>
      </div>

      <form action="CreateOrg.php" method="post">

        <!-- Organization Name -->
        <label for="org-name" class="container-subhead">Organization Name</label>
        <input type="text" name="org_name" id="org-name" placeholder="Enter organization name" required>

        <!-- Email -->
        <label for="org-email" class="container-subhead">Email</label>
        <input type="email" name="org_email" id="org-email" placeholder="Enter email id" required>
        <label for="org-email" class="container-subhead">Branch</label>
        <div id="BranchContainer">
        </div>
        <p class="logout branch-btn" onclick="addBranch()"> Add more branch</p>
        <!-- Helpline Number -->
        <label class="container-subhead">Posts</label>
        <div id="post">
          <input placeholder="Post 1" name="posts[]" class="custom-textfield" id="milestone">
        </div>
        <p class="container-subhead" onclick="addPost()">Add Post</p>
        <label for="org-contact" class="container-subhead">Enter Access Level</label>
        <input type="number" name="Access-Level" id="org-contact" placeholder="Enter helpline number" required>
        <label for="org-contact" class="container-subhead">Helpline Number</label>
        <input type="tel" name="org_contact" id="org-contact" placeholder="Enter helpline number" required>

        <!-- Submit button -->
        <div class="row button">
          <input type="submit" value="Register" name="submit" style="margin-top: 20px;">
        </div>

        <!-- Join an existing organization -->
        <div class="container-label">Join an existing organization? <a href="organization.php">Join organization</a></div>

      </form>
    </div>
  </div>

</body>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);

  }
  let BranchCount = 1;

  const BranchContainer = document.getElementById('BranchContainer');

  function addBranch(obj) {
    let count = BranchCount;
    const branchContainer = document.createElement('div');
    const branchContainerchild = document.createElement('div');
    branchContainer.classList.add('branch-container');
    branchContainerchild.classList.add('branch-container-child');

    // Create branch input field
    const branchInput = document.createElement('input');
    branchInput.type = 'text';
    branchInput.placeholder = 'Branch Name';
    branchInput.name = "Branchs[]";
    branchInput.required = true;

    // Create add department button for the branch
    const addDepartmentButton = document.createElement('button');
    addDepartmentButton.textContent = 'Add Department';
    addDepartmentButton.onclick = function() {
      addDepartment(branchContainerchild, count);
    };
    if (BranchCount == 1) {
      addDepartment(branchContainerchild, count);

    }

    branchContainer.appendChild(branchInput);
    branchContainer.append(branchContainerchild);
    branchContainer.appendChild(addDepartmentButton);

    // Append branch container to the body
    BranchContainer.appendChild(branchContainer);
    BranchCount++;
  }

  function addDepartment(branchContainer, count) {
    // Create department input field
    const departmentInput = document.createElement('input');
    departmentInput.type = 'text';
    departmentInput.placeholder = 'Department Name';
    departmentInput.name = `deparment${count}[]`;

    // Append department input to the branch container
    branchContainer.appendChild(departmentInput);
  }
  // function addBranch(obj) {
  //   BranchCount++;
  // const BranchContainer = document.getElementById('BranchContainer');
  //   const BranchContainer = obj;
  //   const newBranchInput = document.createElement('input');
  //   const newBranchLablel = document.createElement('label');
  //   newBranchInput.name = 'Branchs[]';
  //   newBranchLablel.innerHTML = `Branch ${BranchCount}`;
  //   newBranchInput.placeholder = "Enter Branch Name"
  //   newBranchInput.className = 'custom-textfield';
  //   newBranchInput.id = 'BranchInput';
  //   newBranchLablel.className = 'container-subhead';
  //   BranchContainer.appendChild(newBranchLablel)
  //   BranchContainer.appendChild(newBranchInput)
  // }
  function loadfun() {
    addBranch();
  }
  let postcount = 1;

  function addPost() {
    postcount++;
    let postContainer = document.getElementById("post");
    let InputField = document.createElement("input");
    InputField.required = true;
    InputField.name = "posts[]";
    InputField.type = "text";
    InputField.placeholder = `Post ${postcount}`
    postContainer.appendChild(InputField);
  }
</script>

</html>