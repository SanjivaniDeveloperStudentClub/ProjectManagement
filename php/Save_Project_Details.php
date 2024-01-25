<?php
require "../db_connection.php";
if (isset($_POST['submit'])) {
    print_r($_POST);
    $pid  = $_POST['pid'];
    $title = $_POST["Title"];
    $Details = $_POST["Details"];
    $Summary = $_POST["Summary"];
    $Requirements = $_POST["Requirements"];
    $Documents = $_POST["Documents"];
    $milestones = $_POST['milestones'];
    $Status = $_POST['Status'];
    $milestones_status = $_POST['milestone_status'];
    $serializedMilestones = serialize($milestones);
    $serializedMilestones_status = serialize($milestones_status);
    // echo $milestones_status[$milestones_status.length-1];
    $Status_value;
    for($i=0;$i<count($milestones_status);$i++){
        if($milestones_status[$i]=="due"){
            $Status_value="due";
        }
        else{
            $Status_value="On-Going";

        }

    }
    if(end($milestones_status)=="complete"){
        $Status_value="complete";
    }
    // You can also process the documents here if needed
    if ($Status != "Disapproved") {
        $sql = "UPDATE Project SET Summary = '$Summary', Details = '$Details', Documents ='$Documents',title='$title',Milestones = '$serializedMilestones',Milestones_status = '$serializedMilestones_status',Requirements='$Requirements',Status ='$Status_value',Update_status = 'Updated'
WHERE Project_ID=$pid";
        if ($conn->query($sql) === TRUE) {
            header("Location:../home.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "try to update disapprove project";
    }


    // echo ($_POST['title']);
} else {
    header("Location:home.php");
}
