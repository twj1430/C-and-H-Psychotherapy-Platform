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

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if (isset($_SESSION['admin_id'])) {
    $id = $_SESSION['admin_id'];
    $sql = "SELECT * from ms_admin where id='$id'";
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result->num_rows > 0) { //over 1 database(record) so run
        while ($row = $result->fetch_assoc()) {
            $_SESSION['admin_first_name'] = $row['first_name'];
            $_SESSION['admin_last_name'] = $row['last_name'];
        }
    }
} else {
    echo "<script>window.alert('You cannot directly access this page!!');window.location.assign('../adminLogin.php')</script>";
}

$totalThera = 0;

$checkThera = "SELECT * FROM therapist where statusID ='1'";
$runCheck = $conn->query($checkThera) or die($conn->error . __LINE__);

if ($runCheck->num_rows > 0) {
    ++$totalThera;
}

$totalReview = 0;

$checkReview = "SELECT * FROM review where checkReview ='1'";
$runCheckReview = $conn->query($checkReview) or die($conn->error . __LINE__);

if ($runCheckReview->num_rows > 0) {
    ++$totalReview;
}

function therapist_Table()
{
    $servername = "localhost"; //localhost for local PC or use IP address
    $username = "root"; //database name
    $password = ""; //database password
    $database = "oncoun"; //database name

    // Create connection #scawx
    $conn = new mysqli($servername, $username, $password, $database);

    if (!isset($_POST['searchBtn'])) {
        $sql = "SELECT * FROM therapist"; //id is database name
        $result = $conn->query($sql) or die($conn->error . __LINE__);

        $therapist_Table = "<table class='table table-striped custab'>";
        $therapist_Table .= "<thead><tr>";
        $therapist_Table .= "<th>ID</th>";
        $therapist_Table .= "<th>Name</th>";
        $therapist_Table .= "<th>Profile Image</th>";
        $therapist_Table .= "<th>Status</th>";
        $therapist_Table .= "<th class='text-center'>Action</th>";
        $therapist_Table .= "</tr></thead><tbody>";

        $number_of_results = mysqli_num_rows($result);
        //define how many results you want per page
        $results_per_page = 5;

        //determine number of total pages available
        $number_of_pages = ceil($number_of_results / $results_per_page);

        //determine which page number visitor is currently on
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        //determine the sql LIMIT starting number for the results on the displaying page
        $this_page_first_result = ($page - 1) * $results_per_page;

        //$retrieve the sql LIMIT starting number for the results on the displaying page
        $sqli = "SELECT * FROM therapist LEFT JOIN onstatus on therapist.statusID=onstatus.id LEFT JOIN language on therapist.therapist_id=language.thera_ID ORDER BY created_at DESC LIMIT  " . $this_page_first_result . ',' . $results_per_page;

        $results = mysqli_query($conn, $sqli) or die($conn->error . __LINE__);

        for ($page1 = 1; $page1 <= $number_of_pages; $page1++) {
            if ($page == $page1) {
                echo '<a href="therapistTable.php?page=' . $page1 . '" class="btn btn-primary next" style="width:50px;margin-right:10px;">' . $page1 . '</a>';
            } else {
                echo '<a href="therapistTable.php?page=' . $page1 . '" class="btn btn-outline-primary next" style="width:50px;margin-right:10px;">' . $page1 . '</a>';
            }
        }

        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $about = $row['about'];
                $email = $row['email'];
                $gender = $row['gender'];
                $age = $row['age'];
                $phone = $row['phone'];
                $ic = $row['ic'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $resume = $row['resume'];
                $profile_image = $row['profile_image'];
                $statusID = $row['statusID'];
                $created_at = $row['created_at'];
                $status = $row['status'];
                $malay = $row['Malay'];
                $mandarin = $row['Mandarin'];
                $english = $row['English'];

                $user_time1 = strtotime($created_at);
                $user_time2 = date("Y-m-d h:i a", $user_time1);

                $therapist_Table .= "<tr><td>$id</td>";
                $therapist_Table .= "<td>$name_first&nbsp;$name_last</td>";
                $therapist_Table .= "<td><img src='../images/therapists/$profile_image' alt='image' style='width:150px;height:150px;border-radius:50%;'></td>";

                switch ($statusID) {
                    case 2:
                        $therapist_Table .= "<td style='color:green;font-size:20px;font-weight:bold;'>$status</td>";
                        break;
                    case 3:
                        $therapist_Table .= "<td style='color:red;font-size:20px;font-weight:bold;'>$status</td>";
                        break;
                    default:
                        $therapist_Table .= "<td style='color:black;font-size:20px;font-weight:bold;'>$status</td>";
                        break;
                }
                $therapist_Table .= "<td>";
                if ($statusID == '1') {
                    $therapist_Table .= "<button name='accept' type='submit' class='btn btn-success' onclick='return confirm(\"Are you sure you want to Accept?\")' value='$id' style='display:block' form='theraTable' id='accept'>Accept</button>&nbsp;";
                    $therapist_Table .= "<button name='reject' type='submit' class='btn btn-danger'  onclick='return confirm(\"Are you sure you want to Reject?\")' value='$id' style='display:block' form='theraTable'id='reject'>Reject</button>&nbsp;|&nbsp;";
                }
                $therapist_Table .= "<button class='btn btn-success thera' id='thera' data-toggle='modal'  data-target='#therapistDetail' data-theraid='$id' data-therafname='$name_first' data-theralname='$name_last' data-theraabout='$about' data-theragender='$gender' data-theraage='$age' data-theraemail='$email' data-theraphone='$phone' data-theraic='$ic' data-theraaddress='$address' data-theracity='$therapist_city' data-therapost='$therapist_postCode' data-therastate='$therapist_state' data-education='$education_level' data-theraresume='../images/certificate/$resume' data-theraprofile='../images/therapists/$profile_image' data-theramalay='$malay' data-theramandarin='$mandarin' data-theraenglish='$english'>Details</button> &nbsp;";
                $therapist_Table .= "<button name='delete' id='delete' form='theraTable' type='submit' class='btn btn-danger' value='$id' onclick='return confirm(\"Are you sure you want to delete?\")' style='display:block'>Delete</button></td></tr>";
            }
        }
        $therapist_Table .= "</tbody></table>";

        echo $therapist_Table;
    } else if ((isset($_POST['searchBtn'])) && (empty($_POST['searchTxt']))) {
        $sql = "SELECT * FROM therapist"; //id is database name
        $result = $conn->query($sql) or die($conn->error . __LINE__);

        $therapist_Table = "<table class='table table-striped custab'>";
        $therapist_Table .= "<thead><tr>";
        $therapist_Table .= "<th>ID</th>";
        $therapist_Table .= "<th>Name</th>";
        $therapist_Table .= "<th>Profile Image</th>";
        $therapist_Table .= "<th>Status</th>";
        $therapist_Table .= "<th class='text-center'>Action</th>";
        $therapist_Table .= "</tr></thead><tbody>";

        $number_of_results = mysqli_num_rows($result);
        //define how many results you want per page
        $results_per_page = 5;

        //determine number of total pages available
        $number_of_pages = ceil($number_of_results / $results_per_page);

        //determine which page number visitor is currently on
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        //determine the sql LIMIT starting number for the results on the displaying page
        $this_page_first_result = ($page - 1) * $results_per_page;

        //$retrieve the sql LIMIT starting number for the results on the displaying page
        $sqli = "SELECT * FROM therapist LEFT JOIN onstatus on therapist.statusID=onstatus.id LEFT JOIN language on therapist.therapist_id=language.thera_ID ORDER BY created_at DESC LIMIT  " . $this_page_first_result . ',' . $results_per_page;

        $results = mysqli_query($conn, $sqli) or die($conn->error . __LINE__);

        for ($page1 = 1; $page1 <= $number_of_pages; $page1++) {
            if ($page == $page1) {
                echo '<a href="therapistTable.php?page=' . $page1 . '" class="btn btn-primary next" style="width:50px;margin-right:10px;">' . $page1 . '</a>';
            } else {
                echo '<a href="therapistTable.php?page=' . $page1 . '" class="btn btn-outline-primary next" style="width:50px;margin-right:10px;">' . $page1 . '</a>';
            }
        }

        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $about = $row['about'];
                $email = $row['email'];
                $gender = $row['gender'];
                $age = $row['age'];
                $phone = $row['phone'];
                $ic = $row['ic'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $resume = $row['resume'];
                $profile_image = $row['profile_image'];
                $statusID = $row['statusID'];
                $created_at = $row['created_at'];
                $status = $row['status'];
                $malay = $row['Malay'];
                $mandarin = $row['Mandarin'];
                $english = $row['English'];

                $user_time1 = strtotime($created_at);

                $therapist_Table .= "<tr><td>$id</td>";
                $therapist_Table .= "<td>$name_first&nbsp;$name_last</td>";
                $therapist_Table .= "<td><img src='../images/therapists/$profile_image' alt='image' style='width:150px;height:150px;border-radius:50%;'></td>";

                switch ($statusID) {
                    case 2:
                        $therapist_Table .= "<td style='color:green;font-size:20px;font-weight:bold;'>$status</td>";
                        break;
                    case 3:
                        $therapist_Table .= "<td style='color:red;font-size:20px;font-weight:bold;'>$status</td>";
                        break;
                    default:
                        $therapist_Table .= "<td style='color:black;font-size:20px;font-weight:bold;'>$status</td>";
                        break;
                }
                $therapist_Table .= "<td>";
                if ($statusID == '1') {
                    $therapist_Table .= "<button name='accept' type='submit' class='btn btn-outline-success' onclick='return confirm(\"Are you sure you want to Accept?\")' value='$id' style='display:block' form='theraTable' id='accept'>Accept</button>&nbsp;";
                    $therapist_Table .= "<button name='reject' type='submit' class='btn btn-outline-danger'  onclick='return confirm(\"Are you sure you want to Reject?\")' value='$id' style='display:block' form='theraTable' id='reject'>Reject</button>&nbsp;|&nbsp;";
                }
                $therapist_Table .= "<button class='btn btn-success thera' id='thera' data-toggle='modal'  data-target='#therapistDetail' data-theraid='$id' data-therafname='$name_first' data-theralname='$name_last' data-theraabout='$about' data-theragender='$gender' data-theraage='$age' data-theraemail='$email' data-theraphone='$phone' data-theraic='$ic' data-theraaddress='$address' data-theracity='$therapist_city' data-therapost='$therapist_postCode' data-therastate='$therapist_state' data-education='$education_level' data-theraresume='../images/certificate/$resume' data-theraprofile='../images/therapists/$profile_image' data-theramalay='$malay' data-theramandarin='$mandarin' data-theraenglish='$english'>Details</button> &nbsp;";
                $therapist_Table .= "<button name='delete' id='delete' form='theraTable' type='submit' class='btn btn-danger' value='$id' onclick='return confirm(\"Are you sure you want to delete?\")' style='display:block'>Delete</button></td></tr>";
            }
        }
        $therapist_Table .= "</tbody></table>";

        echo $therapist_Table;
    } else {
        $search = $_POST['searchTxt'];
        $sql = "SELECT * FROM therapist LEFT JOIN onstatus on therapist.statusID=onstatus.id LEFT JOIN language on therapist.therapist_id=language.thera_ID where therapist_id LIKE '%" . $search . "%' or name_first LIKE '%" . $search . "%' or name_last LIKE '%" . $search . "%' ORDER BY created_at DESC"; //id is database name
        $result = $conn->query($sql) or die($conn->error . __LINE__);
        $therapist_Table = "<table class='table table-striped custab'>";
        $therapist_Table .= "<thead><tr>";
        $therapist_Table .= "<th>ID</th>";
        $therapist_Table .= "<th>Name</th>";
        $therapist_Table .= "<th>Profile Image</th>";
        $therapist_Table .= "<th>Status</th>";
        $therapist_Table .= "<th class='text-center'>Action</th>";
        $therapist_Table .= "</tr></thead><tbody>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $about = $row['about'];
                $email = $row['email'];
                $gender = $row['gender'];
                $age = $row['age'];
                $phone = $row['phone'];
                $ic = $row['ic'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $resume = $row['resume'];
                $profile_image = $row['profile_image'];
                $statusID = $row['statusID'];
                $created_at = $row['created_at'];
                $status = $row['status'];
                $malay = $row['Malay'];
                $mandarin = $row['Mandarin'];
                $english = $row['English'];

                $user_time1 = strtotime($created_at);

                $therapist_Table .= "<tr><td>$id</td>";
                $therapist_Table .= "<td>$name_first&nbsp;$name_last</td>";
                $therapist_Table .= "<td><img src='../images/therapists/$profile_image' alt='image' style='width:150px;height:150px;border-radius:50%;'></td>";

                switch ($statusID) {
                    case 2:
                        $therapist_Table .= "<td style='color:green;font-size:20px;font-weight:bold;'>$status</td>";
                        break;
                    case 3:
                        $therapist_Table .= "<td style='color:red;font-size:20px;font-weight:bold;'>$status</td>";
                        break;
                    default:
                        $therapist_Table .= "<td style='color:black;font-size:20px;font-weight:bold;'>$status</td>";
                        break;
                }
                $therapist_Table .= "<td>";
                if ($statusID == '1') {
                    $therapist_Table .= "<button name='accept' type='submit' class='btn btn-outline-success' onclick='return confirm(\"Are you sure you want to Accept?\")' value='$id' style='display:block' form='theraTable' id='accept'>Accept</button>&nbsp;";
                    $therapist_Table .= "<button name='reject' type='submit' class='btn btn-outline-danger'  onclick='return confirm(\"Are you sure you want to Reject?\")' value='$id' style='display:block' form='theraTable' id='reject'>Reject</button>&nbsp;|&nbsp;";
                }
                $therapist_Table .= "<button class='btn btn-success thera' id='thera' data-toggle='modal'  data-target='#therapistDetail' data-theraid='$id' data-therafname='$name_first' data-theralname='$name_last' data-theraabout='$about' data-theragender='$gender' data-theraage='$age' data-theraemail='$email' data-theraphone='$phone' data-theraic='$ic' data-theraaddress='$address' data-theracity='$therapist_city' data-therapost='$therapist_postCode' data-therastate='$therapist_state' data-education='$education_level' data-theraresume='../images/certificate/$resume' data-theraprofile='../images/therapists/$profile_image' data-theramalay='$malay' data-theramandarin='$mandarin' data-theraenglish='$english'>Details</button> &nbsp;";
                $therapist_Table .= "<button name='delete' form='theraTable' type='submit' class='btn btn-danger' value='$id' onclick='return confirm(\"Are you sure you want to delete?\")' style='display:block' id='delete'>Delete</button></td></tr>";
            }
        }
        $therapist_Table .= "</tbody></table>";
        echo $therapist_Table;
    }
}

