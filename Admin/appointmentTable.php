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

// if delete
if (isset($_POST['delete'])) {
    $deleteID = $_POST['delete']; //id

    $sql = "delete from appointment where appointment_id='$deleteID'"; //delete where therapist_id == this.id
    $result = $conn->query($sql) or die($conn->error . __LINE__);
}


if (isset($_POST['logout'])) {
    session_destroy();
    header('refresh: 0; url=../adminLogin.php');
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
        #delete {
            cursor: pointer;
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
                    <li class="nav-item active">
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

                    <li class="nav-item">
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
                            <center><button class="btn btn-danger" name="logout" id="logout" form="appointmentLog">
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
                        <div class="col-md-12 appointment">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <h4 class="card-title">Appointment Table List</h4>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <form action="appointmentTable.php" method="POST" id="appointmentLog">
                                        <table class="table table-striped custab">
                                            <thead>
                                                <tr>
                                                    <th>Appointment ID</th>
                                                    <th>User_Email</th>
                                                    <th>Method</th>
                                                    <th>Date</th>
                                                    <th>Therapist</th>
                                                    <th class="text-center">Payment Status</th>
                                                    <th>created_TIME</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM appointment left join therapist on appointment.therapist_ID=therapist.therapist_id"; //id is database name
                                                $result = $conn->query($sql) or die($conn->error . __LINE__);

                                                if ($result->num_rows > 0) { //over 1 database(record) so run
                                                    while ($row = $result->fetch_assoc()) {
                                                        //display result
                                                        $appointment_id = $row['appointment_id'];
                                                        $user_Email = $row['user_Email'];
                                                        $user_method = $row['user_method'];
                                                        $user_date = $row['user_date'];
                                                        $paymentStatus = $row['paymentStatus'];
                                                        $created_TIME = $row['created_TIME'];
                                                        $therapist = $row['name_first'] . "&nbsp;" . $row['name_last'];
                                                ?>

                                                        <tr>
                                                            <td><?php echo $appointment_id ?></td>
                                                            <td><?php echo $user_Email ?></td>
                                                            <td><?php echo $user_method ?></td>
                                                            <td><?php echo $user_date ?></td>
                                                            <td><?php echo $therapist ?></td>
                                                            <td><?php if ($paymentStatus == "2") {
                                                                    echo "<span style='color:green;font-size:25px;font-weight:600'>Paid</span>";
                                                                } else if ($paymentStatus == "1") {
                                                                    echo "<span style='color:red;font-size:25px;font-weight:600'>No</span>";
                                                                } else {
                                                                    echo "<span style='color:black;font-size:25px;font-weight:600'>-</span>";
                                                                } ?></td>
                                                            <td><?php echo $created_TIME ?></td>

                                                            <td class="text-center">
                                                                <button name="delete" type="submit" class="btn btn-danger" value="<?php echo $appointment_id ?>" onclick="return confirm('Are you sure you want to delete?')" id="delete">Delete</button>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    } //end while
                                                } //end if
                                                ?>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        demo.showNotification();

    });
</script>

</html>