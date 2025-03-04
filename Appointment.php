<?php
include("sessionTop.php");
date_default_timezone_set('Singapore');
$generateID = uniqid();

$email = $_SESSION['client_email']; //get user email

$checkAppointment = "SELECT * from appointment where user_Email = '" . $_SESSION['client_email'] . "' and (appointment_status='1' or appointment_status='2' or appointment_status='5')";
$check = $conn->query($checkAppointment) or die($conn->error . __LINE__);

$count = mysqli_num_rows($check);

if ($count > 0) {
    // if user already make the appointment and the status are pending, accept or In consultation
    echo '<script>window.alert("You must complete the current consultation first...!");window.location.assign("help.php")</script>';
} else {
    if (isset($_GET['id'])) {
        $_SESSION['appointment_thera'] = $_GET['id'];
    } else if (isset($_SESSION['work_id']) && (!empty($_SESSION['work_id']))) {
        $_SESSION['appointment_thera'] = $_SESSION['work_id'];
    }
}


if (((isset($_SESSION['rec_work_id']) && (!empty($_SESSION['rec_work_id']))) || (isset($_SESSION['change_id']) && !empty($_SESSION['change_id'])) || (isset($_SESSION['work_id']) && (!empty($_SESSION['work_id'])))) && (isset($_SESSION['client_id'])) && (!empty($_SESSION['appointment_thera']))) {
    $therapist_id = $_SESSION['appointment_thera'];
    $sql = "SELECT * FROM therapist where therapist_id='$therapist_id'"; //id is database name
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result->num_rows > 0) { //over 1 database(record) so run
        while ($row = $result->fetch_assoc()) {
            //display result
            $_SESSION['select_id'] = $row['therapist_id']; //[] inside is follow database 
            $_SESSION['select_name_first'] = $row['name_first'];
            $_SESSION['select_name_last'] = $row['name_last'];
            $_SESSION['select_email'] = $row['email'];
            $_SESSION['select_gender'] = $row['gender'];
            $_SESSION['select_age'] = $row['age'];
            $_SESSION['select_phone'] = $row['phone'];
            $_SESSION['select_ic'] = $row['ic'];
            $_SESSION['select_address'] = $row['address'];
            $_SESSION['select_therapist_city'] = $row['therapist_city'];
            $_SESSION['select_therapist_postCode'] = $row['therapist_postCode'];
            $_SESSION['select_therapist_state'] = $row['therapist_state'];
            $_SESSION['select_education_level'] = $row['education_level'];
            $_SESSION['select_resume'] = $row['resume'];
            $_SESSION['select_profile_image'] = $row['profile_image'];
            $_SESSION['select_statusID'] = $row['statusID'];
            $_SESSION['select_created_at'] = $row['created_at'];
        }
    }
} else if (empty($_SESSION['appointment_thera']) && (isset($_SESSION['client_id']))) {
    $_SESSION['generate_id'] = '';
    $_SESSION['appointment_thera'] = '';
    $_SESSION['rec_word_id'] = '';
    $_SESSION['work_id'] = '';
    echo '<script>window.alert("You cant access this page without answer the questions....!!!!");window.location.assign("help.php")</script>';
} else if (!isset($_SESSION['client_id'])) {
    $_SESSION['generate_id'] = '';
    $_SESSION['appointment_thera'] = '';
    $_SESSION['rec_word_id'] = '';
    $_SESSION['work_id'] = '';
    echo '<script>window.alert("You must login first....!!!!");window.location.assign("login.php")</script>';
}