// if delete
if (isset($_POST['delete'])) {
    $deleteID = $_POST['delete']; //id

    $sql = "delete from therapist where therapist_id='$deleteID'"; //delete where therapist_id == this.id
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    header('refresh: 0; url=therapistTable.php');
}

//if accept
if (isset($_POST['accept'])) {
    $emailTo;

    $id = $_POST['accept']; //id
    $statusID = 2;
    $sql = "update therapist set statusID='$statusID' where therapist_id='$id'"; //set status=2 where therapist_id == this.id
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    $sqli = "SELECT * FROM therapist where therapist_id='$id'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);

    if ($run->num_rows > 0) {
        while ($row = $run->fetch_array()) {
            $emailTo = $row['email'];

            $code = uniqid(true);
            $query = mysqli_query($conn, "insert into notification(code,email) values ('$code','$emailTo')");
            if (!$query) { //false
                exit("Error");
            }
            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings         
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'ddwq1.12@gmail.com';                     // SMTP username
                $mail->Password   = '59Odwq234Fa';                               // SMTP password                          // SMTP password
                $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients - sender
                $mail->setFrom('company-Mail-test@gmail.com', 'Security Mail Company');
                $mail->addAddress($emailTo);     // Add a recipient
                $mail->addReplyTo('no-reply@gmail.com', 'No reply');

                // Content
                $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER['PHP_SELF']) . "/../therapistLogin.php";

                $mail->Subject = 'Your Register get Approved';
                $mail->Body    = "<h3>We would like to inform you that we have accepted your registration, you can login your therapist account through this <a href='$url'>link</a></h3>";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                header('refresh: 0; url=therapistTable.php');
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            exit();
        }
    }
    header('refresh: 0; url=therapistTable.php');
}


