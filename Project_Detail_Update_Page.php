<!DOCTYPE html>
<?php
require './db_connection.php';
// $url_string
$currentURL = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$url_string_component = parse_url($currentURL);
parse_str($url_string_component['query'], $param);
$pid = $param['pid'];

$query = "SELECT * FROM Project where Project_ID=$pid";
$result = $conn->query($query);
$username;
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="Styles\All.css" />
  <link rel="stylesheet" href="Styles\Typography.css" />
  <title>Edit Project Details</title>
  <style>
    .container-subhead p {
      overflow: hidden;
    }

    .container-text {
      overflow: hidden;
      display: block;
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
        <div name="title" style="font-size: 30px;">Edit Details</div>
      </div>
    </nav>


    <div>
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          // Access individual fields by column name
          $pid = $row["Project_ID"];
          $title = $row["Title"];
          $Details = $row["Details"];
          $Summary = $row["Summary"];
          $Requirements = $row["Requirements"];
          $Documents = $row["Documents"];
          $cost = $row["Cost"];
          $estimated_completion = $row["Estimated_Completion"];
          $startedDate = $row["Started_Date"];
      ?>
          <form class="container" action="./php/Save_Project_Details.php" method="post">
            <input name="pid" type="hidden" value="<?php echo $pid ?>">
            <label class="container-subhead">Title - </label>
            <input type="text" value="<?php echo $title ?>" name="Title" placeholder="Enter Name" class="custom-textfield">
            <br>

            <label class="container-subhead" style="margin-bottom: 10px;">Summary - </label>
            <textarea rows="10" cols="40" name="Summary" class="custom-textarea"><?php echo $Summary; ?></textarea>
            <br>

            <label class="container-subhead" style="margin-bottom: 10px;">Details - </label>
            <textarea value="" name="Details" class="custom-textarea" placeholder="Enter detailed description of your project..."><?php echo $Details ?></textarea>
            <br>

            <label class="container-subhead" style="margin-bottom: 10px;">Requirements - </label>
            <textarea value="<?php echo $Requirements ?>" name="Requirements" class="custom-textarea" placeholder="Enter requirements of your project..."><?php echo $Requirements ?></textarea>
            <br>
            <br>

            <label class="container-subhead" style="margin-bottom: 10px;">Documents - </label>
            <div class="wrapper">
              <div class="container-row">
                <label class="-head"><span class="small-logo">
                    <img src="img\pdf.svg" alt="pdf_logo" style="width: 30px;">
                  </span>Documentation</label>
                <input type="text" value="<?php echo $Documents ?>" style="display:block" name="Documents" id="document">
              </div>

            </div>
    </div>

    <!-- You can add file input here for uploading documents if needed -->


    <br>

    <style>
      * {
        box-sizing: border-box;
      }

      /* The actual timeline (the vertical ruler) */
      .timeline {
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
      }

      /* The actual timeline (the vertical ruler) */
      .timeline::after {
        content: '';
        position: absolute;
        width: 6px;
        background-color: white;
        top: 0;
        bottom: 0;
        left: 50%;
        margin-left: -3px;
      }

      /* timline-container around content */
      .timline-container {
        padding: 10px 50px;
        position: relative;
        background-color: inherit;
        width: 50%;
      }

      .timline-container-ongoing {
        padding: 10px 50px;
        position: relative;
        background-color: inherit;
        width: 50%;
      }

      .timline-container-complete {
        padding: 10px 50px;
        position: relative;
        background-color: inherit;
        width: 50%;
      }

      .timline-container-due {
        padding: 10px 50px;
        position: relative;
        background-color: inherit;
        width: 50%;
      }

      /* The circles on the timeline */
      .timline-container::after {
        content: '';
        position: absolute;
        width: 25px;
        height: 25px;
        right: -17px;
        background-color: yellow;
        border: 4px solid yellow;
        top: 15px;
        border-radius: 50%;
        z-index: 1;
      }

      .timline-container-ongoing::after {
        content: '';
        position: absolute;
        width: 25px;
        height: 25px;
        right: -17px;
        background-color: burlywood;
        border: 4px solid burlywood;
        top: 15px;
        border-radius: 50%;
        z-index: 1;
      }

      .timline-container-due::after {
        content: '';
        position: absolute;
        width: 25px;
        height: 25px;
        right: -17px;
        background-color: red;
        border: 4px solid red;
        top: 15px;
        border-radius: 50%;
        z-index: 1;
      }

      .timline-container-complete::after {
        content: '';
        position: absolute;
        width: 25px;
        height: 25px;
        right: -17px;
        background-color: green;
        border: 4px solid green;
        top: 15px;
        border-radius: 50%;
        z-index: 1;
      }

      /* Place the timline-container to the left */
      .left {
        left: 0;
      }

      /* Place the timline-container to the right */
      .right {
        left: 50%;
      }

      /* Add arrows to the left timline-container (pointing right) */
      .left::before {
        content: " ";
        height: 0;
        position: absolute;
        top: 22px;
        width: 0;
        z-index: 1;
        right: 30px;
        border: medium solid white;
        border-width: 10px 0 10px 10px;
        border-color: transparent transparent transparent white;
      }

      /* Add arrows to the right timline-container (pointing left) */
      .right::before {
        content: " ";
        height: 0;
        position: absolute;
        top: 22px;
        width: 0;
        z-index: 1;
        left: 30px;
        border: medium solid white;
        border-width: 10px 10px 10px 0;
        border-color: transparent white transparent transparent;
      }

      /* Fix the circle for timline-containers on the right side */
      .right::after {
        left: -16px;
      }

      /* The actual content */
      .content {
        padding: 20px 30px;
        background-color: white;
        position: relative;
        border-radius: 6px;
      }

      /* Media queries - Responsive timeline on screens less than 600px wide */
      @media screen and (max-width: 600px) {

        /* Place the timelime to the left */
        .timeline::after {
          left: 31px;
        }

        /* Full-width timline-containers */
        .timline-container {
          width: 100%;
          padding-left: 70px;
          padding-right: 25px;
        }

        /* Make sure that all arrows are pointing leftwards */
        .timline-container::before {
          left: 60px;
          border: medium solid white;
          border-width: 10px 10px 10px 0;
          border-color: transparent white transparent transparent;
        }

        /* Make sure all circles are at the same spot */
        .left::after,
        .right::after {
          left: 15px;
        }

        /* Make all right timline-containers behave like the left ones */
        .right {
          left: 0%;
        }
      }
    </style>
    <label class="container-subhead">Milestones:-</label>

    <div class="timeline">

      <?php
          $serializedDataFromDatabase = $row['Milestones'];
          $serializedDataFromDatabase_status = $row['Milestones_status'];
          $serializedDataFromDatabase_dates = $row['Milestones_dates'];
          $milestones = unserialize($serializedDataFromDatabase);
          $milestones_status = unserialize($serializedDataFromDatabase_status);
          $milestones_dates = unserialize($serializedDataFromDatabase_dates);
          for ($i = 0; $i < count($milestones); $i++) {
            $currentDate = date("Y-m-d");

            if (!($milestones_dates[$i] >= $currentDate)) {
              $milestones_status[$i] = "due";
            }
            echo '<input id="h' . $i . '" type="hidden" name="milestone_status[]" value="' . $milestones_status[$i] . '">';
            if ($milestones_status[$i] == "complete") {
              echo '<div onclick="milestoneUpdate(this,`' . $milestones_status[$i] .  '`,' . $i . ')" name="complete" class="timline-container-complete left" >';
            } elseif ($milestones_status[$i] == "due") {
              echo '<div onclick="milestoneUpdate(this,`' . $milestones_status[$i] .  '`,' . $i . ')" name="due" class="timline-container-due left">';
              // echo '<input id="h2"  type="hidden" name="milestone_status[]" value="due">';
            } elseif ($milestones_status[$i] == "ongoing") {
              echo '<div onclick="milestoneUpdate(this,`' . $milestones_status[$i] .  '`,' . $i . ')" name="ongoing" class="timline-container-ongoing left">';
              // echo '<input id="h3" type="hidden" name="milestone_status[]" value="ongoing">';
            } else {
              echo '<div onclick="milestoneUpdate(this,`' . $milestones_status[$i] .  '`,' . $i . ')" datacustomom="om" name="coming" class="timline-container left">';
              // echo '<input id="h4" type="hidden" name="milestone_status[]" value="coming">';
            }
      ?>
        <i class="fa fa-code-fork" aria-hidden="true"></i>
        <div class="content">
          <input contenteditable="true" name="milestones[]" value="<?php echo $milestones[$i] ?>">
        </div>
    </div>
  <?php
          }
  ?>
  </div>

  <br>

  <br>

  <br>
  <br>
  <!-- UPDATE button -->
  <div class="container">
    <input type="submit" value="Save" name="submit" class="edit-button">
  </div>
  </div>
  </form>
<?php
          break;
        }
      }
      $conn->close();

?>
</div>
</div>
</body>
<script>
  function milestoneUpdate(obj, status, num) {
    console.log(obj, num);
    let field = document.getElementById(`h${num}`);

    if (field.value === "complete") {
      alert("Cannot change");
    } else if (field.value === "due") {
      obj.className = "timline-container-complete";
      field.value = "complete";
    } else if (field.value == "ongoing") {
      obj.className = "timline-container-complete";
      field.value = "complete";
    } else {
      obj.className = "timline-container-ongoing";
      field.value = "ongoing";

    }
  }
</script>

</html>