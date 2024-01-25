<?php
require './db_connection.php';
require './authchecker.php';
require "./php/currentuser_details.php";

$userdetail = currentuserdetails();
$complete=0;
$delay=0;
$on_going=0;
$pending=0;
$disapprove=0;
if ($userdetail) {
    
    $employeeId = $userdetail["Employee_id"];

    $orgcheck = "SELECT * FROM Organization WHERE Employee_id = ?";
    $stmt = $conn->prepare($orgcheck);
    $stmt = $conn->prepare($orgcheck);

    if ($stmt) { // Check if the prepare method succeeded
        $stmt->bind_param("i", $employeeId);
        $stmt->execute();
        $orgResult = $stmt->get_result();

        if ($orgResult->num_rows > 0) {
            $orgrow = $orgResult->fetch_assoc();
            $organizationName = $orgrow["Organization_Name"];
            $query = "SELECT * FROM Project Where Organization_Name='$organizationName'";
            $proresult = $conn->query($query);
        } else {
            $OrgName =  $userdetail["Organization_Name"];
            $query = "SELECT * FROM Project WHERE Organization_Name = '$OrgName'";
            $proresult = $conn->query($query);
        }
    } else {
        echo "Error preparing the organization query: " . $conn->error;
    }
}
 else {
    echo "Error: User details not found.";
}

 $result = $conn->query($query);
 $i=0;
 for ($i = 0; $i < $proresult->num_rows; $i++) {
     $row = $proresult->fetch_assoc(); // Fetch the row
     $Status = $row["Status"];
     if ($Status == "On-Going") {
         $on_going++;
     } else if ($Status == "Disapproved") {
         $disapprove++;
     } else if ($Status == "due") {
         $delay++;
     } else if ($Status == "complete") {
         $complete++;
     } else {
         // Handle other statuses if needed
     }
 }
 $useremail = $_COOKIE['useremail'];
 $query1 = "SELECT * FROM Employee WHERE Email = '$useremail'";
 $result1 = $conn->query($query1);
 $row1 = $result1->fetch_assoc();
 $Organization_Name = $row1['Organization_Name'];
 // $AdminLevel = $row1['AdminLevel'];
 $AdminLevel = $row1['AdminLevel'];
 $query = "SELECT * FROM Project WHERE Status= 'pending' AND Organization_Name = '$Organization_Name'";
 $result = $conn->query($query);
 
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Add your CSS styles here */

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;

        }

        .col-span-full {
            grid-column: span 12;
        }

        .xl\:col-span-8 {
            grid-column: span 8;
        }

        .bg-white {
            background-color: #ffffff;
        }

        .dark\:bg-slate-800 {
            background-color: white;
        }

        .shadow-lg {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .rounded-sm {
            border-radius: 0.125rem;
        }

        .border {
            border-width: 1px;
            border-style: solid;
        }

        .border-slate-200 {
            border-color: #e5e7eb;
        }

        .dark\:border-slate-700 {
            border-color: #4b5563;
        }

        .px-5 {
            padding-left: 1.25rem;
            padding-right: 1.25rem;
        }

        .py-4 {
            /* padding-top: 1rem;
            padding-bottom: 1rem; */
        }

        .border-b {
            border-bottom-width: 1px;
            border-bottom-style: solid;
        }

        .border-slate-100 {
            border-bottom-color: #d2d6dc;
        }

        .dark\:border-slate-700 {
            border-bottom-color: #4b5563;
        }

        .font-semibold {
            font-weight: 600;
        }

        .text-slate-800 {
            color: #1f2933;
        }

        .dark\:text-slate-100 {
            color: #f9fafb;
        }

        .p-3 {
            padding: 0.75rem;
        }
.white{
color:black;
}

    </style>
    <title>HTML CSS Conversion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</head>
<body>
    <div class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
            <h2 class="font-semibold text-slate-800 dark:text-slate-100 white">DashBoard</h2>
        </header>
    </div>
    <div class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
            <h2 class="font-semibold text-slate-800 dark:text-slate-100 white">Projects</h2>
        </header>
    </div>
        <div class="card" style="width: 90%; margin:2vh auto;">
  <div class="card-body">
    <h5 class="card-title">Total Project Complete</h5>
    <p class="card-text"><?php echo $complete?></p>
    <a href="./Completed_Project.php" class="btn btn-primary">Check</a>
  </div>
</div>
        <div class="card" style="width: 90%; margin:2vh auto;">
  <div class="card-body">
    <h5 class="card-title">Total Project Delay</h5>
    <p class="card-text"><?php echo $delay?></p>
    <a href="./Delay_Project.php" class="btn btn-primary">Check</a>
  </div>
</div>
        <div class="card" style="width: 90%; margin:2vh auto;">
  <div class="card-body">
    <h5 class="card-title">Total Project On Going</h5>
    <p class="card-text"><?php echo $on_going?></p>
    <a href="./On_Going_Project.php" class="btn btn-primary">Check</a>
  </div>
</div>
        <div class="card" style="width: 90%; margin:2vh auto;">
  <div class="card-body">
    <h5 class="card-title">Total Project Pending Request</h5>
    <p class="card-text"><?php echo $result->num_rows?></p>
    <a href="./Project_Request.php" class="btn btn-primary">Check</a>
  </div>
</div>
        <div class="card" style="width: 90%; margin:2vh auto;">
  <div class="card-body">
    <h5 class="card-title">Total Project Dissapprove</h5>
    <p class="card-text"><?php echo $disapprove?></p>
    <a href="./Project_Disapprove.php" class="btn btn-primary">Check</a>
  </div>
</div>
</body>
</html>
