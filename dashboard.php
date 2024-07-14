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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Roboto', sans-serif;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Page Header */
        .page-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .page-header h2 {
            font-size: 2.5em;
            color: #343a40;
        }

        /* Chart Container */
        .chart-container {
            margin-bottom: 40px;
        }

        canvas#projectChart {
            width: 100%;
            height: 400px;
        }

        /* Stats Container */
        .stats-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-around;
        }

        .stats-card {
            flex: 1 1 calc(33.333% - 40px);
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.2s;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .card-title {
            font-size: 1.25em;
            color: #007bff;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 1.5em;
            color: #343a40;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .stats-card {
                flex: 1 1 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h2>Project Dashboard</h2>
        </div>
        <div class="chart-container">
            <canvas id="projectChart"></canvas>
        </div>
        <div class="stats-container">
            <div class="stats-card">
                <h5 class="card-title">Total Project Complete</h5>
                <p class="card-text"><?php echo $complete; ?></p>
                <a href="./Completed_Project.php" class="btn btn-primary">Check</a>
            </div>
            <div class="stats-card">
                <h5 class="card-title">Total Project Delay</h5>
                <p class="card-text"><?php echo $delay; ?></p>
                <a href="./Delay_Project.php" class="btn btn-primary">Check</a>
            </div>
            <div class="stats-card">
                <h5 class="card-title">Total Project Ongoing</h5>
                <p class="card-text"><?php echo $on_going; ?></p>
                <a href="./On_Going_Project.php" class="btn btn-primary">Check</a>
            </div>
            <div class="stats-card">
                <h5 class="card-title">Total Project Pending Request</h5>
                <p class="card-text"><?php echo $pending; ?></p>
                <a href="./Project_Request.php" class="btn btn-primary">Check</a>
            </div>
            <div class="stats-card">
                <h5 class="card-title">Total Project Disapproved</h5>
                <p class="card-text"><?php echo $disapprove; ?></p>
                <a href="./Project_Disapprove.php" class="btn btn-primary">Check</a>
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
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    </script>
</body>

</html>