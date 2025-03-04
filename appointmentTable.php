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

// if delete
if (isset($_POST['delete'])) {
    $deleteID = $_POST['delete']; //id

    $sql = "delete from appointment where appointment_id='$deleteID'"; //delete where therapist_id == this.id
    $result = $conn->query($sql) or die($conn->error . __LINE__);
}


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <link rel="icon" href="images/Logo.jpg" type="image/x-icon" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <title>C&H</title>
</head>
<style>
    .custab {
        border: 1px solid #ccc;
        padding: 5px;
        margin: 5% 0;
        box-shadow: 3px 3px 2px #ccc;
        transition: 0.5s;
        text-align: center;
    }

    .custab:hover {
        box-shadow: 3px 3px 0px transparent;
        transition: 0.5s;
    }

    button.btn {
        margin-bottom: 10px;
    }
</style>

<body>
    <form action="appointmentTable.php" method="POST" enctype="multipart/form-data">
        <div class="container" align="center" style="position:relative">
            <div class="row col-md-12 col-md-offset-3">
                <a href="Admin.php">
                    <h4 style="padding-top:20px;">Back</h4>
                </a>
                <h4 style="position:absolute;top:20px;right:40%;">Appointment Table</h4>
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
                                        } else {
                                            echo "<span style='color:red'>No</span>";
                                        } ?></td>
                                    <td><?php echo $created_TIME ?></td>

                                    <td class="text-center">
                                        <button name="delete" type="submit" class="btn btn-danger btn-xs" value="<?php echo $appointment_id ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                    </td>
                                </tr>
                        <?php
                            } //end while
                        } //end if
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</body>

</html>