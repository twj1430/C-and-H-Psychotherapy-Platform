<?php
include("sessionTop.php");
$generateID = uniqid();

$checkAppointment = "SELECT * from appointment where user_Email = '" . $_SESSION['client_email'] . "' and (appointment_status='1' or appointment_status='2' or appointment_status='5')";
$check = $conn->query($checkAppointment) or die($conn->error . __LINE__);

$count = mysqli_num_rows($check);

//if user get started the question
if (isset($_GET['id']) && isset($_SESSION['client_id']) && ($count == 0)) {
    $_SESSION['rec_work_id'] = $_GET['id'];
    $_SESSION['work_id'] = '';
    $_SESSION['generate_id'] = $generateID;
    $_SESSION['work_thera_name'] = '';
    $_SESSION['work_thera_profile_image'] = '';

    $sql = "SELECT * FROM services where id='" . $_GET['id'] . "'";
    $run = $conn->query($sql) or die($conn->error . __LINE__);

    if ($run->num_rows > 0) {
        while ($row = $run->fetch_assoc()) {
            $name = $row['name'];
            $_SESSION['specialty_name'] = $name;
        }
        $msg = "<div class='alert alert-success'><center><h5><strong>We heard you'd like help with</strong>: " . $name . "</h5></center></div>";
    }
} else if (isset($_GET['work_id']) && isset($_SESSION['client_id']) && ($count == 0)) {

    $_SESSION['work_id'] = $_GET['work_id'];
    $_SESSION['rec_work_id'] = '';
    $_SESSION['generate_id'] = $generateID;

    $sql = "SELECT * FROM therapist where therapist_id='" . $_SESSION['work_id'] . "'";
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['work_thera_name'] = $row['name_first'] . " " . $row['name_last'];
            $_SESSION['work_thera_profile_image'] = $row['profile_image'];
        }
    }

    $msg = "<div class='alert alert-success'><center><h4>Help <strong>" . $_SESSION['work_thera_name'] . "</strong> get to know you better</h4></center></div>";
} else if (!isset($_SESSION['client_id'])) { //if user dosen't log in
    echo '<script>window.alert("You must login first!");window.location.assign("login.php")</script>';
} else if ((((!isset($_GET['id'])) && (!isset($_GET['work_id']))) && ((empty($_SESSION['rec_work_id'])) && (empty($_SESSION['work_id'])))) && (isset($_SESSION['client_id']))) { // if user already log in but directly access this page
    echo '<script>window.alert("You cannot directly access this page...!");window.location.assign("help.php")</script>';
} else if ($count > 0) {
    // if user already make the appointment and the status are pending, accept or In consultation
    echo '<script>window.alert("You must complete the current consultation first...!");window.location.assign("help.php")</script>';
}



if (isset($_POST['finish'])) { //if finish the recommendation question
    $total = 1;
    foreach ($_REQUEST['allChoices'] as $choice) {
        $email = $_SESSION['client_email'];
        $sql = "INSERT into user_choices values('','" . $_SESSION['generate_id'] . "','$total','$choice','$email')";
        $result = $conn->query($sql) or die($conn->error . __LINE__);
        $total++;
    }
    echo '<script>window.location.assign("showResult.php");</script>';
}

