<?php
$servername = "localhost"; //localhost for local PC or use IP address
$username = "root"; //database name
$password = ""; //database password
$database = "oncoun"; //database name

// Create connection #scawx
$conn = new mysqli($servername, $username, $password, $database);

// Check connection #scawx
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


session_start();

//get therapist's information
if (isset($_SESSION['thera_id'])) {
    $id = $_SESSION['thera_id'];
    $sql = "SELECT * from therapist left join `language` on therapist.therapist_id=language.thera_ID where therapist_id='$id'";
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result->num_rows > 0) { //over 1 database(record) so run
        while ($row = $result->fetch_assoc()) {
            $_SESSION['thera_name_first'] = $row['name_first'];
            $_SESSION['thera_name_last'] = $row['name_last'];
            $_SESSION['thera_about'] = $row['about'];
            $_SESSION['thera_gender'] = $row['gender'];
            $_SESSION['thera_address'] = $row['address'];
            $_SESSION['thera_city'] = $row['therapist_city'];
            $_SESSION['thera_postCode'] = $row['therapist_postCode'];
            $_SESSION['thera_state'] = $row['therapist_state'];
            $_SESSOPM['thera_phone'] = $row['phone'];
            $_SESSION['thera_age'] = $row['age'];
            $_SESSION['thera_email'] = $row['email'];
            $_SESSION['thera_education'] = $row['education_level'];
            $_SESSION['thera_profile_image'] = $row['profile_image'];
            $_SESSION['thera_gender'] = $row['gender'];
            $_SESSION['thera_malay'] = $row['Malay'];
            $_SESSION['thera_mandarin'] = $row['Mandarin'];
            $_SESSION['thera_english'] = $row['English'];
        }
    }
} else { //if haven't login, can't access this page
    echo '<script>window.alert("You must login first!");window.location.assign("therapistLogin.php")</script>';
}
//get therapist's id
$id = $_SESSION['thera_id'];


//check the pathinfo and upload the image
function upload_thera($path, $file)
{
    $targetDir = $path;
    $default = $_SESSION['thera_profile_image'];

    // get the filename
    $filename = basename($file['name']);
    $targetFilePath = $targetDir . $filename;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if (!empty($filename)) {
        // allow certain file format
        $allowType = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if (in_array($fileType, $allowType)) {
            // upload file to the server
            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                return $filename;
            }
        }
    }
    // return default image
    return $default;
}

//check the pathinfo and upload the image
function upload_report($path, $file)
{
    $targetDir = $path;
    $default = "";

    // get the filename
    $filename = basename($file['name']);
    $targetFilePath = $targetDir . $filename;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if (!empty($filename)) {
        // allow certain file format
        $allowType = array('doc', 'docx', 'pdf');
        if (in_array($fileType, $allowType)) {
            // upload file to the server
            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                return $filename;
            }
        }
    }
    // return default image
    return $default;
}


// prevent injection
function validate_input_text($textValue)
{
    if (!empty($textValue)) {
        $trim_text = trim($textValue);
        // remove illegal character
        $sanitize_str = filter_var($trim_text, FILTER_SANITIZE_STRING);
        return $sanitize_str;
    }
    return '';
}

// prevent injection
function validate_input_email($emailValue)
{
    if (!empty($emailValue)) {
        $trim_text = trim($emailValue);
        // remove illegal character
        $sanitize_str = filter_var($trim_text, FILTER_SANITIZE_EMAIL);
        return $sanitize_str;
    }
    return '';
}

if (isset($_POST['logout'])) { //if logout,back to the login page
    session_destroy();
    echo '<script>window.location.assign("therapistLogin.php")</script>';
}


