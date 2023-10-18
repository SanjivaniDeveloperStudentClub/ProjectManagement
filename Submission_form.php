<?php
<<<<<<< HEAD
// Establish a database connection (you'll need to add your database credentials)
require "./db_connection.php";
if(isset($_POST["submit"])){
    $currentDate = date('Y-m-d'); // Format: Year-Month-Day

    // Get form data
    $title = $_POST['title'];
    $estimated_completion = $_POST['estimated_completion'];
    $cost = $_POST['cost'];
    $summary = $_POST['summary'];
    $details = $_POST['details'];
    $requirements = $_POST['requirements'];
    $document = $_POST['document'];
    $useremail=$_COOKIE['useremail'];
    // You can also process the documents here if needed
    $query = "SELECT * FROM Employee WHERE Email = '$useremail'";
    $result = $conn->query($query);
    $username;
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        // Access individual fields by column name
        $eid = $row["Employee_id"];
    // echo $column1Value;
    }
  }
    // Insert data into the Project table
    $sql = "INSERT INTO Project ( Started_Date,Estimated_Completion, Cost, Summary, Details, Requirements, Documents, Suggestions, Department,title,Employee_id)
        VALUES ('$currentDate', '$estimated_completion', '$cost', '$summary', '$details', '$requirements', '$document', NULL, NULL,'$title','$eid')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully!";
    header("Location:home.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
// Close the database connection

=======
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
>>>>>>> 1ce98e610d5d17b7f04d8d40bc0eea3f5416caad
?>

<!DOCTYPE html>
<html lang="en">
<<<<<<< HEAD
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles\All.css" />
    <link rel="stylesheet" href="Styles\Typography.css" />
    <title>Project Submission</title>
=======

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles\All.css" />
    <link rel="stylesheet" href="Styles\Typography.css" />
    <title>Project submission</title>

>>>>>>> 1ce98e610d5d17b7f04d8d40bc0eea3f5416caad
</head>

<body>
    <div class="container">
<<<<<<< HEAD
=======

>>>>>>> 1ce98e610d5d17b7f04d8d40bc0eea3f5416caad
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
<<<<<<< HEAD
            <form action="Submission_form.php" method="POST"> <!-- This form will post data to insert_project.php -->
                <label class="container-subhead">Title - </label>
                <input type="text" name="title" placeholder="Enter Name" class="custom-textfield">
                <br>
                <label class="container-subhead">Estimated Completion - </label>
                <input type="date" name="estimated_completion" class="custom-textfield">
                <br>
                <label class="container-subhead">Estimated Cost - </label>
                <input type="text" name="cost" placeholder="Estimated cost" class="custom-textfield">
                <br>

                <label class="container-subhead" style="margin-bottom: 10px;">Summary - </label>
                <textarea name="summary" class="custom-textarea" placeholder="Enter short summary of your project..."></textarea>
                <br>

                <label class="container-subhead" style="margin-bottom: 10px;">Details - </label>
                <textarea name="details" class="custom-textarea" placeholder="Enter detailed description of your project..."></textarea>
                <br>

                <label class="container-subhead" style="margin-bottom: 10px;">Requirements - </label>
                <textarea name="requirements" class="custom-textarea" placeholder="Enter requirements of your project..."></textarea>
                <br>

                <label class="container-subhead" style="margin-bottom: 10px;">Documents - </label>
                <div class="wrapper">
=======
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
>>>>>>> 1ce98e610d5d17b7f04d8d40bc0eea3f5416caad
                <div class="container-row">
                    <div class="small-logo">
                        <img src="img\pdf.svg" alt="pdf_logo" style="width: 30px;">
                    </div>
                    <!-- <div class="clientname" > -->
                    <div class="container-text">
<<<<<<< HEAD
                        <label class="container-head" for="document">Documentation</label>
                        <input type="file" style="display:none"  name="document" id="document">
=======
                        <p class="container-head">Documentation</p>
>>>>>>> 1ce98e610d5d17b7f04d8d40bc0eea3f5416caad
                    </div>

                    <div style="margin-left: auto; margin-right: 10px; align-items: end; align-content: end;">
                        <img src="img\black-cross.svg" alt="Cross arrow">
                    </div>
                </div>
            </div>

<<<<<<< HEAD
                <!-- You can add file input here for uploading documents if needed -->
                

                <br>

                <div class="logout" style="margin-bottom: 30px;">
                <input type="submit" value="Submit" name="submit" class="safe-button container-medhead" style="text-align: center; justify-content: center; color: var(--body-background);">
            </div>
                    </form>
        </div>
    </div>
</body>
<script>
if(window.history.replaceState){
window.history.replaceState(null,null,window.location.href);

}
</script>
</html>
=======
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
>>>>>>> 1ce98e610d5d17b7f04d8d40bc0eea3f5416caad
