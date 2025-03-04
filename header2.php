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

mysqli_set_charset($conn, 'utf8');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/appointment.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/FAQ.css">>
    <link rel="stylesheet" type="text/css" href="css/Admin.css">


    <!-- jQuery library -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


</head>

<html>
<html lang="en">

<header id="header2">
    <!-- nav bar -->
    <form action="header2.php" method="post">
        <!-- nav bar -->
        <nav class="navbar navbar-expand-md bg-warning navbar-dark fixed-top" style="position:fixed;background-image: linear-gradient( 89.2deg,  rgba(191,241,236,1) 22.3%, rgba(109,192,236,1) 84.1% );">
            <!-- Brand -->
            <a class="navbar-brand" href="Home.php">Logo</a>

            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar links -->
            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2 " id="collapsibleNavbar">

                <ul class="navbar-nav ml-auto">

                    <li class="nav-item active" style="font-family:Times New Roman;color:black;">
                        <a class="nav-link" href="Appointment.php" style="color:black;">Appointment</a>
                    </li>

                    <li class="nav-item active" style="font-family:Times New Roman;">
                        <a class="nav-link" href="Home.php" style="color:black;">Log out</a>
                    </li>


                </ul>
            </div>
        </nav>
    </form>
</header>

</html>