if (isset($_POST['submit'])) { //if user edit the profile
    $error = array();

    $files = $_FILES['uploadProfile'];
    $profileImage = upload_thera('./images/therapists/', $files);

    $about = mysqli_real_escape_string($conn, $_POST['about']);
    if (empty($about)) {
        $error[] = "You forgot to enter your about";
    }

    $name_first = validate_input_text($_POST['nameFirst']);
    if (empty($name_first)) {
        $error[] = "You forgot to enter your name_first";
    }

    $name_last = validate_input_text($_POST['nameLast']);
    if (empty($name_last)) {
        $error[] = "You forgot to enter your name_last";
    }

    $phone = validate_input_text($_POST['phone']);
    if (empty($phone)) {
        $error[] = "You forgot to enter your phone";
    }

    $address = mysqli_real_escape_string($conn, $_POST['address']);
    if (empty($address)) {
        $error[] = "You forgot to enter your address";
    }

    $city = validate_input_text($_POST['city']);
    if (empty($city)) {
        $error[] = "You forgot to enter your city";
    }

    $postCode = validate_input_text($_POST['postCode']);
    if (empty($postCode)) {
        $error[] = "You forgot to enter your postCode";
    }

    $state = validate_input_text($_POST['state']);
    if (empty($state)) {
        $error[] = "You forgot to enter your state";
    }

    if (empty($error)) { //if 0 error,then update the value
        $id = $_SESSION['thera_id'];
        $sql = "update therapist set name_first='$name_first',name_last='$name_last',about='$about',phone='$phone',address='$address',therapist_city='$city',therapist_postCode='$postCode',therapist_state='$state',profile_image='$profileImage' where therapist_id='$id'";

        $result = $conn->query($sql) or die($conn->error . __LINE__);

        if ($result == true) {
            $_SESSION['thera_name_first'] = $_POST['nameFirst'];
            $_SESSION['thera_name_last'] = $_POST['nameLast'];
            $_SESSION['thera_about'] = $_POST['about'];
            $_SESSOPM['thera_phone'] = $_POST['phone'];
            $_SESSION['thera_address'] = $_POST['address'];
            $_SESSION['thera_city'] = $_POST['city'];
            $_SESSION['thera_state'] = $_POST['state'];
            $_SESSION['thera_postCode'] = $_POST['postCode'];
            $_SESSION['thera_profile_image'] = $profileImage;


            //display successful statement
            echo '<style type="text/css"> 
        #thera_profile .edit-success{
                display:block !important;            
            }</style>';


            header("refresh:1;url=theraProfile.php");
        } else {
            //display fail statement
            echo '<style type="text/css"> 
        #thera_profile .edit-fail{
            display:block !important;            
        }</style>';
        }
    }
}
date_default_timezone_set('Singapore'); //declare the timezone
$date = date("Y-m-d"); //get the date
$time = date("h:i a"); //get the time

//display today list
$sql = "SELECT * FROM appointment LEFT JOIN onstatus on appointment.appointment_status=onstatus.id where therapist_ID='" . $_SESSION['thera_id'] . "' and user_date<='$date' and (appointment_status='2' or appointment_status='5') ORDER BY created_TIME DESC";
$result = $conn->query($sql) or die($conn->error . __LINE__);
//display today number
$getRe = $conn->query($sql) or die($conn->error . __LINE__);
//display totol number
$getReTol = $conn->query($sql) or die($conn->error . __LINE__);

//check if the time and date equals or greater than current, then the status will change to In consultation(If already accepted)
$checkCurrent = $conn->query($sql) or die($conn->error . __LINE__);

//check if the time and date equals or greater than current, then the status will change to In consultation(execute)
if ($checkCurrent->num_rows > 0) {
    while ($row = $checkCurrent->fetch_assoc()) {
        //display result
        $appointment_id = $row['appointment_id'];

        $user_date = $row['user_date'];
        $appointment_status = $row['appointment_status'];

        $user_time3 = strtotime($row['user_date']);
        $user_time4 = date("Y-m-d", $user_time3);

        if (($user_time4 == $date) && ($appointment_status == 2)) {
            $changeStatus = "UPDATE appointment set appointment_status='5' where appointment_id='$appointment_id'";
            $runChange = $conn->query($changeStatus) or die($conn->error . __LINE__);
            header("refresh:0;url=theraProfile.php");
        }
    }
}

//display waiting number
$wait = "SELECT * FROM appointment LEFT JOIN onstatus on appointment.appointment_status=onstatus.id where therapist_ID='$id' and appointment_status='1' ORDER BY created_TIME DESC";
$getWait = $conn->query($wait) or die($conn->error . __LINE__);
//display waiting list
$getWaitList = $conn->query($wait) or die($conn->error . __LINE__);
//display total number
$getWaitTol = $conn->query($wait) or die($conn->error . __LINE__);

//display all list
$all = "SELECT * FROM appointment LEFT JOIN onstatus on appointment.appointment_status=onstatus.id where therapist_ID='$id' ORDER BY created_TIME DESC";
$getAll = $conn->query($all) or die($conn->error . __LINE__);

//report all list
$report = "SELECT * FROM appointment where therapist_ID='" . $_SESSION['thera_id'] . "' and appointment_status='6'";
$runReport = $conn->query($report) or die($conn->error . __LINE__);
$checkReportNum = $conn->query($report) or die($conn->error . __LINE__);

//today number
$TodayNum = 0;
//waiting number
$WaitNum = 0;
//total number
$AppointmentTotal = 0;

$ReportNum = 0;

if ($checkReportNum->num_rows > 0) {
    while ($row = $checkReportNum->fetch_assoc()) {
        $appointment_id = $row['appointment_id'];
        $user_Email = $row['user_Email'];
        $user_method = $row['user_method'];

        $user_date = $row['user_date'];
        $specialty_name = $row['specialty_name'];
        $checkDirec = $row['checkDirec'];

        $paymentStatus = $row['paymentStatus'];
        $created_TIME = $row['created_TIME'];

        $checkReport = "SELECT * FROM report where appointment_id='$appointment_id'";
        $runCheck = $conn->query($checkReport) or die($conn->error . __LINE__);

        if ($runCheck->num_rows == 0) {
            ++$ReportNum;
        }
    }
}

