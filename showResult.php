<?php
include("sessionTop.php");
$generate_id = uniqid();

if (((empty($_SESSION['choice_gender'])) || (!isset($_SESSION['choice_gender']))) && ((empty($_SESSION['choice_age'])) || (!isset($_SESSION['choice_age']))) && ((empty($_SESSION['choice_lan'])) || (!isset($_SESSION['choice_lan']))) && (empty($_SESSION['generate_id']) || (!isset($_SESSION['generate_id']))) && (isset($_SESSION['client_id'])) && (!isset($_SESSION['change_id']))) {
    echo '<script>window.alert("You cannot direct access this page..!");window.location.assign("Home.php")</script>';
    $_SESSION['generate_id'] = '';
    $_SESSION['user_email'] = '';
} else if ((!empty($_SESSION['generate_id']) && (isset($_SESSION['generate_id']))) && ((empty($_SESSION['choice_gender'])) || (!isset($_SESSION['choice_gender']))) && ((empty($_SESSION['choice_age'])) || (!isset($_SESSION['choice_age']))) && ((empty($_SESSION['choice_lan'])) || (!isset($_SESSION['choice_lan']))) && isset($_SESSION['client_id']) && (!isset($_SESSION['change_id']) || (empty($_SESSION['change_id'])))) {
    $email = $_SESSION['client_email'];
    $query = "select * from user_choices where user_email='$email'";
    $choices = $conn->query($query) or die($conn->error . __LINE__);

    if ($choices->num_rows > 0) {
        while ($row = $choices->fetch_assoc()) {
            $_SESSION['generate_id'] = $row['selectID'];
            $choice1 = $row['choice_ID'];
            $_SESSION['user_email'] = $row['user_email'];
            switch ($choice1) {
                case 5:
                case 6:
                case 7:
                    $_SESSION['choice_gender'] = $choice1; //get gender choice
                    break;

                case 8:
                case 9:
                case 10:
                    $_SESSION['choice_age'] = $choice1; //get age choice
                    break;

                case 98:
                case 99:
                case 100:
                    $_SESSION['choice_lan'] = $choice1; //get language choice
                    break;
            }
        }
    }
} else if ((isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) && isset($_SESSION['client_id'])) {
    $_SESSION['generate_id'] = $_SESSION['change_id'];
    $query = "select * from user_choices left join appointment on user_choices.selectID=appointment.appointment_id where selectID='" . $_SESSION['generate_id'] . "'";
    $choices = $conn->query($query) or die($conn->error . __LINE__);

    if ($choices->num_rows > 0) {
        while ($row = $choices->fetch_assoc()) {
            $_SESSION['change_therapist'] = $row['therapist_ID'];
            $_SESSION['generate_id'] = $row['selectID'];
            $_SESSION['specialty_name'] = $row['specialty_name'];
            $choice1 = $row['choice_ID'];
            $_SESSION['user_email'] = $row['user_email'];
            switch ($choice1) {
                case 5:
                case 6:
                case 7:
                    $_SESSION['choice_gender'] = $choice1; //get gender choice
                    break;

                case 8:
                case 9:
                case 10:
                    $_SESSION['choice_age'] = $choice1; //get age choice
                    break;

                case 98:
                case 99:
                case 100:
                    $_SESSION['choice_lan'] = $choice1; //get language choice
                    break;
            }
        }
    }
} else if ((!empty($_SESSION['choice_gender'])) && (!empty($_SESSION['choice_age'])) && (!empty($_SESSION['choice_lan'])) && ((empty($_SESSION['generate_id'])) || (!isset($_SESSION['generate_id']))) && isset($_SESSION['client_id'])) {
    $_SESSION['generate_id'] = $generate_id;
} else if (!isset($_SESSION['client_id'])) {
    echo '<script>window.alert("You must login first..!");window.location.assign("login.php")</script>';
}


if (isset($_POST['cancel'])) { //if user click cancel, clear all the data in database where the generate_id=this.generate_id
    $generate = $_SESSION['generate_id'];

    $sql = "SELECT * FROM user_choices where selectID='$generate'";
    $run = $conn->query($sql) or die($conn->error . __LINE__);

    if ($run->num_rows > 0) {
        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        $_SESSION['rec_work_id'] = '';
        $_SESSION['work_id'] = '';
        echo '<script>window.location.assign("help.php");</script>';
    } else {
        $_SESSION['rec_work_id'] = '';
        $_SESSION['work_id'] = '';
        echo '<script>window.location.assign("help.php");</script>';
    }
}
?>

<head>
    <link rel="icon" href="images/Logo.jpg" type="image/x-icon" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C&H</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/question.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <style>
        body {
            background-color: rgba(210, 232, 243) !important;
        }
    </style>
</head>
<!DOCTYPE html>
<html lang="en">
<section id="showResult">

    <body>
        <h3>Answer the questions and get matched a suitable therapist!</h3>
        <hr id="ans">
        <div class="container">
            <div class="question-form">
                <h4 class="question-text"><strong>Recommendation</strong></h4>
                <hr>
                <div class="col-md-12">


                    <div class="row">
                        <?php include("ResultExtend.php") ?>

                        <div class="col-md-12">
                            <form action="showResult.php" method="POST">
                                <?php if ((isset($_SESSION['change_id']) || !isset($_SESSION['change_id'])) && empty($_SESSION['change_id'])) {
                                ?>
                                    <input type="submit" value="Cancel" name="cancel" id="cancel" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to cancel?')">
                                <?php
                                }
                                ?>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </body>
</section>

</html>