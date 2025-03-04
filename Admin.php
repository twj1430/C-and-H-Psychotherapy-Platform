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

if (isset($_POST['logout'])) {
	session_destroy();
	header('refresh: 0; url=adminLogin.php');
}
?>

<!doctype html>
<html lang="en">

<head>
	<link rel="icon" href="images/Logo.jpg" type="image/x-icon" />
	<title>C&H</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/Admin.css">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

	<style>
		body {
			padding-top: 20px;
			background-color: rgb(206, 230, 240) !important;
		}
	</style>
</head>

<body>
	<section id="admin">
		<div class="container">

			<!-- page-header -->
			<div class="page-header">
				<div class="container">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="page-caption">
								<form action="Admin.php" method="POST">
									<h1 class="page-title">Welcome <?php echo $_SESSION['admin_first_name'] . "&nbsp;" . $_SESSION['admin_last_name'] ?> &nbsp; &nbsp;
										<button class="btn btn-danger" name="logout">
											<h4>Log out</h4>
										</button></h1>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.page-header-->
			<div class="card text-center">
				<!-- <div class="card-header">
					<ul class="nav nav-tabs card-header-tabs">
						<li class="nav-item">
							<a class="nav-link active" href="dashboard.php">Dashboard</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="therapist.php">Therapist</a>
						</li>
						<li class="nav-item">
							<a class="nav-link disabled" href="client.php">Client</a>
						</li>
						<li class="nav-item">
							<a class="nav-link disabled" href="appointment.php">Appointment</a>
						</li>
					</ul>
				</div> -->
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="panel-body">
								<div class="row">
									<div class="col-xs-12 col-md-3 my-5">
										<a href="appointmentTable.php" class="btn btn-primary btn-lg w-75 h-100" role="button">
											<span class="glyphicon glyphicon-list-alt"></span><br />Appointment</a>
									</div>

									<div class="col-xs-12 col-md-3 my-5">
										<a href="paymentTable.php" class="btn btn-primary btn-lg w-75 h-100" role="button">
											<span class="glyphicon glyphicon-list-alt"></span><br />Payment List</a>
									</div>

									<div class="col-xs-12 col-md-3 my-5">
										<a href="reportTable.php" class="btn btn-primary btn-lg w-75 h-100" role="button">
											<span class="glyphicon glyphicon-signal"></span> <br />Reports</a>
									</div>


									<div class="col-xs-12 col-md-3 my-5">
										<a href="reviewTable.php" class="btn btn-primary btn-lg w-75 h-100" role="button">
											<span class="glyphicon glyphicon-comment"></span> <br />Reviews</a>
									</div>

									<div class="col-xs-12 col-md-3 my-5">
										<a href="feedbackTable.php" class="btn btn-primary btn-lg w-75 h-100" role="button">
											<span class="glyphicon glyphicon-user"></span> <br />Feedbacks</a>

									</div>

									<div class="col-xs-12 col-md-3 my-5">
										<a href="clientTable.php" class="btn btn-primary btn-lg w-75 h-100" role="button">
											<span class="glyphicon glyphicon-user"></span> <br />Client</a>
									</div>

									<div class="col-xs-12 col-md-3 my-5">
										<a href="therapistTable.php" class="btn btn-primary btn-lg w-75 h-100" role="button">
											<span class="glyphicon glyphicon-user"></span> <br />Therapist</a>

									</div>

								</div>

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	</div>
</body>


</html>