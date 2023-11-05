<?php
// Establish a database connection (you'll need to add your database credentials)
require "./db_connection.php";
if (isset($_POST["submit"])) {
    $currentDate = date('Y-m-d'); // Format: Year-Month-Day
    // Get form data
    $title = $_POST['title'];
    $estimated_completion = $_POST['estimated_completion'];
    $cost = $_POST['cost'];
    $summary = $_POST['summary'];
    $details = $_POST['details'];
    $requirements = $_POST['requirements'];
    $document = $_POST['document'];
    $milestones_dates  = $_POST['milestones_dates'];
    $useremail = $_COOKIE['useremail'];
    $milestones =  array();
    $milestones_status =  array();
    for ($i = 0; $i < count($_POST["milestones"]); $i++) {
        $milestones[] = $_POST["milestones"][$i];
        $milestones_status[] = "incomplete";
    }
    $serializedMilestones = serialize($milestones);
    $serializedMilestones_status = serialize($milestones_status);
    $serializedMilestones_dates = serialize($milestones_dates);
    // You can also process the documents here if needed
    echo $serializedMilestones_dates;
    $query = "SELECT * FROM Employee WHERE Email = '$useremail'";
    $result = $conn->query($query);
    $username;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Access individual fields by column name
            $eid = $row["Employee_id"];
            $Organization_Name = $row["Organization_Name"];
            echo $Organization_Name;
        }
    }
    // Insert data into the Project table
    $sql = "INSERT INTO Project ( Started_Date,Estimated_Completion, Cost, Summary, Details, Requirements, Documents, Suggestions, Department,title,Employee_id,Status,Organization_Name,Milestones,Milestones_status,Milestones_dates)
        VALUES ('$currentDate', '$estimated_completion', '$cost', '$summary', '$details', '$requirements', '$document', NULL, NULL,'$title','$eid','pending','$Organization_Name','$serializedMilestones','$serializedMilestones_status','$serializedMilestones_dates')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully!";
        header("Location:home.php");
    } else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
// Close the database connection

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles\All.css" />
    <link rel="stylesheet" href="Styles\Typography.css" />
    <title>Project Submission</title>
    <style>
        #error-message {
            display: none;
            color: red;
            font-weight: 400;
        }
    </style>

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
            <form action="Submission_form.php" method="POST"> <!-- This form will post data to insert_project.php -->
                <label class="container-subhead">Title - </label>
                <input type="text" name="title" placeholder="Enter Name" class="custom-textfield">
                <br>
                <label class="container-subhead">Estimated Completion - </label>
                <input onchange="checkdate(this)" type="date" name="estimated_completion" id="estimation_date" class="custom-textfield">
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
                <p class="container-subhead" style="margin-bottom: 20px;" id="milestones">Milestones - </label>
                    <label class="container-subhead" style="margin-bottom: 10px;">Milestone 1:- </label>
                    <textarea placeholder="Milestone 1 text" name="milestones[]" class="custom-textfield" id="milestone"></textarea>
                    <input onchange="checkdate(this)" type="date" placeholder="Milestone 1 date" name="milestones_dates[]" class="custom-textfield" id="milestone_dates" />
                <p class="logout" onclick="addmilestonefields()"> Add more milestone</p>
                <p id="error-message"></p>
                </p>
                <br>

                <label class="container-subhead" style="margin-bottom: 10px;">Documents - </label>
                <div class="wrapper">
                    <div class="container-row">
                        <form method="post" enctype="multipart/form-data" class="container-text">
                            <label class="-head"><span class="small-logo">
                                    <img src="img\pdf.svg" alt="pdf_logo" style="width: 30px;">
                                </span>Documentation</label>
                            <input type="text" style="display:block" name="document" id="document">
                    </div>

                </div>
        </div>

        <!-- You can add file input here for uploading documents if needed -->


        <br>

        <div class="logout" style="margin-bottom: 30px;">
            <input type="submit" value="Submit" name="submit" id="submit" class="safe-button container-medhead" style="text-align: center; justify-content: center; color: var(--body-background);">
        </div>
        </form>
    </div>
    </div>
