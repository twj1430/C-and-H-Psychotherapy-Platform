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

// if delete
if (isset($_POST['delete'])) {
    $deleteID = $_POST['delete']; //id

    $sql = "delete from payments where appointmentID='$deleteID'"; //delete where therapist_id == this.id
    $result = $conn->query($sql) or die($conn->error . __LINE__);
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
                    <li class="nav-item active">
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
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <h4 class="card-title">Payment Table List</h4>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <form action="paymentTable.php" method="POST">
                                        <table class="table table-striped custab">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>receiptID</th>
                                                    <th>Amount</th>
                                                    <th>appointmentID</th>
                                                    <th>created_time</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM payments"; //id is database name
                                                $result = $conn->query($sql) or die($conn->error . __LINE__);

                                                if ($result->num_rows > 0) { //over 1 database(record) so run
                                                    while ($row = $result->fetch_assoc()) {
                                                        //display result
                                                        $id = $row['id'];
                                                        $name = $row['name'];
                                                        $email = $row['email'];
                                                        $receiptID = $row['receiptID'];
                                                        $amount = $row['amount'];
                                                        $appointmentID = $row['appointmentID'];
                                                        $created_time = $row['created_time'];
                                                ?>

                                                        <tr>
                                                            <td><?php echo $id ?></td>
                                                            <td><?php echo $name ?></td>
                                                            <td><?php echo $email ?></td>
                                                            <td><?php echo $receiptID ?></td>
                                                            <td><?php echo $amount ?></td>
                                                            <td><?php echo $appointmentID ?></td>
                                                            <td><?php echo $created_time ?></td>
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

</html>