<?php
include("sessionTop.php");

if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $feedbackMessage = mysqli_real_escape_string($conn, $_POST['feedbackMessage']);

  $error = array();

  if (empty($name)) {
    $error[] = "You forget your name";
  }

  if (empty($email)) {
    $error[] = "You forget your email";
  }

  if (empty($feedbackMessage)) {
    $error[] = "you forget your feedback message";
  }

  if (empty($error)) {
    $sql = "INSERT INTO feedback values ('', '$name','$email','$feedbackMessage',NOW())";
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result == true) {
      echo '<style type="text/css"> 
      #feedback .success{
        display:block !important;            
    }
    #feedback .contact-form{
      top:70% !important;
    }</style>';
    }
  } else {
    echo '<style type="text/css"> 
      #feedback .error{
        display:block !important;            
    }</style>';
  }
}
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <link rel="icon" href="images/Logo.jpg" type="image/x-icon" />
  <meta charset="utf-8">
  <title>C&H</title>
  <link rel="stylesheet" href="css/feedback.css">

  <style>
    body {
      margin: 0, 0, 30px, 0;
      padding: 0, 0, 0, 0;
      background: url("images/feedback.jpg");
      background-size: cover;
    }
  </style>
</head>
<header>
  <?php require_once("header1.php") ?>
</header>
<section id="feedback">

  <body>
    <div class="alert alert-success success" role="alert">
      <h5>Submit successful!</h5>
    </div>

    <div class="alert alert-danger error" role="alert">
      <h5>Error occured,please try again!</h5>
    </div>


    <form action="feedback.php" method="POST">
      <div class="contact-form">
        <h1 style="text-align:center">Feedback</h1>
        <div class="txtb">
          <label>Full Name :</label>
          <input type="text" name="name" id="name" value="<?php if (isset($_SESSION['client_id'])) {
                                                            echo $_SESSION['client_name_first'] . " " . $_SESSION['client_name_last'];
                                                          } ?>" placeholder="Enter Your Name">

        </div>
        <span id="name_empty"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>Name cannot be empty!</span>

        <div class="txtb">
          <label>Email :</label>
          <input type="email" name="email" id="email" value="<?php if (isset($_SESSION['client_id'])) {
                                                                echo $_SESSION['client_email'];
                                                              } ?>" placeholder="Enter Your Email">
        </div>
        <span id="email_empty"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>Email cannot be empty!</span>

        <div class="txtb">
          <label>Message :</label>
          <textarea rows="5" id="feedbackMessage" name="feedbackMessage"></textarea>
        </div>
        <span id="feedback_empty"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>You must fill up the text area</span>

        <button class="btn" id="click" type="submit" onclick="return confirm('Confirm to submit?')" name="submit">Send</button>
      </div>
    </form>

  </body>
</section>

<script type="text/javascript">
  $(document).ready(function(e) {

    if (($('#name').val() != '') && ($('#email').val() != '')) {
      $('#name').attr("readonly", true);
      $('#email').attr("readonly", true);
    }

    $('#click').click(function() {

      if (($('#name').val() == '') && ($('#email').val() == '') && ($('#feedbackMessage').val() == '')) {
        $('#name_empty').css({
          display: "block"
        });
        $('#email_empty').css({
          display: "block"
        });
        $('#feedback_empty').css({
          display: "block"
        });
        event.preventDefault();
      } else if (($('#name').val() != '') && ($('#email').val() == '') && ($('#feedbackMessage').val() == '')) {
        $('#name_empty').css({
          display: "none"
        });
        $('#email_empty').css({
          display: "block"
        });
        $('#feedback_empty').css({
          display: "block"
        });
        event.preventDefault();
      } else if (($('#name').val() == '') && ($('#email').val() != '') && ($('#feedbackMessage').val() == '')) {
        $('#name_empty').css({
          display: "block"
        });
        $('#email_empty').css({
          display: "none"
        });
        $('#feedback_empty').css({
          display: "block"
        });
        event.preventDefault();
      } else if (($('#name').val() == '') && ($('#email').val() == '') && ($('#feedbackMessage').val() != '')) {
        $('#name_empty').css({
          display: "block"
        });
        $('#email_empty').css({
          display: "block"
        });
        $('#feedback_empty').css({
          display: "none"
        });
        event.preventDefault();
      } else if (($('#name').val() != '') && ($('#email').val() != '') && ($('#feedbackMessage').val() == '')) {
        $('#name_empty').css({
          display: "none"
        });
        $('#email_empty').css({
          display: "none"
        });
        $('#feedback_empty').css({
          display: "block"
        });
        event.preventDefault();
      } else if (($('#name').val() != '') && ($('#email').val() == '') && ($('#feedbackMessage').val() != '')) {
        $('#name_empty').css({
          display: "none"
        });
        $('#email_empty').css({
          display: "block"
        });
        $('#feedback_empty').css({
          display: "none"
        });
        event.preventDefault();
      } else if (($('#name').val() == '') && ($('#email').val() != '') && ($('#feedbackMessage').val() != '')) {
        $('#name_empty').css({
          display: "block"
        });
        $('#email_empty').css({
          display: "none"
        });
        $('#feedback_empty').css({
          display: "none"
        });
        event.preventDefault();
      }

    });
  });
</script>

</html>