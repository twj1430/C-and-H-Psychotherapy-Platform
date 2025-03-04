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

if (isset($_POST['delete'])) {
    $deleteID = $_POST['delete'];

    $sql = "delete from client where id='$deleteID'";
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result == true) {
        echo '<script>window.alert("Delete Successful....!!!!")</script>';
    }
}

function client_Table()
{
    $servername = "localhost"; //localhost for local PC or use IP address
    $username = "root"; //database name
    $password = ""; //database password
    $database = "oncoun"; //database name

    // Create connection #scawx
    $conn = new mysqli($servername, $username, $password, $database);

    if (!isset($_POST['searchBtn'])) {
        $sql = "SELECT * FROM client"; //id is database name
        $result = $conn->query($sql) or die($conn->error . __LINE__);

        $client_Table = "<table class='table table-striped custab'>";
        $client_Table .= "<thead><tr>";
        $client_Table .= "<th>ID</th>";
        $client_Table .= "<th>Name</th>";
        $client_Table .= "<th>Profile Image</th>";
        $client_Table .= "<th>Created_Time</th>";
        $client_Table .= "<th class='text-center'>Action</th>";
        $client_Table .= "</tr></thead><tbody>";

        $number_of_results = mysqli_num_rows($result);
        //define how many results you want per page
        $results_per_page = 3;

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
        $sqli = "SELECT * FROM client ORDER BY create_time DESC LIMIT  " . $this_page_first_result . ',' . $results_per_page;

        $results = mysqli_query($conn, $sqli) or die($conn->error . __LINE__);

        for ($page1 = 1; $page1 <= $number_of_pages; $page1++) {
            if ($page == $page1) {
                echo '<a href="clientTable.php?page=' . $page1 . '" class="btn btn-primary next" style="width:50px;margin-right:10px;">' . $page1 . '</a>';
            } else {
                echo '<a href="clientTable.php?page=' . $page1 . '" class="btn btn-outline-primary next" style="width:50px;margin-right:10px;">' . $page1 . '</a>';
            }
        }

        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $id = $row['id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $birth = $row['birth'];
                $phone = $row['phone'];
                $address = $row['address'];
                $city = $row['city'];
                $post_code = $row['post_code'];
                $state = $row['state'];
                $email = $row['email'];
                $profile_image = $row['profileImage'];
                $created_at = $row['create_time'];

                $user_time1 = strtotime($created_at);
                $user_time2 = date("d-m-Y h:i a", $user_time1);

                $client_Table .= "<tr><td>$id</td>";
                $client_Table .= "<td>$name_first&nbsp;$name_last</td>";
                $client_Table .= "<td><img src='../images/profile/$profile_image' alt='image' style='width:150px;height:150px;border-radius:50%;'></td>";
                $client_Table .= "<td>$user_time2</td>";

                $client_Table .= "<td><button class='btn btn-success client' id='client' data-toggle='modal'  data-target='#clientDetail' data-clientid='$id' data-clientfname='$name_first' data-clientlname='$name_last' data-clientemail='$email' data-clientbirth='$birth' data-clientphone='$phone' data-clientaddress='$address' data-clientcity='$city' data-clientpost='$post_code' data-clientstate='$state' data-clientimage='../images/profile/$profile_image'>Details</button> &nbsp;";
                $client_Table .= "<button name='delete' id='delete' form='clientTable' type='submit' class='btn btn-danger' value='$id' onclick='return confirm(\"Are you sure you want to delete?\")' style='display:block'>Delete</button></td></tr>";
            }
        }
        $client_Table .= "</tbody></table>";

        echo $client_Table;
    } else if ((isset($_POST['searchBtn'])) && (empty($_POST['searchTxt']))) {
        $sql = "SELECT * FROM client"; //id is database name
        $result = $conn->query($sql) or die($conn->error . __LINE__);

        $client_Table = "<table class='table table-striped custab'>";
        $client_Table .= "<thead><tr>";
        $client_Table .= "<th>ID</th>";
        $client_Table .= "<th>Name</th>";
        $client_Table .= "<th>Profile Image</th>";
        $client_Table .= "<th>Created_Time</th>";
        $client_Table .= "<th class='text-center'>Action</th>";
        $client_Table .= "</tr></thead><tbody>";

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
        $sqli = "SELECT * FROM client ORDER BY create_time DESC LIMIT  " . $this_page_first_result . ',' . $results_per_page;

        $results = mysqli_query($conn, $sqli) or die($conn->error . __LINE__);

        for ($page1 = 1; $page1 <= $number_of_pages; $page1++) {
            if ($page == $page1) {
                echo '<a href="clientTable.php?page=' . $page1 . '" class="btn btn-primary next" style="width:50px;margin-right:10px;">' . $page1 . '</a>';
            } else {
                echo '<a href="clientTable.php?page=' . $page1 . '" class="btn btn-outline-primary next" style="width:50px;margin-right:10px;">' . $page1 . '</a>';
            }
        }

        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $id = $row['id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $birth = $row['birth'];
                $phone = $row['phone'];
                $address = $row['address'];
                $city = $row['city'];
                $post_code = $row['post_code'];
                $state = $row['state'];
                $email = $row['email'];
                $profile_image = $row['profileImage'];
                $created_at = $row['create_time'];

                $user_time1 = strtotime($created_at);
                $user_time2 = date("d-m-Y h:i a", $user_time1);

                $client_Table .= "<tr><td>$id</td>";
                $client_Table .= "<td>$name_first&nbsp;$name_last</td>";
                $client_Table .= "<td><img src='../images/profile/$profile_image' alt='image' style='width:150px;height:150px;border-radius:50%;'></td>";
                $client_Table .= "<td>$user_time2</td>";

                $client_Table .= "<td><button class='btn btn-success client' id='client' data-toggle='modal'  data-target='#clientDetail' data-clientid='$id' data-clientfname='$name_first' data-clientlname='$name_last' data-clientemail='$email' data-clientbirth='$birth' data-clientphone='$phone' data-clientaddress='$address' data-clientcity='$city' data-clientpost='$post_code' data-clientstate='$state' data-clientimage='../images/profile/$profile_image'>Details</button> &nbsp;";
                $client_Table .= "<button name='delete' id='delete' form='clientTable' type='submit' class='btn btn-danger' value='$id' onclick='return confirm(\"Are you sure you want to delete?\")' style='display:block'>Delete</button></td></tr>";
            }
        }
        $client_Table .= "</tbody></table>";

        echo $client_Table;
    } else {
        $search = $_POST['searchTxt'];
        $sql = "SELECT * FROM client where id LIKE '%" . $search . "%' or name_first LIKE '%" . $search . "%' or name_last LIKE '%" . $search . "%' ORDER BY create_time DESC"; //id is database name
        $result = $conn->query($sql) or die($conn->error . __LINE__);
        $client_Table = "<table class='table table-striped custab'>";
        $client_Table .= "<thead><tr>";
        $client_Table .= "<th>ID</th>";
        $client_Table .= "<th>Name</th>";
        $client_Table .= "<th>Profile Image</th>";
        $client_Table .= "<th>Created_Time</th>";
        $client_Table .= "<th class='text-center'>Action</th>";
        $client_Table .= "</tr></thead><tbody>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $birth = $row['birth'];
                $phone = $row['phone'];
                $address = $row['address'];
                $city = $row['city'];
                $post_code = $row['post_code'];
                $state = $row['state'];
                $email = $row['email'];
                $profile_image = $row['profileImage'];
                $created_at = $row['create_time'];

                $user_time1 = strtotime($created_at);
                $user_time2 = date("d-m-Y h:i a", $user_time1);

                $client_Table .= "<tr><td>$id</td>";
                $client_Table .= "<td>$name_first&nbsp;$name_last</td>";
                $client_Table .= "<td><img src='../images/profile/$profile_image' alt='image' style='width:150px;height:150px;border-radius:50%;'></td>";
                $client_Table .= "<td>$user_time2</td>";

                $client_Table .= "<td><button class='btn btn-success client' id='client' data-toggle='modal'  data-target='#clientDetail' data-clientid='$id' data-clientfname='$name_first' data-clientlname='$name_last' data-clientemail='$email' data-clientbirth='$birth' data-clientphone='$phone' data-clientaddress='$address' data-clientcity='$city' data-clientpost='$post_code' data-clientstate='$state' data-clientimage='../images/profile/$profile_image'>Details</button> &nbsp;";
                $client_Table .= "<button name='delete' id='delete' form='clientTable' type='submit' class='btn btn-danger' value='$id' onclick='return confirm(\"Are you sure you want to delete?\")' style='display:block'>Delete</button></td></tr>";
            }
        }
        $client_Table .= "</tbody></table>";
        echo $client_Table;
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
    <link href="../assets/css/demo.css" rel="stylesheet" />

    <style>
        #logout,
        #client,
        #searchBtn,
        #delete {
            cursor: pointer;
        }

        @media (min-width: 576px) {
            .modal-dialog {
                margin: -420px auto !important;
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

                    <li class="nav-item active">
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
                            <div class="card strpied-tabled-with-hover" style="padding-left:10px;padding-right:10px;">
                                <div class="card-header ">
                                    <h4 class="card-title">Client Table List</h4>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <form action="clientTable.php" method="POST" id="clientTable"></form>
                                    <h3>Search</h3>
                                    <input type="search" name="searchTxt" id="searchTxt" class="form-control" form="clientTable" style="width:50%;display:inline-block">
                                    <input type="submit" name="searchBtn" id="searchBtn" class="btn btn-primary" value="Search" style="margin-top:-5px;" form="clientTable">
                                    <br />
                                    <br />
                                    <?php echo client_Table() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="clientDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                        <h4 style="color:rgb(34, 19, 48)">Birthday</h4>
                        <input type="text" readonly name="birth" id="birth" class="form-control">
                    </div>

                    <div class="col">
                        <h4 style="color:rgb(34, 19, 48)">Phone</h4>
                        <input type="tel" readonly name="phone" id="phone" class="form-control">
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