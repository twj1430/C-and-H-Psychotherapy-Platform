<?php
include("sessionTop.php");

//if submit the registration
if (isset($_POST['submit'])) {
  $generateid = uniqid(); //declare the unique id

  //if all the checkboxes haven't checked, will ask him checked again
  if ((empty($_REQUEST['Malay'])) && (empty($_REQUEST['English'])) && (empty($_REQUEST['Mandarin'])) && (empty($_REQUEST['specialties']))) {
    echo '<script>window.alert("Please checked at least one language and one specialty")</script>';
  } elseif ((empty($_REQUEST['Malay'])) && (empty($_REQUEST['English'])) && (empty($_REQUEST['Mandarin']))) {
    echo '<script>window.alert("Please checked at least one language")</script>';
  } else if (empty($_REQUEST['specialties'])) {
    echo '<script>window.alert("Please checked at least one specialty")</script>';
  } else { //if atleast one checkbox has been checked
    //insert the id
    $lan = "insert into language values('$generateid','','','')";
    $run = $conn->query($lan) or die($conn->error . __LINE__);

    if (empty($_REQUEST['Malay'])) {
      $updateLan = "update language set Malay='No' where thera_ID='$generateid'";
      $run1 = $conn->query($updateLan) or die($conn->error . __LINE__);
    } else {
      $updateLan = "update language set Malay='Yes' where thera_ID='$generateid'";
      $run1 = $conn->query($updateLan) or die($conn->error . __LINE__);
    }

    if (empty($_REQUEST['English'])) {
      $updateLan = "update language set English='No' where thera_ID='$generateid'";
      $run1 = $conn->query($updateLan) or die($conn->error . __LINE__);
    } else {
      $updateLan = "update language set English='Yes' where thera_ID='$generateid'";
      $run1 = $conn->query($updateLan) or die($conn->error . __LINE__);
    }

    if (empty($_REQUEST['Mandarin'])) {
      $updateLan = "update language set Mandarin='No' where thera_ID='$generateid'";
      $run1 = $conn->query($updateLan) or die($conn->error . __LINE__);
    } else {
      $updateLan = "update language set Mandarin='Yes' where thera_ID='$generateid'";
      $run1 = $conn->query($updateLan) or die($conn->error . __LINE__);
    }

    $error = array();

    $salutation = validate_input_text($_POST['salutation']);
    if (empty($salutation)) {
      $error[] = "You forgot to enter your salutation";
    }

    $education = validate_input_text($_POST['education']);
    if (empty($education)) {
      $error[] = "You forgot to enter your education level";
    }

    $gender = validate_input_text($_POST['gender']);
    if (empty($gender)) {
      $error[] = "You forgot to enter your gender";
    }

    $age = validate_input_text($_POST['age']);
    if (empty($age)) {
      $error[] = "You forgot to enter your age";
    }

    $firstname = validate_input_text($_POST['firstname']);
    if (empty($firstname)) {
      $error[] = "You forgot to enter your Name";
    }

    $lastname = validate_input_text($_POST['lastName']);
    if (empty($lastname)) {
      $error[] = "You forgot to enter your Name";
    }

    $email = validate_input_email($_POST['email']);
    if (empty($email)) {
      $error[] = "You forgot to enter your Email";
    }

    $phone = validate_input_text($_POST['phone']);
    $phone1 = "+6" . $phone;
    if (empty($phone1)) {
      $error[] = "You forgot to enter your phone number";
    }

    $address = mysqli_real_escape_string($conn, $_POST['address']);
    if (empty($address)) {
      $error[] = "You forgot to enter your address";
    }

    $state = validate_input_text($_POST['state']);
    if (empty($state)) {
      $error[] = "You forgot to enter your state";
    }

    $city = validate_input_text($_POST['city']);
    if (empty($city)) {
      $error[] = "You forgot to enter your city";
    }


    $postCode = validate_input_text($_POST['postCode']);
    if (empty($postCode)) {
      $error[] = "You forgot to enter your postCode";
    }

    $ic = mysqli_real_escape_string($conn, $_POST['ic']);
    if (empty($ic)) {
      $error[] = "You forgot to enter your ic";
    }

    $password = validate_input_text($_POST['password']);
    if (empty($password)) {
      $error[] = "You forgot to enter your password";
    }

    $confirm_pwd = validate_input_text($_POST['confirm_pwd']);
    if (empty($confirm_pwd)) {
      $error[] = "You forgot to enter your Confirm Password";
    }


    $file1 = $_FILES['certificate'];
    $fileCer = upload_certificate('./images/certificate/', $file1);
    if (empty($fileCer)) {
      $error[] = "You forgot to enter your certificate";
    }

    $files = $_FILES['profileUpload'];
    $profileImage = upload_thera('./images/therapists/', $files);
    if (empty($profileImage)) {
      $error[] = "You forgot to enter your image";
    }

    //if no error
    if (empty($error) && ($password == $confirm_pwd)) {
      // register a new user
      $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

      $sqli = "Select * from therapist where email='$email'"; //username and password same ？
      $result1 = mysqli_query($conn, $sqli) or die($conn->error . __LINE__); //sql
      $count = mysqli_num_rows($result1);

      // if this email no exist in database
      if ($count == 0) {
        $sql = "insert into therapist values('$generateid','$firstname','$lastname','$salutation','','$gender','$age','$email','$phone1','$ic','$address','$city','$postCode','$state','$education','$fileCer','$hashed_pass','$profileImage','1',NOW())";
        $result = $conn->query($sql);

        foreach ($_REQUEST['specialties'] as $specialty) {
          $spec = "INSERT into specialties values('','$generateid','$specialty')";
          $runspec = $conn->query($spec) or die($conn->error . __LINE__);
        }

        if ($result == true) {
          echo "<script>window.alert('Once the administrator accept or reject your application, we will send a notification to inform you')</script>";
        }

        //display successful statement
        echo '<style type="text/css"> 
      #info .register-success{
          display:block !important;            
      }</style>';
      } else {
        //display already registered statement
        echo '<style type="text/css"> 
      #info .already-registered{
          display:block !important;            
      }</style>';
      }
    } else {
      //display password not match statement
      echo '<style type="text/css"> 
    #info .password-notmatch{
          display:block !important;            
      }</style>';
    }
  }
}