//if reject
if (isset($_POST['reject'])) {
    $id = $_POST['reject']; //id
    $statusID = 3;
    $sql = "update therapist set statusID='$statusID' where therapist_id='$id'"; //set status=3 where therapist_id == this.id
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    $sqli = "SELECT * FROM therapist where therapist_id='$id'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);

    if ($run->num_rows > 0) {
        while ($row = $run->fetch_array()) {
            $emailTo = $row['email'];

            $code = uniqid(true);
            $query = mysqli_query($conn, "insert into notification(code,email) values ('$code','$emailTo')");
            if (!$query) { //false
                exit("Error");
            }
            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings         
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'ddwq1.12@gmail.com';                     // SMTP username
                $mail->Password   = '59Odwq234Fa';                               // SMTP password        // SMTP password
                $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients - sender
                $mail->setFrom('company-Mail-test@gmail.com', 'Security Mail Company');
                $mail->addAddress($emailTo);     // Add a recipient
                $mail->addReplyTo('no-reply@gmail.com', 'No reply');

                // Content

                $mail->Subject = 'Your Register get Rejected';
                $mail->Body    = "<h1>We would like to inform you that your registration has been rejected, sorry for inconvenience</h1>";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                header('refresh: 0; url=therapistTable.php');
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            exit();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="../images/Logo.jpg" type="image/x-icon" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>C & H</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />

    <style>
        #logout,
        #thera,
        #searchBtn,
        #accept,
        #reject,
        #delete {
            cursor: pointer;
        }

        @media (min-width: 576px) {
            .modal-dialog {
                margin: -600px auto !important;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="../images/Logo.jpg" data-color="blue">
            <div class="sidebar-wrapper">
                <div class="logo" align="Center">
                    C & H
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="appointmentTable.php">
                            <i class="nc-icon nc-notes"></i>
                            <p>Appointment Table List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="feedbackTable.php">
                            <i class="nc-icon nc-notes"></i>
                            <p>Feedback Table List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reportTable.php">
                            <i class="nc-icon nc-notes"></i>
                            <p>Report Table List</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="paymentTable.php">
                            <i class="nc-icon nc-notes"></i>
                            <p>Payment Table List</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="reviewTable.php">
                            <i class="nc-icon nc-notes"></i>
                            <p>Review Table List</p>
                            <?php if ($totalReview != 0) {
                            echo "<span class=\"badge badge-danger\" style=\"padding:7px;font-size:20px;\">$totalReview</span>";
                        } ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="clientTable.php">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>Client Profile</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="therapistTable.php">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>Therapist Profile</p>
                            <?php if ($totalThera != 0) {
                            echo "<span class=\"badge badge-danger\" style=\"padding:7px;font-size:20px;\">$totalThera</span>";
                        } ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand">Admin</a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <center><button class="btn btn-danger" name="logout" id="logout">
                                    <span class="no-icon">Log out</span>
                                </button></center>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover" style="padding-left:10px;padding-right:10px;">
                                <div class="card-header ">
                                    <h4 class="card-title">Therapist Table List</h4>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <form action="therapistTable.php" method="POST" id="theraTable"></form>
                                    <h3>Search</h3>
                                    <input type="search" name="searchTxt" id="searchTxt" class="form-control" form="theraTable" style="width:50%;display:inline-block">
                                    <input type="submit" name="searchBtn" id="searchBtn" class="btn btn-primary" value="Search" style="margin-top:-5px;" form="theraTable">
                                    <br />
                                    <br />
                                    <?php echo therapist_Table() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="therapistDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle" style="color:rgb(34, 19, 48)" id="therapistName">Personal Information</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="inverse">
                        <center><img src="" style="width: 200px; height: 200px;margin-bottom:10px;" class="img rounded-circle" alt="profile" id="image"></center>
                    </div>

                    <div class="col">
                        <h4 style="color:rgb(34, 19, 48)">ID</h4>
                        <input type="text" readonly name="id" id="id" class="form-control">
                    </div>

                    <div class="row" style="margin-top:30px;">
                        <div class="col">
                            <h4 style="color:rgb(34, 19, 48);margin-left: 18px;">First Name</h4>
                            <input type="text" readonly name="firstname" id="firstname" class="form-control" style="max-width: 250px;margin-left: 15px;">
                        </div>

                        <div class="col">
                            <h4 style="color:rgb(34, 19, 48)">Last Name</h4>
                            <input type="text" readonly name="lastName" id="lastName" class="form-control" style="max-width: 250px;">
                        </div>
                    </div>

                    <div class="col">
                        <h4 style="color:rgb(34, 19, 48)">Email</h4>
                        <input type="email" readonly name="email" id="email" class="form-control">
                    </div>

                    <div class="col">
                        <h4 style="color:rgb(34, 19, 48)">About</h4>
                        <textarea readonly name="about" id="about" cols="100" rows="5" class="form-control"></textarea>
                    </div>

                    <div class="col" style="margin-bottom:10px;">
                        <h4 style="color:rgb(34, 19, 48)">Gender</h4>
                        <input type="text" readonly name="gender" id="gender" class="form-control"">
                    </div>

                    <div class=" col" style="margin-bottom:10px;">
                        <h4 style="color:rgb(34, 19, 48)">Language</h4>

                    </div>

                    <div class="col">
                        <h4 style="color:rgb(34, 19, 48)">Age</h4>
                        <input type="text" readonly name="age" id="age" class="form-control">
                    </div>

                    <div class="col">
                        <h4 style="color:rgb(34, 19, 48)">Phone</h4>
                        <input type="tel" readonly name="phone" id="phone" class="form-control">
                    </div>

                    <div class="col">
                        <h4 style="color:rgb(34, 19, 48)">IC</h4>
                        <input type="tel" readonly name="ic" id="ic" class="form-control">
                    </div>

                    <div class="col">
                        <h4 style="color:rgb(34, 19, 48)">Address</h4>
                        <input type="text" readonly name="address" id="address" class="form-control">
                    </div>

                    <div class="col">
                        <h4 style="color:rgb(34, 19, 48)">City</h4>
                        <input type="text" readonly name="city" id="city" class="form-control">
                    </div>

                    <div class="col">
                        <h4 style="color:rgb(34, 19, 48)">Post Code</h4>
                        <input type="text" readonly name="postCode" id="postCode" class="form-control">
                    </div>

                    <div class="col">
                        <h4 style="color:rgb(34, 19, 48)">State</h4>
                        <input type="text" readonly name="state" id="state" class="form-control">
                    </div>

                    <div class="col">
                        <h4 style="color:rgb(34, 19, 48)">Education Level</h4>
                        <input type="text" readonly name="education" id="education" class="form-control">
                    </div>

                    <div class="col">
                        <h4 style="color:rgb(34, 19, 48)">Resume</h4>
                        <!-- <input type="text" readonly name="resume" id="resume" class="form-control"> -->
                        <a href="" target="_blank" id="resume" download></a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="assets/js/plugins/bootstrap-switch.js"></script>
<!--  Chartist Plugin  -->
<script src="assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>
<script src="../js/main.js" type="text/javascript"></script>

</html>