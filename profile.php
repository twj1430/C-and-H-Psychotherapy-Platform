<!-- <?php
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



if (isset($_POST['logout'])) {

    session_destroy();
    header('location:Home.php');
}


if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    $sql = "select * from client where id ='$id'"; //id is database name
    $result = $conn->query($sql);

    if ($result->num_rows > 0) { //over 1 database(record) so run
        while ($row = $result->fetch_assoc()) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['birth'] = $row['birth'];
            $_SESSION['phone'] = $row['phone'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['gender'] = $row['gender'];
            $_SESSION['profileImage'] = $row['profileImage'];
        }
    }
}

function upload_profile($path, $file)
{
    $targetDir = $path;
    $default = $_SESSION['profileImage'];

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
                return $targetFilePath;
            }
        }
    }
    // return default image
    return $default;
}

if (isset($_POST['edit'])) {
    $id = $_SESSION['id'];
    $name = $_POST['username'];
    $birth = $_POST['birth'];
    $Phone = $_POST['phone'];
    $Address = $_POST['address'];
    $files = $_FILES['profileUpload'];
    $password = $_POST['password'];
    $confirm_pwd = $_POST['confirm_pwd'];
    $profileImage = upload_profile('./images/profile/', $files);


    if (($password == $confirm_pwd)) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

        $sql = "update client set name='$name',birth='$birth',phone='$Phone',address='$Address',password='$hashed_pass',profileImage='$profileImage' where id='$id'";

        $result = $conn->query($sql) or die($conn->error.__LINE__);

        if ($result == true) {
            $_SESSION['name'] = $name;
            $_SESSION['birth'] = $birth;
            $_SESSION['phone'] = $Phone;
            $_SESSION['address'] = $Address;
            $_SESSION['profileUpload'] = $profileImage;
            echo '<script>window.alert("Edit done")</script>';
            header('Refresh: 0;');
        }
    } else {
        echo '<script>window.alert("Password are not match...!!")</script>';
    }
}
?>





<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>
<!DOCTYPE html>
<html lang="en">
<?php require_once("header1.php") ?>

<body>



    <section id="profile">

        <div class="container">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="profile-card">
                            <div class="profile-header">
                                <div class="user-image">
                                    <img src="<?php echo $_SESSION['profileImage'] ?>" class="img">
                                </div>
                            </div>

                            <div class="profile-content">
                                <div class="profile-name"><?php echo $_SESSION['name'] ?></div>
                            </div>
                        </div>
                    </div>

                    <form action="profile.php" method="POST" id="prof">
                        <div class="card">
                            <div class="card-body">

                                <p class="card-title font-weight-bold">About</p>


                                <hr>

                                <p class="card-description">Basic Information</p>
                                <ul class="about">
                                    <li class="about-items"><i class="mdi mdi-phone icon-sm "></i><span class="about-item-name">Phone:</span><span class="about-item-detail"><?php echo $_SESSION['email'] ?></span></li>
                                    <li class="about-items"><i class="mdi mdi-phone icon-sm "></i><span class="about-item-name">Phone:</span><span class="about-item-detail"><?php echo $_SESSION['phone'] ?></span></li>
                                    <li class="about-items"><i class="mdi mdi-map-marker icon-sm "></i><span class="about-item-name">Address:</span><span class="about-item-detail"><?php echo $_SESSION['address'] ?></span> </li>
                                </ul>

                                <ul class="about">
                                    <li class="about-items"><i class="mdi mdi-cake icon-sm "></i><span class="about-item-name">Birthday:</span><span class="about-item-detail"><?php echo $_SESSION['birth'] ?></span></li>
                                    <li class="about-items"><i class="mdi mdi-account icon-sm "></i><span class="about-item-name">Gender:</span><span class="about-item-detail"><?php echo $_SESSION['gender'] ?></span></li>
                                </ul>

                                <button type="button" class="btn" data-toggle="modal" data-target="#editModal" title="Edit" id="editProfile">Edit</button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal" title="Appointment History" id="history">Appointment History</button>
                                <input type="submit" class="btn btn-success" name="logout" id="logout" onclick="return confirm('Sure want to log out?')" title="logout" value="Log Out">

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include("editModal.php") ?>
    </section>



</body>

</html> -->