if (isset($_POST['finish1'])) { //if finish without the recommendation question
    $total = 1;
    foreach ($_REQUEST['allChoices'] as $choice) {
        if ($total == 3) {
            $total = 5;
        }

        $email = $_SESSION['client_email'];
        $sql = "INSERT into user_choices values('','" . $_SESSION['generate_id'] . "','$total','$choice','$email')";
        $result = $conn->query($sql) or die($conn->error . __LINE__);
        $total++;
    }
    echo '<script>window.location.assign("Appointment.php");</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="images/Logo.jpg" type="image/x-icon" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C&H</title>
    <link rel="stylesheet" type="text/css" href="css/question.css">
    <style>
        body {
            background: url("images/question.jpg");
            padding-top: 59px;
            padding-bottom: 150px;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        strong {
            color: black;
        }
    </style>
</head>
<header>
    <?php include("header1.php") ?>
</header>

<section id="Question">

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12" align="center">
                    <h2>Affordable, private online counseling in Anytime,Anywhere.</h2>

                    <p>Contact with a licensed, professional therapist online.</p>

                    <p>We will matched you to a suitable therapist.Get feedback, advice and guidance from your therapist!</p>
                </div>
            </div>

            <div class="col-md-12" style="padding:0 0 0 0">
                <?php if (isset($_GET['work_id']) || isset($_GET['id'])) {
                    echo $msg;
                }
                ?>
            </div>

            <div class="row">
                <div class="col-md-6  question-form">
                    <form action="question.php" method="POST" enctype="multipart/form-data">
                        <h3>Answer the questions and get matched a suitable therapist!</h3>
                        <hr>
                        <p id="over">Over the past 2 weeks, how often have you bothered by any of the following problems: </p>
                        <center>
                            <h4 class="question-text" id="complete" style="display:none;"><strong>You've completed the questionnaire!</strong></h4>
                        </center>
                        <!-- Show the question -->
                        <?php
                        $sql = "SELECT * FROM questions";
                        $result = $conn->query($sql) or die($conn->error . __LINE__);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $question_number = $row['question_number'];
                                $question_text = $row['question_text'];
                        ?>
                                <?php
                                if ($question_number == "1") {
                                    echo "<h4 class='question-text question$question_number'>$question_text</h4>";
                                } else {
                                    echo "<h4 class='question-text question$question_number' style='display:none'>$question_text</h4>";
                                }
                                ?>
                        <?php
                            }
                        }
                        ?>
                        <hr>
                        <div id="showChoices">
                            <ul class="choices" id="choices">
                                <!-- If the choices belongs to this question -->
                                <?php
                                $sql = "SELECT * FROM choices";
                                $result = $conn->query($sql) or die($conn->error . __LINE__);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $quesNum = 0;
                                        $choice_id = $row['choice_id'];
                                        $question_number = $row['question_number'];
                                        $text = $row['text'];
                                ?>
                                        <?php
                                        if ($question_number == "1") {
                                            echo "<li class='choice$question_number' value='$choice_id'>
                                                        <div class='custom-control custom-radio' id='allChoice'>
                                                            <input type='radio' class='custom-control-input' name='choice' id='" . $choice_id . "' value='" . $choice_id . "'>
                                                            <label class='custom-control-label' for='" . $choice_id . "'><strong><span>$text</span></strong></label>
                                                        </div>
                                                        
                                                        <div class='form-check form-check-inline' style='display:none;'>
                                                            <input class='form-check-input' type='checkbox' id='check$choice_id' name='allChoices[]' value='$choice_id'>
                                                            <label class='form-check-label' for='check$choice_id'>$choice_id</label>
                                                        </div>
                                                    </li>";
                                        } else {
                                            echo "<li class='choice$question_number' style='display:none' value='$choice_id'>
                                                        <div class='custom-control custom-radio' id='allChoice'>
                                                            <input type='radio' class='custom-control-input' name='choice' id='" . $choice_id . "' value='" . $choice_id . "' >
                                                            <label class='custom-control-label' for='" . $choice_id . "'><strong><span>$text</span></strong></label>
                                                        </div>

                                                        <div class='form-check form-check-inline' style='display:none;'>
                                                            <input class='form-check-input' type='checkbox' id='check$choice_id' name='allChoices[]' value='$choice_id'>
                                                            <label class='form-check-label' for='check$choice_id'>$choice_id</label>
                                                        </div>
                                                    </li>";
                                        }
                                        ?>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                            <?php
                            if ((isset($_GET['id']) || (!empty($_SESSION['rec_work_id']))) && isset($_SESSION['client_id'])) {
                                echo "<input type='submit' value='Finish' name='finish' id='finish' class='btn btn-outline-success' style='display:none'>";
                                echo "<input type='hidden' id='theraCheck' data-value='1'>";
                            } else {
                                echo "<input type='submit' value='Finish' name='finish1' id='finish1' class='btn btn-outline-success' style='display:none'>";
                                echo "<input type='hidden' id='theraCheck' data-value='2'>";
                            }
                            ?>
                        </div>
                    </form>
                </div>

                <div class="col-md-5 offset-md-1 col-sm-12 question-side">
                    <div class="row">
                        <?php
                        if (isset($_GET['work_id'])) {
                        ?>
                            <div class="col-md-12" style="text-align: center;padding-top:20px">
                                <img src="./images/therapists/<?php echo $_SESSION['work_thera_profile_image'] ?>" alt="image" name="image" id="image">
                                <h3><?php echo $_SESSION['work_thera_name'] ?></h3>
                                <h3>(PsyD)</h3>
                            <?php } else {
                            ?>
                                <div class="col-md-12" id="right-side" style="text-align: center;height:420px;">
                                    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" style="margin-top:15px;">
                                        <ol class="carousel-indicators">
                                            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                                            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                                            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                                        </ol>
                                        <div class="carousel-inner" id="recommendation">
                                            <div class="carousel-item active">
                                                <img src="images/therapists/hair (3).png" class="d-block" alt="image" align="center">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h4 style="padding-bottom:10px;color:white">Latest review for : <br>Kan Kiat Teck</h4>
                                                    <h6 style="padding-bottom:30px;color:white;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iste labore ipsum soluta exercitationem consectetur iusto. Nobis omnis iste maxime odit delectus, quasi officia optio, nulla quos tempora pariatur, perferendis modi?</h6>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <img src="images/therapists/hair (3).png" class="d-block " alt="...">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h4 style="padding-bottom:10px;color:white">Latest review for : <br>Kan Kiat Teck</h4>
                                                    <h6 style="padding-bottom:30px;color:white;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iste labore ipsum soluta exercitationem consectetur iusto. Nobis omnis iste maxime odit delectus, quasi officia optio, nulla quos tempora pariatur, perferendis modi?</h6>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <img src="images/therapists/hair (3).png" class="d-block" alt="...">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h4 style="padding-bottom:10px;color:white">Latest review for : <br>Kan Kiat Teck</h4>
                                                    <h6 style="padding-bottom:30px;color:white;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iste labore ipsum soluta exercitationem consectetur iusto. Nobis omnis iste maxime odit delectus, quasi officia optio, nulla quos tempora pariatur, perferendis modi?</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                <?php
                            }
                                ?>
                                </div>
                            </div>

                    </div>

                </div>
            </div>
    </body>
    <script src="js/main.js" type="text/javascript"></script>
</section>

</html>