//if today number is over 0
if ($getReTol->num_rows > 0) {
    while ($row = $getReTol->fetch_assoc()) {
        $appointment_id = $row['appointment_id'];
        $user_Email = $row['user_Email'];
        $user_method = $row['user_method'];

        $user_date = $row['user_date'];
        $user_phone = $row['user_phone'];
        $appointment_status = $row['appointment_status'];
        $statusID = $row['id'];
        $status = $row['status'];
        $created_TIME = $row['created_TIME'];


        $user_time3 = strtotime($row['user_date']);
        $user_time4 = date("Y-m-d", $user_time3);

        if ($appointment_status == '5') {
            ++$AppointmentTotal;
            ++$TodayNum;
        }
    }
}

//if total wait number is over 0
if ($getWaitTol->num_rows > 0) {
    while ($row = $getWaitTol->fetch_assoc()) {
        ++$AppointmentTotal;
        ++$WaitNum;
    }
}

//if accept
if (isset($_POST['accept'])) {
    $id = $_POST['accept']; //id
    $statusID = 2;
    $sql = "update appointment set appointment_status='$statusID' where appointment_id='$id'"; //set status=2 where therapist_id == this.id
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result == true) {
        header('refresh: 0; url=theraProfile.php');
    }
}


//if reject
if (isset($_POST['reject'])) {
    $id = $_POST['reject']; //id
    $statusID = 3;
    $sql = "update appointment set appointment_status='$statusID' where appointment_id='$id'"; //set status=3 where therapist_id == this.id
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result == true) {
        header('refresh: 0; url=theraProfile.php');
    }
}

if (isset($_POST['finish'])) { //if finish the consultation
    $id = $_POST['finish']; //id
    $statusID = 6;

    $sql = "update appointment set appointment_status='$statusID' where appointment_id='$id'"; //set status=3 where therapist_id == this.id
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result == true) { //if the result was successful update
        header('refresh: 0; url=theraProfile.php');
    }
}

if (isset($_POST['change'])) { //if change the password
    $id = $_SESSION['thera_id'];
    $current_Password = $_POST['password_old'];
    $new_Password = $_POST['password_new'];

    $sql = "SELECT * FROM therapist where therapist_id='$id'";
    $result = $conn->query($sql) or die($conn->error . __LINE__);
    $getNow = $result->fetch_assoc();
    $getCurrentPass = $getNow['password'];

    if (password_verify($current_Password, $getCurrentPass)) {
        $hashed_pass = password_hash($new_Password, PASSWORD_DEFAULT);
        $sqli = "update therapist set password='$hashed_pass'";
        $run = $conn->query($sqli) or die($conn->error . __LINE__);

        //if update successful
        if ($run == true) {
            echo '<style type="text/css"> 
        #thera_profile .change-success{
            display:block !important;            
        }</style>';

            header('refresh: 1; url=theraProfile.php');
        }
    } else {
        //if update fail
        echo '<style type="text/css"> 
        #thera_profile .Password_fail{
            display:block !important;            
        }</style>';
        header('refresh: 1; url=theraProfile.php');
    }
}

if (isset($_POST['sub_logout'])) { //mobile version logout
    session_destroy();
    echo '<script>window.location.assign("therapistLogin.php")</script>';
}

if (isset($_POST['submitReport'])) {
    $error = array();
    $report_ID = validate_input_text($_POST['report_ID']);
    if (empty($report_ID)) {
        $error[] = "you forget your report_ID";
    }
    $reportFile = upload_report('./report/', $_FILES['reportFile']);
    if (empty($reportFile)) {
        $error[] = "you forget your reportFile";
    }

    if (empty($error)) {
        $sql = "INSERT INTO report values('','$report_ID','" . $_SESSION['thera_id'] . "','$reportFile',NOW())";
        $result = $conn->query($sql) or die($conn->error . __LINE__);

        if ($result == true) {
            echo '<style type="text/css">
            .report-success{
                display:block !important;
            }</style>';
            header('refresh: 1; url=theraProfile.php');
        }
    } else {
        echo '<style type="text/css">
        .report-fail{
            display:block !important;
        }</style>';
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <link rel="icon" href="images/Logo.jpg" type="image/x-icon" />
    <title>C&H</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/therapistProfile.css">

    <style>
        #submitReport-form {
            width: 100%;
            padding: 15px 20px;
            box-sizing: border-box;
            margin-bottom: 20px;
            margin-left: 0 !important;
            margin-right: 0 !important;
            display: none;
        }

        #reportInside {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        #submitReport {
            display: inline-block !important;
            background: darkblue !important;
            padding: 14px 0 !important;
            color: white !important;
            width: 100%;
            cursor: pointer !important;
            margin-top: 8px !important;
            transition: ease 0.5s !important;
        }

        #submitReport:hover {
            transition: ease 0.5s !important;
            background-color: rgba(59, 82, 114) !important;
        }

        .report-fail {
            margin-top: -4px !important;
            display: none;
        }

        .report-success {
            margin-top: -4px !important;
            display: none;
        }
    </style>

