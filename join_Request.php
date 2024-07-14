<?php
require "./db_connection.php";
$email = $_COOKIE['useremail'];
$query_11 = "SELECT * FROM Employee WHERE Email = '$email'";
$result_11 = $conn->query($query_11);
$orgName;
$employee_id;
$query;

if ($result_11 === false) {
    // Handle the query error here
    echo "no account found";
} else {
    if ($result_11->num_rows > 0) {
        $row_11 = $result_11->fetch_assoc();
        $orgName = $row_11["Organization_Name"];
    }
    if ($orgName == "Your Organization") {
        $query = "SELECT * FROM Organization WHERE Email = '$email'";
        $result = $conn->query($query);
    } else {
        $query = "SELECT * FROM Organization WHERE Organization_Name = '$orgName'";
        $result = $conn->query($query);
    }
    $Access_Level;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Access individual fields by column name
        $orgName = $row["Organization_Name"];
        $employee_id = $row["Employee_id"];
        $Access_Level = $row['Access_Level'];
        // echo $orgName;
    } else {
        echo "error";
    }

    $query1 = "SELECT * FROM $orgName" . "_" . "$employee_id";
    // echo $query1;
    $result1 = $conn->query($query1);
}

$Access_Levels = unserialize($Access_Level);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
    <link rel="stylesheet" href="Styles/All.css">
    <link rel="stylesheet" href="Styles/Typography.css">

    <title>Dashboard</title>
    <style>
        .small-button {
            width: 100px;
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- Back button with page name -->
        <nav class="top">
            <a href="profile.php">
                <div class="small-circle" style="margin-right: 20px;">
                    <img src="img/Back.png" alt="Back arrow">
                </div>
            </a>
            <div class="large-head">
                <div name="title">Requests</div>
            </div>
        </nav>

    </div>

    <div class="container container-subhead">
        <span style="text-align: left;"></span>
    </div>

    <form class="container" method="post" action="./Accept.php">
        <input type="hidden" name="emp_id" value="<?php echo $employee_id; ?>">
        <table>
            <thead class="container-body">
                <tr>
                    <td>Employee ID</td>
                    <td>Name</td>
                    <td style="margin: 0 6vh;">Role</td>
                </tr>
            </thead>
            <tbody class="container-label">
                <?php
                if ($result1->num_rows > 0) {
                    while ($row1 = $result1->fetch_assoc()) {
                        // Access individual fields by column name
                        $id = $row1["Request_id"];
                        $REmployee_Name = $row1["REmployee_Name"];
                        $REmployee_id = $row1["REmployee_id"];
                        $Role = $row1["Role"];
                ?>
                        <tr>
                            <td><?php echo $REmployee_id; ?></td>
                            <td><?php echo $REmployee_Name; ?></td>
                            <td>
                                <select name="Role">
                                    <?php
                                    foreach ($Access_Levels as $access_level) {
                                        $selected = ($access_level === end($Access_Levels)) ? 'selected' : '';
                                        echo "<option value='$access_level' $selected>$access_level</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <div class="button-group">
            <input type="submit" class="small-button safe-button" value="Accept" name="Accept">
            <input type="submit" class="small-button safe-button" value="Reject" name="Reject">
        </div>
    </form>

</body>
<script>
    // JavaScript code can be added here if needed
</script>

</html>