</body>
<script>
    let a = document.getElementsByClassName("custom-textfield");
    let counter = a.length - 1;

    console.log(counter, a.length)
    let lastmilestone = a[counter];

    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);

    }
    let milestonecount = 1;
    let milestoneInputs = [];

    function addmilestonefields(e) {
        milestonecount++;

        // Remove event listeners for previous milestones
        for (const input of milestoneInputs) {
            input.removeEventListener('change', handleMilestoneChange);
        }

        const milestonesContainer = document.getElementById('milestones');
        const newMilestoneTextarea = document.createElement('textarea');
        const newMilestoneInput = document.createElement('input');
        const newMilestonelabel = document.createElement('label');
        newMilestoneTextarea.name = 'milestones[]';
        newMilestoneInput.name = 'milestones_dates[]';
        newMilestoneTextarea.className = 'custom-textfield';
        newMilestoneInput.className = 'custom-textfield';
        newMilestoneTextarea.id = 'milestone';
        newMilestoneInput.id = 'milestone_dates';
        newMilestoneTextarea.placeholder = `Milestone ${milestonecount} text`;
        newMilestonelabel.className = 'container-subhead';
        newMilestonelabel.innerText = `Milestone ${milestonecount}:-`;
        newMilestoneInput.type = "date";

        // Add event listener for the new milestone input
        newMilestoneInput.addEventListener('change', handleMilestoneChange);
        milestoneInputs.push(newMilestoneInput);

        milestonesContainer.appendChild(newMilestonelabel);
        milestonesContainer.appendChild(newMilestoneTextarea);
        milestonesContainer.appendChild(newMilestoneInput);
    }

    estimation_date.addEventListener("change", (e) => {
        console.log("welcome to ")
        let error_message = document.getElementById("error-message");
        let estimated_completion = document.getElementsByName("estimated_completion")[0].value;

        if (estimated_completion == "") {
            error_message.innerHTML = "First enter Estimation Completion date";
            submit.disabled = true

            error_message.style.display = "block";
            return;
        }

        const selectedDate = new Date(lastmilestone.value);
        const estimatedCompletionDate = new Date(estimated_completion);

        selectedDate.setHours(0, 0, 0, 0);
        estimatedCompletionDate.setHours(0, 0, 0, 0);

        if (selectedDate.getTime() === estimatedCompletionDate.getTime()) {
            error_message.innerHTML = "";
            error_message.style.display = "none";
            submit.disabled = false
        } else {
            submit.disabled = true
            error_message.style.display = "block";
            error_message.innerHTML = "Estimation completion date does not match with the last milestone.";
        }
    });

    function handleMilestoneChange(e) {
        let error_message = document.getElementById("error-message");
        let estimated_completion = document.getElementsByName("estimated_completion")[0].value;

        if (estimated_completion == "") {
            error_message.innerHTML = "First enter Estimation Completion date";
            submit.disabled = true

            error_message.style.display = "block";
            return;
        }

        const selectedDate = new Date(e.target.value);
        const estimatedCompletionDate = new Date(estimated_completion);

        selectedDate.setHours(0, 0, 0, 0);
        estimatedCompletionDate.setHours(0, 0, 0, 0);

        if (selectedDate.getTime() === estimatedCompletionDate.getTime()) {
            error_message.innerHTML = "";
            error_message.style.display = "none";
            submit.disabled = false
        } else {
            submit.disabled = true
            error_message.style.display = "block";
            error_message.innerHTML = "Estimation completion date does not match with the last milestone.";
        }
    }


    function checkdate(obj) {

        let date = new Date();
        if (new Date(obj.value) < date) {
            obj.value = "";
            return alert("dont enter past date")
        }
    }
</script>

</html>