</head>

<body>
    <section id="thera_profile">

        <div class="alert alert-success alert-dismissible fade show text-center edit-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Edit Successful!</strong>
        </div>

        <div class="alert alert-success alert-dismissible fade show text-center report-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Submit report Successful!</strong>
        </div>

        <div class="alert alert-success alert-dismissible fade show text-center change-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Password was Successfully Changed!</strong>
        </div>

        <div class="alert alert-danger alert-dismissible fade show text-center edit-fail">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Edit Fail, Please Try Again!</strong>
        </div>

        <div class="alert alert-danger alert-dismissible fade show text-center Password_fail">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Your Current Password is not Correct!</strong>
        </div>

        <div class="alert alert-danger alert-dismissible fade show text-center report-fail">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>You are submit the wrong file type, Please Try Again!</strong>
        </div>

        <div class="row" id="whole">
            <div class="col-md-4">
                <div class="col-md-12">
                    <img class="camera-icon" src="images/camera-solid.svg" alt="camera" id="camera_icon">
                    <img src="./images/therapists/<?php echo $_SESSION['thera_profile_image'] ?>" alt="image" id="therapist_image">
                    <input type="file" name="uploadProfile" id="uploadProfile" form="thera_save" class="form-control-file">
                    <h6 style="margin-top:20px;" id="changePro">Change profile photo</h6>
                    <h4 class="welcome">Welcome, <?php echo $_SESSION['thera_name_first'] . "&nbsp;" . $_SESSION['thera_name_last'] ?></h4>
                </div>

                <div class="col-md-12 text-left left-side">
                    <ul class="noStyle">
                        <li>
                            <i class="fa fa-user" aria-hidden="true" id="profile_icon"></i>
                            <button class="theraInfo" name="theraInfoBtn" id="theraProfile">
                                <h4 id="profile_h4">Profile</h4>
                            </button>
                        </li>

                        <li>
                            <i class="fa fa-file-o" aria-hidden="true" id="appointment_icon"></i>
                            <button class="theraInfo" name="theraInfoBtn" id="theraAppointment">
                                <h4 id="appointment_h4">My Appointment</h4>
                            </button>&nbsp;<?php if ($AppointmentTotal != 0) {
                                                echo "<span class=\"badge badge-danger\" style=\"padding:7px;font-size:20px;\">$AppointmentTotal</span></a>";
                                            } ?>

                        </li>

                        <li>
                            <i class="fa fa-file-text-o" aria-hidden="true" id="report_icon"></i>
                            <button class="theraInfo" name="theraInfoBtn" id="theraReport">
                                <h4 id="report_h4">Report</h4>
                            </button><?php if ($ReportNum != 0) {
                                            echo "<span class=\"badge badge-danger\" style=\"padding:7px;font-size:20px;\">$ReportNum</span></a>";
                                        } ?>
                        </li>
                    </ul>
                </div>

                <div class="col-md-12 text-left logout">
                    <form action="theraProfile.php" method="POST" id="thera_save" enctype="multipart/form-data">
                        <button class="info" type="submit" name="logout" id="logBtn" onclick="return confirm('Are you sure you want to log out?')" style="padding:7px;">
                            <i class="fa fa-sign-out" aria-hidden="true" style="font-size: 23px;padding-top: 3px;float:left"></i>
                            <h5 style="float:left;padding-left:5px;">Log out</h5>
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-md-8 right-side">
                <div class="col-md-12" id="Profile">
                    <div class="col-md-12 text-center">
                        <h3><strong>Your personal Info</strong></h3>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12" style="margin-bottom:20px;">
                                <h4 style="color:black">About me</h4>
                                <textarea name="about" id="about" class="form-control" cols="90" rows="10" readonly><?php echo $_SESSION['thera_about'] ?></textarea>
                            </div>

                            <div class="col-md-6" style="margin-bottom:20px;">
                                <h4 style="color:black">First Name</h4>
                                <input type="text" class="form-control" name="nameFirst" id="nameFirst" value="<?php echo $_SESSION['thera_name_first'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;width:100%" readonly>
                            </div>

                            <div class="col-md-6" style="margin-bottom:20px;">
                                <h4 style="color:black">Last Name</h4>
                                <input type="text" class="form-control" name="nameLast" id="nameLast" value="<?php echo $_SESSION['thera_name_last'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;width:100%" readonly>
                            </div>

                            <div class="col-md-6" style="margin-bottom:20px;">
                                <h4 style="color:black">Phone Number</h4>
                                <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $_SESSOPM['thera_phone'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;width:100%" readonly>
                            </div>

                            <div class="col-md-12" style="margin-bottom:20px;">
                                <h4 style="color:black">Address</h4>
                                <input type="text" class="form-control" name="address" id="address" value="<?php echo $_SESSION['thera_address'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;width:100%" readonly>
                            </div>

                            <div class="col-md-6" style="margin-bottom:20px;">
                                <h4 style="color:black">City</h4>
                                <input type="text" class="form-control" name="city" id="city" value="<?php echo $_SESSION['thera_city'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;width:100%" readonly>
                            </div>

                            <div class="col-md-6" style="margin-bottom:20px;">
                                <h4 style="color:black">Post Code</h4>
                                <input type="text" class="form-control" name="postCode" id="postCode" value="<?php echo $_SESSION['thera_postCode'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;width:100%" readonly>
                            </div>

                            <div class="col-md-6" style="margin-bottom:20px;">
                                <h4 style="color:black">State</h4>
                                <input type="text" class="form-control" name="state" id="state" value="<?php echo $_SESSION['thera_state'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;width:100%" readonly>
                            </div>

                            <div class="col-md-6" style="margin-bottom:20px;">
                                <h4 style="color:black">Email</h4>
                                <input type="text" class="form-control" name="email" id="email" value="<?php echo $_SESSION['thera_email'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;width:100%" readonly>
                            </div>

                            <div class="col-md-6" style="margin-bottom:20px;">
                                <h4 style="color:black">Age</h4>
                                <input type="text" class="form-control" name="age" id="age" value="<?php echo $_SESSION['thera_age'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;width:100%" readonly>
                            </div>

                            <div class="col-md-6" style="margin-bottom:20px;">
                                <h4 style="color:black">Gender</h4>
                                <input type="text" class="form-control" name="gender" id="gender" value="<?php echo $_SESSION['thera_gender'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;width:100%" readonly>
                            </div>

                            <div class="col-md-6" style="margin-bottom:20px;">
                                <h4 style="color:black">Language</h4>
                                <hr>
                                <div class="form-check">
                                    <label class="form-check-label" for="malay">
                                        <h4>Malay</h4>
                                    </label>
                                    <?php if ($_SESSION['thera_malay'] == "Yes") {
                                        echo "<i class='fa fa-check' aria-hidden='true' style='color:green;font-size:20px;'></i>";
                                    } else {
                                        echo "<i class='fa fa-times' aria-hidden'true' style='color:red;font-size:20px;'></i>";
                                    } ?>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="english">
                                        <h4>English</h4>
                                    </label>
                                    <?php if ($_SESSION['thera_english'] == "Yes") {
                                        echo "<i class='fa fa-check' aria-hidden='true' style='color:green;font-size:20px;'></i>";
                                    } else {
                                        echo "<i class='fa fa-times' aria-hidden'true' style='color:red;font-size:20px;'></i>";
                                    } ?>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="mandarin">
                                        <h4>Mandarin</h4>
                                    </label>
                                    <?php if ($_SESSION['thera_mandarin'] == "Yes") {
                                        echo "<i class='fa fa-check' aria-hidden='true' style='color:green;font-size:20px;'></i>";
                                    } else {
                                        echo "<i class='fa fa-times' aria-hidden'true' style='color:red;font-size:20px;'></i>";
                                    } ?>
                                </div>
                            </div>

                            <div class="col-md-12 edit">
                                <button class="btn btn-outline-primary" name="edit" id="edit">Edit</button>
                                <button class="btn btn-outline-success" type="submit" name="submit" id="submit" onclick="return confirm('Are you sure you want to edit?')">Save Changes</button>
                                <button name="change_password" id="change_password" class="btn btn-outline-primary">Change Password</button>
                            </div>

                            <div class="col-md-12" style="margin-bottom:20px;">
                                <div class="col-md-6" id="password_oldPlace">
                                    <h4 style="color:black">Current Password</h4>
                                    <input type="text" class="form-control" form="thera_save" name="password_old" id="password_old" value="" style="outline:none;border-radius:5px;width:50%;font-size:18px;width:100%" placeholder="Please enter your current password">
                                </div>

                                <div class="col-md-6" id="password_newPlace">
                                    <h4 style="color:black;margin-top:5px;">New Password</h4>
                                    <input type="text" class="form-control" name="password_new" form="thera_save" id="password_new" value="" style="outline:none;border-radius:5px;width:50%;font-size:18px;width:100%" placeholder="Minimum 6 characters with a number">
                                    <span id="password_empty1">Password cannot be empty!</span>
                                    <span id="password_length">Password length must over 6 digits</span>
                                </div>

                                <div class="col-md-6" id="password_confPlace">
                                    <h4 style="color:black;margin-top:5px;">Confirm Password</h4>
                                    <input type="text" class="form-control" name="password_confirm" form="thera_save" id="password_confirm" value="" style="outline:none;border-radius:5px;width:50%;font-size:18px;width:100%" placeholder="Please retype your password">
                                    <span id="password_feedback">Password are not same!</span>
                                    <span id="password_empty2">Password cannot be empty!</span><br>
                                    <button class="btn btn-outline-success" type="submit" name="change" id="change" form="thera_save" onclick="return confirm('Are you sure you want to change the password?')">Change Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" id="Appointment">
                    <!-- Nav tabs -->

                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#today">In Consultation&nbsp;<?php if ($TodayNum != 0) {
                                                                                                                echo "<span class=\"badge badge-primary\">$TodayNum</span>";
                                                                                                            } ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#waiting">Wait List &nbsp;<?php if ($WaitNum != 0) {
                                                                                                        echo "<span class=\"badge badge-primary\">$WaitNum</span>";
                                                                                                    } ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#all">All&nbsp;<span class="badge badge-primary"></a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="today" class="container tab-pane active">
                            <table class="table table-striped custab text-center">
                                <thead>
                                    <tr>
                                        <th>Appointment_ID</th>
                                        <th>Client Email</th>
                                        <th>Consultation method</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) { //over 1 database(record) so run
                                        while ($row = $result->fetch_assoc()) {
                                            //display result
                                            $appointment_id = $row['appointment_id'];
                                            $user_Email = $row['user_Email'];
                                            $user_method = $row['user_method'];

                                            $user_date = $row['user_date'];
                                            $user_phone = $row['user_phone'];
                                            $appointment_status = $row['appointment_status'];
                                            $statusID = $row['id'];
                                            $status = $row['status'];
                                            $created_TIME = $row['created_TIME'];
                                            $paymentStatus = $row['paymentStatus'];
                                            $checkDirec = $row['checkDirec'];


                                            $user_time3 = strtotime($row['user_date']);
                                            $user_time4 = date("Y-m-d", $user_time3);

                                    ?>
                                            <tr>
                                                <td><?php echo $appointment_id ?></td>
                                                <td><?php echo $user_Email ?></td>
                                                <td><?php echo $user_method ?></td>
                                                <td><?php echo $user_time4 ?></td>
                                                <?php

                                                switch ($statusID) {
                                                    case 1:
                                                        echo "<td style=\"color:black;font-size:20px;font-weight:bold;\">$status</td>";
                                                        break;
                                                    case 2:
                                                        echo "<td style=\"color:green;font-size:20px;font-weight:bold;\">$status</td>";
                                                        break;
                                                    case 4:
                                                        echo "<td style=\"color:red;font-size:20px;font-weight:bold;\">$status</td>";
                                                        break;
                                                    case 5:
                                                        echo "<td style=\"color:black;font-size:20px;font-weight:bold;\">$status</td>";
                                                        break;
                                                    case 6:
                                                        echo "<td style=\"color:green;font-size:20px;font-weight:bold;\">$status</td>";
                                                        break;
                                                }
                                                ?>
                                                <?php
                                                switch ($paymentStatus) {
                                                    case 1:
                                                        echo "<td style=\"color:red;font-size:20px;font-weight:bold;\">No</td>";
                                                        break;
                                                    case 2:
                                                        echo "<td style=\"color:green;font-size:20px;font-weight:bold;\">Yes</td>";
                                                        break;
                                                }
                                                ?>

                                                <td><?php
                                                    if ($statusID == '5') {
                                                    ?>
                                                        <a href="https://api.whatsapp.com/send?phone=<?php echo $user_phone ?>&text=&source=&data=" target="null"><button name="chat" type="submit" class="btn btn-outline-success btn-xs my-2" id="chat">Chat</button></a>
                                                        <button name="finish" type="submit" class="btn btn-success my-2 btn-xs" onclick="return confirm('Please ensure the consultation was finish')" value="<?php echo $appointment_id ?>" id="finish" form="thera_save">Finish</button>

                                                    <?php
                                                        if ($checkDirec == '1') {
                                                            echo "<button class='btn btn-success btn-xs my-2 view' name='view' data-toggle='modal' data-target='#viewAns' data-appointmentID='$appointment_id'>View answer</button>";
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                    <?php }
                                    } ?></tbody>
                            </table>
                        </div>
                        <div id="waiting" class="container tab-pane fade">
                            <table class="table table-striped custab text-center">
                                <thead>
                                    <tr>
                                        <th>Appointment_ID</th>
                                        <th>Client Email</th>
                                        <th>Consultation method</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if ($getWaitList->num_rows > 0) { //over 1 database(record) so run
                                        while ($row = $getWaitList->fetch_assoc()) {
                                            //display result
                                            $appointment_id = $row['appointment_id'];
                                            $user_Email = $row['user_Email'];
                                            $user_method = $row['user_method'];

                                            $user_date = $row['user_date'];
                                            $appointment_status = $row['appointment_status'];
                                            $statusID = $row['id'];
                                            $status = $row['status'];
                                            $created_TIME = $row['created_TIME'];
                                            $checkDirec = $row['checkDirec'];


                                            $user_time3 = strtotime($row['user_date']);
                                            $user_time4 = date("Y-m-d", $user_time3);

                                    ?>
                                            <tr>
                                                <td><?php echo $appointment_id ?></td>
                                                <td><?php echo $user_Email ?></td>
                                                <td><?php echo $user_method ?></td>
                                                <td><?php echo $user_time4 ?></td>
                                                <?php
                                                switch ($statusID) {
                                                    case 1:
                                                        echo "<td style=\"color:black;font-size:20px;font-weight:bold;\">$status</td>";
                                                        break;
                                                    case 2:
                                                        echo "<td style=\"color:green;font-size:20px;font-weight:bold;\">$status</td>";
                                                        break;
                                                    case 4:
                                                        echo "<td style=\"color:red;font-size:20px;font-weight:bold;\">$status</td>";
                                                        break;
                                                    case 5:
                                                        echo "<td style=\"color:black;font-size:20px;font-weight:bold;\">$status</td>";
                                                        break;
                                                    case 6:
                                                        echo "<td style=\"color:green;font-size:20px;font-weight:bold;\">$status</td>";
                                                        break;
                                                }
                                                ?>

                                                <td>
                                                    <button name="accept" type="submit" class="btn btn-info btn-xs" onclick="return confirm('Are you sure you want to Accept?')" value="<?php echo $appointment_id ?>" id="accept" form="thera_save">Accept</button>
                                                    <button name="reject" type="submit" form="thera_save" class="btn btn-danger btn-xs" value="<?php echo $appointment_id ?>" onclick="return confirm('Are you sure you want to Reject?')">Reject</button>
                                                    <?php
                                                    if ($checkDirec == '1') {
                                                        echo "<button class='btn btn-success btn-xs my-2 view' name='view' data-toggle='modal' data-target='#viewAns' data-appointmentID='$appointment_id'>View answer</button>";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                    <?php }
                                    } ?></tbody>

                            </table>

                        </div>
                        <div id="all" class="container tab-pane fade">
                            <table class="table table-striped custab text-center" style="width:110%">
                                <thead>
                                    <tr>
                                        <th>Appointment_ID</th>
                                        <th>Client Email</th>
                                        <th>Consultation method</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if ($getAll->num_rows > 0) { //over 1 database(record) so run
                                        while ($row = $getAll->fetch_assoc()) {
                                            //display result
                                            $appointment_id = $row['appointment_id'];
                                            $user_Email = $row['user_Email'];
                                            $user_method = $row['user_method'];

                                            $user_date = $row['user_date'];
                                            $appointment_status = $row['appointment_status'];
                                            $statusID = $row['id'];
                                            $status = $row['status'];
                                            $created_TIME = $row['created_TIME'];
                                            $paymentStatus = $row['paymentStatus'];
                                            $checkDirec = $row['checkDirec'];

                                            $user_time3 = strtotime($row['user_date']);
                                            $user_time4 = date("Y-m-d", $user_time3);

                                            $user_time5 = strtotime($row['created_TIME']);
                                            $user_time6 = date("Y-m-d h:i a", $user_time5);


                                    ?>
                                            <tr>
                                                <td><?php echo $appointment_id ?></td>
                                                <td><?php echo $user_Email ?></td>
                                                <td><?php echo $user_method ?></td>
                                                <td><?php echo $user_time4 ?></td>
                                                <?php
                                                switch ($statusID) {
                                                    case 1:
                                                        echo "<td style=\"color:black;font-size:20px;font-weight:bold;\">$status</td>";
                                                        break;
                                                    case 2:
                                                        echo "<td style=\"color:green;font-size:20px;font-weight:bold;\">$status</td>";
                                                        break;
                                                    case 3:
                                                        echo "<td style=\"color:red;font-size:20px;font-weight:bold;\">$status</td>";
                                                        break;
                                                    case 4:
                                                        echo "<td style=\"color:red;font-size:20px;font-weight:bold;\">$status</td>";
                                                        break;
                                                    case 5:
                                                        echo "<td style=\"color:black;font-size:20px;font-weight:bold;\">$status</td>";
                                                        break;
                                                    case 6:
                                                        echo "<td style=\"color:green;font-size:20px;font-weight:bold;\">$status</td>";
                                                        break;
                                                }
                                                ?>
                                                <?php
                                                switch ($paymentStatus) {
                                                    case 0:
                                                        echo "<td style=\"color:black;font-size:20px;font-weight:bold;\">-</td>";
                                                        break;
                                                    case 1:
                                                        echo "<td style=\"color:red;font-size:20px;font-weight:bold;\">No</td>";
                                                        break;
                                                    case 2:
                                                        echo "<td style=\"color:green;font-size:20px;font-weight:bold;\">paid</td>";
                                                        break;
                                                }
                                                ?>

                                                <td><?php
                                                    if ($statusID == '1') {
                                                        echo "<button name='cancel' type='submit' form='thera_save' class='btn btn-danger btn-xs' value=$appointment_id onclick='return confirm(\"Are you sure you want to cancel?\")'>Cancel</button>";
                                                    }

                                                    if ($checkDirec == '1') {
                                                        echo "<button class='btn btn-success btn-xs my-2 view' name='view' data-toggle='modal' data-target='#viewAns' data-appointmentID='$appointment_id'>View answer</button>";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                    <?php }
                                    } ?></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" id="submitReport-form">
                    <div class="row" id="reportInside">
                        <div class="col-md-12">
                            <h1 style="text-align:center;margin-bottom:40px">Report</h1>

                            <div class="col">
                                <h5 style="color:rgb(34, 19, 48);">Appointment ID (Finished)</h5>
                                <select id="report_ID" name="report_ID" form="thera_save" class="form-control">
                                    <option value=""></option>
                                    <?php
                                    if ($runReport->num_rows > 0) {
                                        while ($row = $runReport->fetch_assoc()) {
                                            //display result
                                            $appointment_id = $row['appointment_id'];
                                            $user_Email = $row['user_Email'];
                                            $user_method = $row['user_method'];

                                            $user_date = $row['user_date'];
                                            $specialty_name = $row['specialty_name'];
                                            $checkDirec = $row['checkDirec'];

                                            $paymentStatus = $row['paymentStatus'];
                                            $created_TIME = $row['created_TIME'];

                                            $checkReport = "SELECT * FROM report where appointment_id='$appointment_id'";
                                            $runCheck = $conn->query($checkReport) or die($conn->error . __LINE__);

                                            if ($runCheck->num_rows == 0) {
                                    ?>
                                                <option value="<?php echo $appointment_id ?>"><?php echo $appointment_id ?></option>

                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                                <span style="color:red;display:none" id="selection-empty">This field cannot be empty!!!</span>
                                <hr>
                            </div>

                            <div class="col">
                                <h5 style="color:rgb(34, 19, 48);margin-top:30px;">Report File </h5>
                                <input type="file" name="reportFile" id="reportFile" form="thera_save" class="form-control-file">
                                <span style="color:red;display:none" id="file-empty">This field cannot be empty!!!</span>
                                <span style="color:red"> *Only allow .doc, .docx and .pdf file</span>
                                <hr>
                            </div>

                            <button class="btn" id="submitReport" type="submit" onclick="return confirm('Confirm to submit the report?')" form="thera_save" name="submitReport">Send</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="viewAns" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Appointment ID: <span id="slot"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal-body">

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 hand">
            <div class="row">
                <div class="col-md-12">
                    <div class="UserIcon" id="UserIconSecond">
                        <i class="fa fa-user" aria-hidden="true" id="profile_iconSecond"></i>
                    </div>
                    <div class="UserAppointment" id="UserAppointmentSecond">
                        <i class="fa fa-calendar" aria-hidden="true" id="appointment_iconSecond"></i>
                        <?php if ($AppointmentTotal != 0) {
                            echo "<span class=\"badge badge-danger\" style=\"padding:7px;font-size:20px;\" id=\"appointmentSecond_number\">$AppointmentTotal</span>";
                        } ?>
                    </div>
                    <div class="UserReport" id="UserReportSecond">
                        <i class="fa fa-file-text-o" aria-hidden="true" id="report_iconSecond"></i>
                    </div>
                    <div class="UserLogout" id="UserLogoutSecond">
                        <button style="background:none;border:0;" type="submmit" name="sub_logout" form="thera_save" onclick="return confirm('Are you sure you want to Log out?')"><i class="fa fa-sign-out" aria-hidden="true" id="logout_iconSecond"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/therapist.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(e) {
            $(".view").click(function() {

                $('#slot').html($(this).attr('data-appointmentID'));
                $.ajax({
                    url: "insert.php",
                    method: "post",
                    data: {
                        appontmentID: $(this).attr('data-appointmentID')
                    },
                    dataType: "text",
                    success: function(data) {
                        $('#modal-body').html(data);
                    }
                });
            });
        });
    </script>

</body>

</html>