if (isset($_POST['upload'])) { //upload appointment
    $error = array();

    $email = validate_input_email($_POST['email']);
    if (empty($email)) {
        $error[] = "You forgot to enter your email";
    }

    $method = validate_input_text($_POST['method']);
    if (empty($method)) {
        $error[] = "You forgot to enter your method";
    }

    $date = mysqli_real_escape_string($conn, $_POST['date']);
    if (empty($date)) {
        $error[] = "You forgot to enter your date";
    }

    $therapistID = validate_input_text($_POST['therapistID']);
    if (empty($therapistID)) {
        $error[] = "You forgot to enter your therapistID";
    }

    // $session = validate_input_text($_POST['session']);
    // if (empty($session)) {
    //     $error[] = "You forgot to enter your sessionID";
    // }

    $user_time3 = strtotime($date);
    $user_time4 = date("Y-m-d", $user_time3);

    $sqli = "SELECT * FROM user_choices where selectID='" . $_SESSION['generate_id'] . "'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);

    $check = "SELECT * FROM appointment where appointment_id='" . $_SESSION['generate_id'] . "'";
    $runcheck = $conn->query($check) or die($conn->error . __LINE__);

    if (empty($error)) {
        if ((mysqli_num_rows($runcheck) > 0)) {
            $msg = "<div class='alert alert-success'>Booking Successfull,Will Go to the Home Page after 3 seconds</div>";
            header('refresh: 3; url=Home.php');
            $sql = "UPDATE appointment set user_method='$method',user_date='$user_time4',therapist_ID ='" . $_SESSION['appointment_thera'] . "', appointment_status='1' where appointment_id ='" . $_SESSION['generate_id'] . "'";
            $run = $conn->query($sql) or die($conn->error . __LINE__);
        } else {
            if (!empty($_SESSION['generate_id']) && ((!empty($_SESSION['work_id'])) || (!empty($_SESSION['rec_work_id']))) && (mysqli_num_rows($run) > 0)) {

                if ((!empty($_SESSION['rec_work_id'])) && (!empty($_SESSION['directRec'])) && (mysqli_num_rows($run) == 3)) {
                    $sql = "INSERT INTO `appointment` VALUES('" . $_SESSION['generate_id'] . "','$email','$method','$user_time4','$therapistID','" . $_SESSION['specialty_name'] . "','" . $_SESSION['client_phone'] . "',1,1,2,NOW())";
                    $result = $conn->query($sql) or die($conn->error . __LINE__);

                    if ($result == true) {
                        $msg = "<div class='alert alert-success'>Booking Successfull,Will Go to the Home Page after 3 seconds</div>";
                        header('refresh: 3; url=Home.php');
                        $_SESSION['generate_id'] = '';
                        $_SESSION['user_email'] = '';
                        $_SESSION['work_id'] = '';
                        $_SESSION['rec_work_id'] = '';
                        $_SESSION['choice_gender'] = '';
                        $_SESSION['choice_age'] = '';
                        $_SESSION['choice_lan'] = '';
                        $_SESSION['directRec'] = '';
                        $_SESSION['specialty_name'] = '';
                    }
                } else if ((!empty($_SESSION['rec_work_id'])) && (empty($_SESSION['directRec']))) {
                    $sql = "INSERT INTO `appointment` VALUES('" . $_SESSION['generate_id'] . "','$email','$method','$user_time4','$therapistID','" . $_SESSION['specialty_name'] . "','" . $_SESSION['client_phone'] . "',1,1,1,NOW())";
                    $result = $conn->query($sql) or die($conn->error . __LINE__);

                    if ($result == true) {
                        $msg = "<div class='alert alert-success'>Booking Successfull,Will Go to the Home Page after 3 seconds</div>";
                        header('refresh: 3; url=Home.php');
                        $_SESSION['generate_id'] = '';
                        $_SESSION['user_email'] = '';
                        $_SESSION['work_id'] = '';
                        $_SESSION['rec_work_id'] = '';
                        $_SESSION['choice_gender'] = '';
                        $_SESSION['choice_age'] = '';
                        $_SESSION['choice_lan'] = '';
                        $_SESSION['directRec'] = '';
                        $_SESSION['specialty_name'] = '';
                    }
                } else {
                    $sql = "INSERT INTO `appointment` VALUES('" . $_SESSION['generate_id'] . "','$email','$method','$user_time4','$therapistID','-','" . $_SESSION['client_phone'] . "',1,1,1,NOW())";
                    $result = $conn->query($sql) or die($conn->error . __LINE__);

                    if ($result == true) {

                        $msg = "<div class='alert alert-success'>Booking Successfull,Will Go to the Home Page after 3 seconds</div>";
                        header('refresh: 3; url=Home.php');
                        $_SESSION['generate_id'] = '';
                        $_SESSION['user_email'] = '';
                        $_SESSION['work_id'] = '';
                        $_SESSION['rec_work_id'] = '';
                        $_SESSION['choice_gender'] = '';
                        $_SESSION['choice_age'] = '';
                        $_SESSION['choice_lan'] = '';
                        $_SESSION['directRec'] = '';
                        $_SESSION['specialty_name'] = '';
                    }
                }
            } else {
                $sql = "INSERT INTO `appointment` VALUES('$generateID','$email','$method','$user_time4','$therapistID','-','" . $_SESSION['client_phone'] . "',1,1,2,NOW())";
                $result = $conn->query($sql) or die($conn->error . __LINE__);

                if ($result == true) {

                    $msg = "<div class='alert alert-success'>Booking Successfull,Will Go to the Home Page after 3 seconds</div>";
                    header('refresh: 3; url=Home.php');
                    $_SESSION['generate_id'] = '';
                    $_SESSION['user_email'] = '';
                    $_SESSION['work_id'] = '';
                    $_SESSION['rec_work_id'] = '';
                    $_SESSION['choice_gender'] = '';
                    $_SESSION['choice_age'] = '';
                    $_SESSION['choice_lan'] = '';
                    $_SESSION['directRec'] = '';
                    $_SESSION['specialty_name'] = '';
                }
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'>Something error, Please Try Again!</div>";
    }
}

function build_calendar($month, $year)
{
    $servername = "localhost"; //localhost for local PC or use IP address
    $username = "root"; //database name
    $password = ""; //database password
    $database = "oncoun"; //database name

    // Create connection #scawx
    $conn = new mysqli($servername, $username, $password, $database);

    $sql = "SELECT * FROM appointment where therapist_ID='" . $_SESSION['appointment_thera'] . "'";

    //display all the appointment
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    //First of all we'll create an array containing names of all days in a week
    $daysOfWeek = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');

    //Then we'll get the first day of the month that is in the argument of this function
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    //Now getting the number of days in a month
    $numberDays = date('t', $firstDayOfMonth);

    //Getting some information about the first day of this month
    $dateComponents = getdate($firstDayOfMonth);

    //Getting the name of this month
    $monthName = $dateComponents['month'];

    //Getting the index value 0-6 of the first day of this month
    $dayOfWeek = $dateComponents['wday'];


    //Now creating the HTML table
    $calendar = "<table class='table table-bordered'>";
    $calendar .= "<center><h2>$monthName $year</h2>";
    $calendar .= "<a class='btn btn-xs btn-danger' href='?month=" . date('m', mktime(0, 0, 0, $month - 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month - 1, 1, $year)) . "' id='Previous'>Previous Month</a> ";

    $calendar .= "<a class='btn btn-xs btn-primary' href='?month=" . date('m') . "&year=" . date('Y') . "'>Current Month</a> ";

    $calendar .= "<a class='btn btn-xs btn-success' href='?month=" . date('m', mktime(0, 0, 0, $month + 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month + 1, 1, $year)) . "'>Next Month</a></center><br>";


    $calendar .= "<thead><tr>";

    //Creating the calendar headers
    foreach ($daysOfWeek as $day) {
        $calendar .= "<th class='header'>$day</th>";
    }

    $bookings = array();
    $calendar .= "</tr></thead><tbody><tr>";
    if ($result->num_rows > 0) { //over 1 database(record) so run
        while ($row = $result->fetch_assoc()) {
            $bookings[] = $row['user_date'];
        }
    }

    //The variable $dayOfWeek will make sure that there must be only 7 columns

    if ($dayOfWeek > 0) {
        for ($k = 0; $k < $dayOfWeek; $k++) {
            $calendar .= "<td></td>";
        }
    }

    //initiating the day counter
    $currentDay = 1;

    //Getting the month number
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);


    //Getting the current date
    $dateToday = date('Y-m-d');

    $getdateToday = date('Y-m-d', strtotime($dateToday));


    while ($currentDay <= $numberDays) {
        //if seventh column (saturday) reached,start a new row
        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }

        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";

        if ($date <= $getdateToday) {
            $calendar .= "<td><h5>$currentDay</h5><button class='btn btn-danger btn-xs booking' disabled>Book</button>";
        } else if (in_array($date, $bookings)) {
            $calendar .= "<td><h5>$currentDay</h5><button class='btn btn-danger booking' disabled>Already Booked</button>";
        } else {
            $calendar .= "<td><h5>$currentDay</h5><button class='btn btn-success btn-xs booking book' data-toggle='modal'  data-target='#dateModal' data-dateslot='$year-$month-$currentDay'>Book</button>";
        }

        $calendar .= "</td>";

        //Incrementing the counters
        $currentDay++;
        $dayOfWeek++;
    }



    //Compeleting the row of the last week in month,if necessary
    if ($dayOfWeek != 7) {
        $remainingDays = 7 - $dayOfWeek;
        for ($i = 0; $i < $remainingDays; $i++) {
            $calendar .= "<td></td>";
        }
    }

    $calendar .= "</tr></tbody>";
    $calendar .= "</table>";

    echo $calendar;
}
?>


