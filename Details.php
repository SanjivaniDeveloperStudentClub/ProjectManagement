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
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
         -->
    <link rel="stylesheet" href="Styles\All.css" />
    <link rel="stylesheet" href="Styles\Typography.css" />
    <title>Project Details</title>
<style>.container-subhead p{
    overflow: hidden;
}
.container-text{
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

            <!-- <div class="project-progressbar">
=======
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

        <!-- <div class="project-progressbar">
>>>>>>> 1ce98e610d5d17b7f04d8d40bc0eea3f5416caad
            <div class="project-progressbar-title blue">Submitted</div>
            <div class="line blue"></div>

            <div class="project-progressbar-title blue">HOD</div>
            <div class="line"></div>

            <div class="project-progressbar-title">Principal</div>
            <div class="line"></div>

            <div class="project-progressbar-title">Sancation</div>

        </div> -->


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

            <label class="container-subhead" style="margin-bottom: 10px;">Documents - </label>

            <div class="wrapper">
               <?php echo'<a href='.$Documents.' target="_pdf" class="container-row">
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
                        <?php echo $title?>
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
                            <p class="container-body"> <?php echo $startedDate?></p>
                        </h3>
                    </div>
                    <div class="container-row space">

                        <h3>
                            <p class="container-body">Estimated completion -</p>
                        </h3>
                        <h3>
                            <p class="container-body"> <?php echo $estimated_completion?></p>
                        </h3>
                    </div>
                    <div class="container-row space">

                        <h3>
                            <p class="container-body">Cost -</p>
                        </h3>
                        <h3>
                            <p class="container-body"> <?php echo " $cost ₹"?></p>
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
                <!-- <div class="track">
                <h3><p class="container-subhead">Principal, Polytechnic</p></h3>
            </div> -->
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
            }}
        ?>
    </div>
</body>

</html>