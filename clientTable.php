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
	echo "<script>window.alert('You cannot directly access this page!!');window.location.assign('adminLogin.php')</script>";
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
                $client_Table .= "<td><img src='$profile_image' alt='image' style='width:150px;height:150px;border-radius:50%;'></td>";
                $client_Table .= "<td>$user_time2</td>";

                $client_Table .= "<td><center><button class='btn btn-success btn-xs client' data-toggle='modal'  data-target='#clientDetail' data-clientid='$id' data-clientfname='$name_first' data-clientlname='$name_last' data-clientemail='$email' data-clientbirth='$birth' data-clientphone='$phone' data-clientaddress='$address' data-clientcity='$city' data-clientpost='$post_code' data-clientstate='$state' data-clientimage='$profile_image'>Details</button></center>";
                $client_Table .= "<center><button name='delete' form='clientTable' type='submit' class='btn btn-danger btn-xs my-2' value='$id' onclick='return confirm(\"Are you sure you want to delete?\")' style='display:block'>Delete</button></center></td></tr>";
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
                $client_Table .= "<td><img src='$profile_image' alt='image' style='width:150px;height:150px;border-radius:50%;'></td>";
                $client_Table .= "<td>$user_time2</td>";

                $client_Table .= "<td><center><button class='btn btn-success btn-xs client' data-toggle='modal'  data-target='#clientDetail' data-clientid='$id' data-clientfname='$name_first' data-clientlname='$name_last' data-clientemail='$email' data-clientbirth='$birth' data-clientphone='$phone' data-clientaddress='$address' data-clientcity='$city' data-clientpost='$post_code' data-clientstate='$state' data-clientimage='$profile_image'>Details</button></center>";
                $client_Table .= "<center><button name='delete' form='clientTable' type='submit' class='btn btn-danger btn-xs my-2' value='$id' onclick='return confirm(\"Are you sure you want to delete?\")' style='display:block'>Delete</button></center></td></tr>";
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
                $client_Table .= "<td><img src='$profile_image' alt='image' style='width:150px;height:150px;border-radius:50%;'></td>";
                $client_Table .= "<td>$user_time2</td>";

                $client_Table .= "<td><center><button class='btn btn-success btn-xs client' data-toggle='modal'  data-target='#clientDetail' data-clientid='$id' data-clientfname='$name_first' data-clientlname='$name_last' data-clientemail='$email' data-clientbirth='$birth' data-clientphone='$phone' data-clientaddress='$address' data-clientcity='$city' data-clientpost='$post_code' data-clientstate='$state' data-clientimage='$profile_image'>Details</button></center>";
                $client_Table .= "<center><button name='delete' form='clientTable' type='submit' class='btn btn-danger btn-xs my-2' value='$id' onclick='return confirm(\"Are you sure you want to delete?\")' style='display:block'>Delete</button></center></td></tr>";
            }
        }
        $client_Table .= "</tbody></table>";
        echo $client_Table;
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="icon" href="images/Logo.jpg" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="project.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>C&H</title>
</head>
<style>
    .custab {
        border: 1px solid #ccc;
        padding: 5px;
        margin: 2% 0;
        box-shadow: 3px 3px 2px #ccc;
        transition: 0.5s;
    }

    .custab:hover {
        box-shadow: 3px 3px 0px transparent;
        transition: 0.5s;
    }
</style>

<body>
    <form action="clientTable.php" method="POST" enctype="multipart/form-data" id="clientTable"></form>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="Admin.php">
                        <h4 style="padding-top:20px;">Back</h4>
                    </a>
                    <center>
                        <h4 style="padding-top:20px;">Clients Table</h4>
                    </center>
                    <h3>Search</h3>
                    <input type="search" name="searchTxt" id="searchTxt" class="form-control" form="clientTable" style="width:50%;display:inline-block">
                    <input type="submit" name="searchBtn" id="searchBtn" class="btn btn-primary" value="Search" style="margin-top:-5px;" form="clientTable">
                    <br />
                    <br />
                    <?php echo client_Table() ?>
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
    <script src="js/main.js" type="text/javascript"></script>
</body>

</html>