<?php
require './db_connection.php';
require './authchecker.php';
require "./php/currentuser_details.php";

$userdetail = currentuserdetails();
$complete = 0;
$delay = 0;
$on_going = 0;
$pending = 0;
$disapprove = 0;

if ($userdetail) {
    $employeeId = $userdetail["Employee_id"];
    $stmt = $conn->prepare("SELECT * FROM Organization WHERE Employee_id = ?");
    
    if ($stmt) {
        $stmt->bind_param("i", $employeeId);
        $stmt->execute();
        $orgResult = $stmt->get_result();

        if ($orgResult->num_rows > 0) {
            $orgrow = $orgResult->fetch_assoc();
            $organizationName = $orgrow["Organization_Name"];
        } else {
            $organizationName = $userdetail["Organization_Name"];
        }

        $query = "SELECT * FROM Project WHERE Organization_Name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $organizationName);
        $stmt->execute();
        $proresult = $stmt->get_result();

        while ($row = $proresult->fetch_assoc()) {
            switch ($row["Status"]) {
                case "On-Going":
                    $on_going++;
                    break;
                case "Disapproved":
                    $disapprove++;
                    break;
                case "due":
                    $delay++;
                    break;
                case "complete":
                    $complete++;
                    break;
            }
        }
    } else {
        echo "Error preparing the organization query: " . $conn->error;
    }
} else {
    echo "Error: User details not found.";
}

$useremail = $_COOKIE['useremail'];
$query = "SELECT * FROM Employee WHERE Email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $useremail);
$stmt->execute();
$result1 = $stmt->get_result();
$row1 = $result1->fetch_assoc();
$Organization_Name = $row1['Organization_Name'];

$query = "SELECT * FROM Project WHERE Status = 'pending' AND Organization_Name = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $Organization_Name);
$stmt->execute();
$result = $stmt->get_result();
$pending = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .card-custom {
            margin-bottom: 20px;
        }

        .white {
            color: black;
        }

        .dark-theme .bg-white {
            background-color: #4b5563;
        }

        .dark-theme .text-slate-800 {
            color: #f9fafb;
        }

        .dark-theme .border-slate-200 {
            border-color: #4b5563;
        }

        .chart-container {
            position: relative;
            width: 500px;
            margin-bottom: 40px; 
            /* display: grid;
            justify-items: center;
            align-items: center ; */
            margin-left: 27%;
        }

        .page-header {
            margin: 2vh 0;
            text-align: center;
        }

        .page-header h2 {
            font-weight: bold;
            color: #1f2937;
        }

        .dark-theme .page-header h2 {
            color: #f9fafb;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="page-header">
            <h2>Dashboard</h2>
        </div>
        <div class="chart-container">
            <canvas id="projectChart"></canvas>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card card-custom">
                    <div class="card-body">
                        <h5 class="card-title">Total Project Complete</h5>
                        <p class="card-text"><?php echo $complete; ?></p>
                        <a href="./Completed_Project.php" class="btn btn-primary">Check</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card card-custom">
                    <div class="card-body">
                        <h5 class="card-title">Total Project Delay</h5>
                        <p class="card-text"><?php echo $delay; ?></p>
                        <a href="./Delay_Project.php" class="btn btn-primary">Check</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card card-custom">
                    <div class="card-body">
                        <h5 class="card-title">Total Project Ongoing</h5>
                        <p class="card-text"><?php echo $on_going; ?></p>
                        <a href="./On_Going_Project.php" class="btn btn-primary">Check</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card card-custom">
                    <div class="card-body">
                        <h5 class="card-title">Total Project Pending Request</h5>
                        <p class="card-text"><?php echo $pending; ?></p>
                        <a href="./Project_Request.php" class="btn btn-primary">Check</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card card-custom">
                    <div class="card-body">
                        <h5 class="card-title">Total Project Disapproved</h5>
                        <p class="card-text"><?php echo $disapprove; ?></p>
                        <a href="./Project_Disapprove.php" class="btn btn-primary">Check</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('projectChart').getContext('2d');
        const projectChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Complete', 'Delay', 'On-Going', 'Pending', 'Disapproved'],
                datasets: [{
                    label: 'Project Status',
                    data: [
                        <?php echo $complete; ?>, 
                        <?php echo $delay; ?>, 
                        <?php echo $on_going; ?>, 
                        <?php echo $pending; ?>, 
                        <?php echo $disapprove; ?>
                    ],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(255, 159, 64)'
                    ],
                    hoverOffset: 4
                }]
            }
        });
    </script>
</body>
</html>
