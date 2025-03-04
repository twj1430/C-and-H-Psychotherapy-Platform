<?php
$generate_id = uniqid();
include("sessionTop.php");

$_SESSION['change_id'] = "";
$_SESSION['choice_gender'] = '';
$_SESSION['choice_age'] = '';
$_SESSION['choice_lan'] = '';
$_SESSION['generate_id'] = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $_SESSION['current_id'] = $id;
    $sql = "select * from services where id='$id'";
    $result = $conn->query($sql) or die($conn->error . __LINE__);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['specialty_name'] = $row['name'];
        }
    }
    $_SESSION['rec_work_id'] = $_GET['id'];
} else if (isset($_SESSION['current_id']) && (!empty($_SESSION['current_id']))) {
    $_SESSION['current_id'] = '';
} else if (isset($_SESSION['current_id']) && (empty($_SESSION['current_id']))) {
    echo '<script>window.alert("You cannot direct access this page..!");window.location.assign("help.php")</script>';
} else {
    echo '<script>window.alert("You cannot direct access this page..!");window.location.assign("help.php")</script>';
}

if (isset($_POST['continue'])) {

    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $language = $_POST['language'];

    $email = $_SESSION['client_email'];
    $_SESSION['directRec'] = "Yes";
    $_SESSION['generate_id'] = $generate_id;

    $check = "SELECT * FROM appointment where user_Email ='" . $_SESSION['client_email'] . "'";
    $checking = $conn->query($check) or die($conn->error . __LINE__);

    if ($checking->num_rows > 0) {
        echo '<script>window.alert("You must complete the current consultation first...!");window.location.assign("help.php")</script>';
    } else {
        $sql = "INSERT into user_choices values('','$generate_id','2','$gender','$email')";
        $result = $conn->query($sql) or die($conn->error . __LINE__);

        $sqli = "INSERT into user_choices values('','$generate_id','3','$age','$email')";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        $sq = "INSERT into user_choices values('','$generate_id','31','$language','$email')";
        $result2 = $conn->query($sq) or die($conn->error . __LINE__);

        echo '<script>window.location.assign("showResult.php")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="images/Logo.jpg" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C&H</title>

    <style>
        body {
            background: rgb(245, 245, 245) !important;
            padding-top: 100px;
        }
    </style>
</head>

<header>
    <?php include("header1.php") ?>
</header>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="text-align:center">

                <h5 class="modal-title" id="exampleModalLabel">Do you want to answer the questions to help the therapist know your situation better?</h5>
                <a href="question.php?id=<?php echo $_GET['id'] ?>" class="btn btn-outline-success mx-3 my-5" style="display:inline-block">Yes</a>
                <button class="btn btn-outline-danger" id="direct" name="direct" style="display:inline-block" data-toggle="modal" data-target="#checkDirect">No, direct match with a suitable therapist</button>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="checkDirect" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">You need to answer some questions first so that we can help you to match a suitable therapist</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="checkDirect.php" method="post" enctype="multipart/form-data" id="Direct">
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="col">
                                    <h5 style="color:rgb(34, 19, 48)">Do you prefer to work with a male or female counselor?</h5>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="5" name="gender" class="custom-control-input" value="5" required>
                                        <label class="custom-control-label" for="5">I prefer a male therapist</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="6" name="gender" class="custom-control-input" value="6" required>
                                        <label class="custom-control-label" for="6">I prefer a female therapist</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="7" name="gender" class="custom-control-input" value="7" required>
                                        <label class="custom-control-label" for="7">I don't care</label>
                                    </div>
                                    <hr>
                                </div>

                                <div class="col">
                                    <h5 style="color:rgb(34, 19, 48)">Do you prefer to work with a younger or older counselor?</h5>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="8" name="age" class="custom-control-input" value="8" required>
                                        <label class="custom-control-label" for="8">I prefer a younger counselor(22 above)</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="9" name="age" class="custom-control-input" value="9" required>
                                        <label class="custom-control-label" for="9">I prefer an older counselor (45 above)</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="10" name="age" class="custom-control-input" value="10" required>
                                        <label class="custom-control-label" for="10">I don't care</label>
                                    </div>
                                    <hr>
                                </div>

                                <div class="col">
                                    <h5 style="color:rgb(34, 19, 48)">What is your preferred language?</h5>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="98" name="language" class="custom-control-input" value="98" required>
                                        <label class="custom-control-label" for="98">English</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="99" name="language" class="custom-control-input" value="99" required>
                                        <label class="custom-control-label" for="99">Malay</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="100" name="language" class="custom-control-input" value="100" required>
                                        <label class="custom-control-label" for="100">Chinese</label>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit" id="continue" name="continue">Continue</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>