?>
<!doctype html>
<html lang="en">

<head>
  <link rel="icon" href="images/Logo.jpg" type="image/x-icon" />
  <title>C&H</title>
  <link rel="stylesheet" type="text/css" href="css/therapistRegister.css">

</head>
<header>
  <?php require_once("header1.php") ?>
</header>
<section id="info">

  <div class="alert alert-danger alert-dismissible fade show text-center password-notmatch">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Your have not fulfilled in your information or your password are not same, please try again.</strong>
  </div>

  <div class="alert alert-success alert-dismissible fade show text-center register-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Register Successful!</strong>
  </div>

  <div class="alert alert-danger alert-dismissible fade show text-center already-registered">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>This Email Has Already Registered, Please Use another Email...!</strong>
  </div>

  <body>
    <br />
    <form action="Therapistinfo.php" method="post" enctype="multipart/form-data" id="theraRegister">
      <div class="container" style="margin-top:-75px">
        <div class="video-part">

          <div class="container">
            <div class="video-part-content">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active" style="display:none;"></li>

                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                  <div class="item active">
                    <div class="carousel-caption ">
                      <center>
                        <img src="http://lightofweb.com/zanzo-website/img/light-bulb.png" class="img-responsive animated fadeInDown">
                      </center>
                      <div class="full-width animated fadeInUp">
                        <h1>Job Opportunity</h1>
                        <p>Welcome Join Us </p>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#TheraReg" title="Therapist Register" id="therapistRegister">Register as Therapist</button>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="bot">
          <div class="container" style="margin-top:150px;">
            <div class="row">
              <div class="col-md-12" style="margin-left:7px;margin-bottom:10px;">
                <h2 style="margin-left:0px;"><strong>Help Malaysians in need by being on this platform. </strong></h2>
                <p>You will be able to consult clients and do what you do best – caring, understanding, guiding them to
                  new ways of thinking, and teaching skills to manage the challenges that they face in their lives.
                  Don’t worry about the rest – we do them for you.</p>
              </div>
              </br>
              <div class="col-xs-12 col-md-6" style="padding-left:20px;padding-right:10px;">
                <h3><strong>Why work with us? </strong></h3>
                <p><strong>*No overheads </strong></p>
                <p>You do not need to worry about meeting rent, utilities, or acquiring clients.
                  We work tirelessly to ensure that those who would like to consult with you are eager to begin
                  the therapy process. We also ensure that the infrastructure is maintained around the clock.
                  All of this is done at no cost to you. Just sign in to your account, and begin doing therapy! </p>

                <p><strong>*Diversification of services</strong></p>
                <p>Many clients feel that they need to feel ‘right’ with the therapist in order for them to consider
                  any further sessions. Many of them also find face-to-face therapy to be too costly for them,
                  despite really needing the service.</p>
                <p>At here, you are able to reach out to clients who you wouldn’t otherwise be able to consult
                  due to these reasons. You can also use your individualized therapist code to follow-up with
                  your clients that have discontinued face-to-face therapy, or to connect with those who are unable to
                  meet you due to distance. </p>
              </div>
              <div class="col-xs-12 col-md-6">
                <p><strong>*Flexibility </strong></p>
                <p>Here can be your main source of income, or as a supplement to your current work.
                  You decide the amount of clients that you do therapy with here.
                  Most of the operations here are asynchronous, which means that you are able to log in daily
                  at your most convenient times of the day. You do not need to worry about anything else, other than
                  to perform the work that you love. </p>
                <h3><strong>Requirements </strong></h3>
                <p>• A minimum of a Master’s degree in Counseling, Counseling Psychology, or Clinical Psychology. </p>
                <p>• For counselors, a valid counseling license issued by Lembaga Kaunselor Malaysia. </p>
                <p>• To have undergone the required supervision and session hours based on the respective field’s requirements. </p>
                <p>• Experience in individual counseling for adults.</p>
                <p><strong>Note </strong>: Therapists on the platform are independent providers and are not this platform's employees.
                  Please provide valid e-mail and phone number for further correspondence. </p>
              </div>
            </div>
          </div>
          <br />
          <br />
        </div>
      </div>
    </form>
  </body>

</section>
<footer>
  <?php require_once("footer.php"); ?>
</footer>
<?php include("therapistRegistercopy.php") ?>

</html>