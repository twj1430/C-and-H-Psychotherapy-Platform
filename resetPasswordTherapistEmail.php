<?php
include("sessionTop.php");
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['submit'])) {
    $error = array();
    $rePass = validate_input_text($_POST['rePass']);

    if (empty($rePass)) {
        $error[] = "You forget to enter your new password!";
    }

    if (empty($error)) {
        $EmailTo = $rePass;
        $sql = "SELECT * from therapist where email='$EmailTo'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);

        if ($result->num_rows > 0) {
            $code = uniqid(true);
            $query = mysqli_query($conn, "insert into resetpasswords(code,email) values ('$code','$EmailTo')");
            if (!$query) { //false
                exit("Error");
            }
            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings         
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'ddwq1.12@gmail.com';                     // SMTP username
                $mail->Password   = '59Odwq234Fa';                               // SMTP password
                $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients - sender
                $mail->setFrom('company-Mail-test@gmail.com', 'Security Mail Company');
                $mail->addAddress($EmailTo);     // Add a recipient
                $mail->addReplyTo('no-reply@gmail.com', 'No reply');

                // Content
                $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER['PHP_SELF']) . "/resetTherapistPassword.php?code=$code";
                $mail->Subject = 'Reset Password';
                $mail->Body    = "<h1>You requested a password reset</h1>
                                click <a href='$url'>this link to modified password</a>";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                // echo 'Reset password link has been sent to you email';
                echo "<script>alert('Reset password link has been sent to you email!'); window.location.assign('therapistLogin.php');</script>";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            exit();
        }else{
            echo "<script>alert('Unavailable email!!');</script>";
        }
    } else {
        echo "<script>alert('Something Error here, please try again!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="images/Logo.jpg" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C&H</title>

    <style>
        body {
            background: rgb(245, 245, 245) !important;
            padding-top: 100px;
        }

        #email_validation {
            display: none;
            color: red;
        }
    </style>
</head>

<header>
    <?php include("header1.php") ?>
</header>

<body>
    <form action="resetPasswordEmail.php" method="POST">
        <div class="container">
            <div class="row">

                <div class="col-md-12" style="text-align:center">
                    <h5 class="modal-title" id="exampleModalLabel">Please enter your email that you want to reset new password</h5> <br>
                    <input type="text" name="rePass" id="rePass"> <br><br>
                    <span id="email_validation">Your email is not valid!</span>
                    <button class="btn btn-success" id="submit" name="submit">Submit</button>
                </div>

            </div>
        </div>
    </form>
</body>

<script type="text/javascript">
    $(document).ready(function(e) {
        $("#submit").click(function() {
            const re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            if (!$("#rePass").val().match(re)) {
                $("#email_validation").css({
                    display: "block"
                });
                event.preventDefault();
            }
        });
    });
</script>

</html>