<?php
require_once "db_connection.php"; // Include the database connection file

if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    // Retrieve data from the form
    $name = $_POST["name"];
    $Estimated_Completion = $_POST["Estimated_Completion"];
    $Estimated_Cost = $_POST["Esitimated_cost"];
    $Summary = $_POST["Summary"];
    $Details = $_POST["Details"];
    $Requirements = $_POST["Requirements"];

    $check_query = "SELECT * FROM Project";
    $result = $conn->query($check_query);

    
            $sql = "INSERT INTO Project(project_id,project_name,estimated_completion,cost,summary,details,requirements) VALUES (1,'$name' ,'$Estimated_Completion', '$Estimated_Cost','$Summary','$Details','$Requirements')";
}
// Close the database connection (optional)
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles\All.css" />
    <link rel="stylesheet" href="Styles\Typography.css" />
    <title>Project submission</title>

</head>

<body>
    <div class="container">

        <!-- Back button with page name -->
        <nav class="top">
            <a href="home.php">
                <div class="small-circle" style="margin-right: 20px;">
                    <img src="img\Back.png" alt="Back arrow">
                </div>
            </a>
            <div class="large-head">
                <div name="title">Project</div>
            </div>
        </nav>

        <div class="container">
        <form action="Submission_form.php" method="post">
            <label for ="name" class="container-subhead">Title - </label>
            <input type="text" placeholder="Enter Name" class="custom-textfield">
            <br>
            <label for ="Estimated_Completion" class="container-subhead">Estimated Completion - </label>
            <input type="date" class="custom-textfield">
            <br>
            <label for ="Estimated_Cost" class="container-subhead">Estimated Cost - </label>
            <input type="text" placeholder="Estimated cost" class="custom-textfield">
            <br>

            <label for ="Summary" class="container-subhead" style="margin-bottom: 10px;">Summary - </label>
            <textarea class="custom-textarea" placeholder="Enter short summary of your project..."></textarea>

            <br>

            <label for ="Details" class="container-subhead" style="margin-bottom: 10px;">Details - </label>
            <textarea class="custom-textarea" placeholder="Enter detailed description of your project..."></textarea>

            <br>

            <label for ="Requirements" class="container-subhead" style="margin-bottom: 10px;">Requirements - </label>
            <textarea class="custom-textarea" placeholder="Enter requirements of your project..."></textarea>

            <br>

            <label class="container-subhead" style="margin-bottom: 10px;">Documents - </label>
        </form>

            <div class="wrapper">
                <div class="container-row">
                    <div class="small-logo">
                        <img src="img\pdf.svg" alt="pdf_logo" style="width: 30px;">
                    </div>
                    <!-- <div class="clientname" > -->
                    <div class="container-text">
                        <p class="container-head">Documentation</p>
                    </div>

                    <div style="margin-left: auto; margin-right: 10px; align-items: end; align-content: end;">
                        <img src="img\black-cross.svg" alt="Cross arrow">
                    </div>
                </div>
            </div>

            <br>

        </div>

        <form action="home.php">
            <div class="logout" style="margin-bottom: 30px;">
                <input type="submit" value="Submit" class="safe-button container-medhead" style="text-align: center; justify-content: center; color: var(--body-background);">
            </div>
        </form>


    </div>
</body>

</html>