<html lang="en">

<head>
    <link rel="icon" href="images/Logo.jpg" type="image/x-icon" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <title>C&H</title>
    <link rel="stylesheet" type="text/css" href="css/appointment.css">
    <style>
        table {
            table-layout: fixed;
            background-color: white;
        }

        tbody {
            color: rgb(133, 133, 133);
        }

        .booking {
            font-size: 15px !important;
            padding: 5px 5px !important;

        }

        table td {
            padding: 5px 0 5px 5px !important;

        }
    </style>
</head>

<header>
    <?php require_once("header1.php") ?>
</header>
<section id=appointment>

    <body>

        <div class="container" id="appointment-wholePage">
            <section class="form pt-5 pb-5">

                <!-- Appointment Form -->
                <div class="container">
                    <div class="row" style="margin-top:30px;">

                        <div class="col-md-12">
                            <?php if (isset($_POST['upload'])) {
                                echo $msg;
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 style="color:white">Appointment</h1>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10 offset-md-1 bg-white my-0">
                                    <?php
                                    $dateComponents = getdate();
                                    if (isset($_GET['month']) && isset($_GET['year'])) {
                                        $month = $_GET['month'];
                                        $year = $_GET['year'];
                                    } else {
                                        $month = $dateComponents['mon'];
                                        $year = $dateComponents['year'];
                                    }
                                    echo build_calendar($month, $year);
                                    ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="offset-md-1 col-md-10 my-4">
                                    <h5 style="color:white">Therapist</h5>
                                    <div class="row" style="padding:20px;border:1px solid white;">
                                        <div class="col-md-6" align="center">
                                            <img src="./images/therapists/<?php echo $_SESSION['select_profile_image'] ?>" alt="img">
                                        </div>

                                        <div class="col-md-6">
                                            <h3 class="therapist_name"><?php
                                                                        echo $_SESSION['select_name_first'] . "&nbsp;" . $_SESSION['select_name_last'];
                                                                        ?></h3>
                                            <h3 class="therapist_license"><?php
                                                                            echo $_SESSION['select_education_level'];
                                                                            ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end Appointment Form -->

        </div>
        <div class="modal fade" id="dateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLongTitle">Booking for: <span id="slot"></span></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="Appointment.php" method="POST" enctype="multipart/form-data" class="validation" novalidate>
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="text" readonly name="date" id="dateslot" class="form-control">

                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" value="<?php
                                                                                                        echo $_SESSION['client_email'];
                                                                                                        ?>" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="method">Method</label>
                                        <select id="method" name="method" class="custom-select">
                                            <option value="WhatsApp Call">WhatsApp Call</option>
                                            <option value="WhatsApp Chat">WhatsApp Chat</option>
                                        </select>
                                    </div>

                                    <!-- <div class="form-group">
                                        <label for="session">Session</label>
                                        <select id="session" name="session" class="custom-select">
                                            <option value="1" data-money="70.00">per week (RM 70.00)</option>
                                            <option value="2" data-money="250.00">per month (RM 250.00)</option>
                                        </select>
                                        <input type="hidden" name="amount" id="amount" value="">
                                    </div> -->
                                    <div class="form-group">
                                        <p style="color:red">*You have to pay the bill(RM110) after the therapist accept your appointment.</p>
                                    </div>

                                    <div class="form-group">
                                        <!-- <label for="time">Time</label>
                                        <input type="time" class="form-control" name="time" placeholder="Time" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please Select the book time</div> -->

                                        <input type="hidden" name="therapistID" value="<?php
                                                                                        echo $_SESSION['select_id'];
                                                                                        ?>">
                                    </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- Submit Appointment -->
                        <input type="submit" name="upload" value="Submit Appointment" class="form-control" onclick="return confirm('Are you sure you want to submit?')" id="submit">
                        <!-- End submit -->
                        </form>
                        <div class="col-md-12">
                            <div id="paypal-button-container" style="display:none"></div>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script type="text/javascript">
        $(document).ready(function() {

            $(".book").click(function() {
                var dateslot = $(this).attr('data-dateslot');
                $("#slot").html(dateslot);
                $("#dateslot").val(dateslot);
            });

        });

        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Get the forms we want to add validation styles to
                var forms = document.getElementsByClassName('validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() == false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</section>
<footer>
    <?php require_once("footer.php"); ?>
</footer>

</html>