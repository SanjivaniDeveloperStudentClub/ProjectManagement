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
echo  $conn->error;
$username;
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
         -->
  <link rel="stylesheet" href="Styles\All.css" />
  <link rel="stylesheet" href="Styles\Typography.css" />
  <title>Project Details</title>
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
  <div>
    <?php
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        // Access individual fields by column name
        $title = $row["Title"];
        $Details = $row["Details"];
        $Summary = $row["Summary"];
        $Requirements = $row["Requirements"];
        $Documents = $row["Documents"];
        $cost = $row["Cost"];
        $estimated_completion = $row["Estimated_Completion"];
        $startedDate = $row["Started_Date"];
    ?>
        <div class="container">
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
          <label class="container-subhead">Title:</label>


          <div class="wrapper">
            <p class="container-text" style="margin-top: 0px;">
              <?php echo $title ?>
            </p>
          </div>
          <label class="container-subhead">Summary:</label>
          <div class="wrapper">
            <p class="container-text" style="margin-top: 0px;">
              <?php echo $Summary ?>
            </p>
          </div>

          <br>

          <label class="container-subhead">Description -</label>

          <div class="wrapper">
            <p class="container-text" style="margin-top: 0px;">
              <?php echo $Details ?>
            </p>
          </div>

          <br>

          <label class="container-subhead">Requirements -</label>

          <div class="wrapper">
            <p class="container-text" style="margin-top: 0px;">
              <?php echo $Requirements ?>
            </p>
          </div>

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
              echo $milestones_status[$i];
              if (!($milestones_dates[$i] < $currentDate && $milestones_status[$i]) != "complete") {
                $milestones_status[$i] = "due";
              }
              echo '<input id="h' . $i . '" type="hidden" name="milestone_status[]" value="' . $milestones_status[$i] . '">';
              if ($milestones_status[$i] == "complete") {
                echo '<div name="complete" class="timline-container-complete left" >';
              } elseif ($milestones_status[$i] == "due") {
                echo '<div name="due" class="timline-container-due left">';
                // echo '<input id="h2"  type="hidden" name="milestone_status[]" value="due">';
              } elseif ($milestones_status[$i] == "ongoing") {
                echo '<div  name="ongoing" class="timline-container-ongoing left">';
                // echo '<input id="h3" type="hidden" name="milestone_status[]" value="ongoing">';
              } else {
                echo '<div  datacustomom="om" name="coming" class="timline-container left">';
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
        <label class="container-subhead" style="margin-bottom: 10px;">Documents - </label>

        <div class="wrapper">
          <?php echo '<a href=' . $Documents . ' target="_pdf" class="container-row">
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
                </a>';
          ?>
        </div>

        <br>

        <label class="container-subhead">Requirements -</label>

        <div class="wrapper">
          <div class="container-row">
            <div class="small-logo">
              <img src="images/dcslogo.png" alt="dsc_logo" class="container-img">
            </div>
            <div class="clientname" style="margin-bottom: 10px;">
              <p class="container-subhead">Developer Students Club</p>
            </div>
          </div>
          <div class="track">
            <h3>
              <p style="overflow: hidden;" class="container-subhead">
                <?php echo $title ?>
              </p>
            </h3>
          </div>
          <div class="track">
            <div class="container-row space">

              <h3>
                <p class="container-body">Status -</p>
              </h3>
              <h3>
                <p class="container-body">On-Going</p>
              </h3>
            </div>
            <div class="container-row space">

              <h3>
                <p class="container-body">Started on -</p>
              </h3>
              <h3>
                <p class="container-body"> <?php echo $startedDate ?></p>
              </h3>
            </div>
            <div class="container-row space">

              <h3>
                <p class="container-body">Estimated completion -</p>
              </h3>
              <h3>
                <p class="container-body"> <?php echo $estimated_completion ?></p>
              </h3>
            </div>
            <div class="container-row space">

              <h3>
                <p class="container-body">Cost -</p>
              </h3>
              <h3>
                <p class="container-body"> <?php echo " $cost ₹" ?></p>
              </h3>
            </div>


          </div>
        </div>

        <br>

        <label class="container-subhead">Suggestions -</label>

        <!-- Staff Overview Container -->
        <div class="wrapper">
          <div class="container-row">
            <div class="small-logo">
              <img src="images/Mirikar-sir.png" alt="dsc_logo" class="container-img" style="margin-right: 20px;">
            </div>
            <div class="row">
              <!-- <div class="clientname"> -->
              <p class="container-subhead">Mr. A. R. Mirikar</p>
              <p class="container-subhead">Principal, Polytechnic</p>
              <!-- </div> -->

            </div>
          </div>
          <div class="container-text">
            Upon successful development, the platform will be deployed on reliable cloud infrastructure, and
            post-launch support and maintenance services will be provided to ensure smooth operation and address any
            issues that may arise.
          </div>
        </div>

        <br>
        <br>

  </div>
<?php
        break;
      }
    }
    $conn->close();

?>
</div>
</body>

</html>