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
    $sql = "delete from review where review_ID='$deleteID'"; //delete where therapist_id == this.id
    $result = $conn->query($sql) or die($conn->error . __LINE__);
}

if (isset($_POST['approve'])) {
    $id = $_POST['approve']; //id
    $statusID = 2;
    $sql = "update review set checkReview='$statusID' where review_ID='$id'"; //set status=2 where therapist_id == this.id
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
    <form action="reviewTable.php" method="POST" enctype="multipart/form-data">
        <div class="container" align="center" style="position:relative">
            <div class="row col-md-12 col-md-offset-3">
                <a href="Admin.php">
                    <h4 style="padding-top:20px;">Back</h4>
                </a>
                <h4 style="position:absolute;top:20px;right:43%;">Review Table</h4>
                <table class="table table-striped custab">
                    <thead>
                        <tr>
                            <th>Review ID</th>
                            <th>Appointment ID</th>
                            <th>Client Name</th>
                            <th>Therapit</th>
                            <th>Review</th>
                            <th>Create Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM review left join therapist on review.Therapist_ID=therapist.therapist_id"; //id is database name
                        $result = $conn->query($sql) or die($conn->error . __LINE__);

                        if ($result->num_rows > 0) { //over 1 database(record) so run
                            while ($row = $result->fetch_assoc()) {
                                //display result
                                $review_ID = $row['review_ID'];
                                $Appointment_ID = $row['Appointment_ID'];
                                $client_Name = $row['client_Name'];
                                $review = $row['review'];
                                $checkReview = $row['checkReview'];
                                $Created_Time = $row['Created_Time'];
                                $therapist = $row['name_first'] . "&nbsp;" . $row['name_last'];
                        ?>

                                <tr>
                                    <td><?php echo $review_ID ?></td>
                                    <td><?php echo $Appointment_ID ?></td>
                                    <td><?php echo $client_Name ?></td>
                                    <td><?php echo $therapist ?></td>
                                    <td><?php echo $review ?></td>
                                    <td><?php echo $Created_Time ?></td>
                                    <td class="text-center">
                                        <?php if ($checkReview == '1') {
                                            echo "<center><button name='approve' type='submit' class='btn btn-outline-success btn-xs' onclick='return confirm(\"Are you sure you want to Approve this review display on the client review page??\")' value='$review_ID' style='display:block'>Approve</button></center>";
                                        } ?>
                                        <button name="delete" type="submit" class="btn btn-danger btn-xs" value="<?php echo $review_ID ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
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