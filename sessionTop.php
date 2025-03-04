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

date_default_timezone_set('Singapore');
mysqli_set_charset($conn, 'utf8');
session_start();


if (isset($_POST['logout'])) {
  session_destroy();
  header('refresh: 0; url=Home.php');
}

$date1 = date("Y-m-d"); // get the current date
$time1 = date("h:i a"); //get the current time

$appointmentNumTop = 0;

if (isset($_SESSION['client_id'])) { //if already login
  $id = $_SESSION['client_id'];

  $sql = "select * from client where id ='$id'"; //id is database name
  $result = $conn->query($sql);

  if ($result->num_rows > 0) { //over 1 database(record) so run
    while ($row = $result->fetch_assoc()) {
      $_SESSION['client_id'] = $row['id'];
      $_SESSION['client_name_first'] = $row['name_first'];
      $_SESSION['client_name_last'] = $row['name_last'];
      $_SESSION['client_email'] = $row['email'];
      $_SESSION['client_birth'] = $row['birth'];
      $_SESSION['client_phone'] = $row['phone'];
      $_SESSION['client_address'] = $row['address'];
      $_SESSION['client_city'] = $row['city'];
      $_SESSION['client_state'] = $row['state'];
      $_SESSION['client_post_code'] = $row['post_code'];
      $_SESSION['client_profileImage'] = $row['profileImage'];
    }
  }



  $topAll = "SELECT * from appointment left join therapist on appointment.therapist_ID=therapist.therapist_id left join onstatus on appointment.appointment_status=onstatus.id where user_Email='" . $_SESSION['client_email'] . "' and appointment_status='2' ORDER BY created_TIME DESC";
  $getAllNum1 = $conn->query($topAll) or die($conn->error . __LINE__);
  if ($getAllNum1->num_rows > 0) {
    while ($row = $getAllNum1->fetch_assoc()) {
      ++$appointmentNumTop;
    }
  }

  $topMysql = "SELECT * from appointment left join therapist on appointment.therapist_ID=therapist.therapist_id left join onstatus on appointment.appointment_status=onstatus.id where user_Email='" . $_SESSION['client_email'] . "' and user_date <='$date1' and (appointment_status='2' or appointment_status='5' or appointment_status='6') ORDER BY created_TIME DESC";
  $getTodayNum1 = $conn->query($topMysql) or die($conn->error . __LINE__);
  if ($getTodayNum1->num_rows > 0) {
    while ($row = $getTodayNum1->fetch_assoc()) {
      $appointment_status = $row['appointment_status'];
      if ($appointment_status == '5') {
        ++$appointmentNumTop;
      }
    }
  }


  $topPaid = "SELECT * from appointment left join therapist on appointment.therapist_ID=therapist.therapist_id left join onstatus on appointment.appointment_status=onstatus.id where user_Email='" . $_SESSION['client_email'] . "' and appointment_status='2' and user_date>'$date1' and paymentStatus='1'";
  //get the payment
  $getTopPaid = $conn->query($topPaid) or die($conn->error . __LINE__);

  if ($getTopPaid->num_rows > 0) {
    while ($row = $getTopPaid->fetch_assoc()) {
      $appointment_status = $row['appointment_status'];
      ++$appointmentNumTop;
    }
  }

  $checkReject1 = "SELECT * from appointment where user_Email='" . $_SESSION['client_email'] . "' and appointment_status='3'";
  $runReject1 = $conn->query($checkReject1) or die($conn->error . __LINE__);

  if ($runReject1->num_rows > 0) {
    while ($row = $runReject1->fetch_assoc()) {
      ++$appointmentNumTop;
    }
  }
}



//check the pathinfo and upload the file
function upload_profile($path, $file)
{
  $targetDir = $path;
  $default = "beard.png";

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
        return $filename;
      }
    }
  }
  // return default image
  return $default;
}

function upload_Editprofile($path, $file)
{
  $targetDir = $path;
  $default = $_SESSION['client_profileImage'];

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
        return $filename;
      }
    }
  }
  // return default image
  return $default;
}


// upload user's certificate
function upload_certificate($path, $file)
{
  $targetDir = $path;
  $default = "beard.png";
  // get the filename
  $filename = basename($file['name']);
  $targetFilePath = $targetDir . $filename;
  $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

  if (!empty($filename)) {
    // allow certain file format
    $allowType = array('doc', 'docx', 'pdf');
    if (in_array($fileType, $allowType)) {
      // upload file to the server
      if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        return $filename;
      }
    }
  } else {
    // return default image
    return '';
  }
}

//upload user image
function upload_thera($path, $file)
{
  $targetDir = $path;
  $default = "beard.png";
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
        return $filename;
      }
    }
  }
  return $default;
}


//prevent injection
function validate_input_text($textValue)
{
  if (!empty($textValue)) {
    $trim_text = trim($textValue);
    // remove illegal character
    $sanitize_str = filter_var($trim_text, FILTER_SANITIZE_STRING);
    return $sanitize_str;
  }
  return '';
}

//prevent injection
function validate_input_email($emailValue)
{
  if (!empty($emailValue)) {
    $trim_text = trim($emailValue);
    // remove illegal character
    $sanitize_str = filter_var($trim_text, FILTER_SANITIZE_EMAIL);
    return $sanitize_str;
  }
  return '';
}
