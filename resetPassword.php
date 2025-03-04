<?php
include("sessionTop.php");

if (isset($_GET['code'])) {
    $sql = "SELECT * FROM resetpasswords where code ='" . $_GET['code'] . "'";
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['currentResetPassword_Email'] = $row['email'];
        }
    }
}

if (isset($_POST['submit'])) {
    $error = array();
    $newPass = validate_input_text($_POST['newPass']);

    if (empty($newPass)) {
        $error[] = "You forget to enter your new password!";
    }

    if (empty($error)) {
        $newPasswordHash = password_hash($newPass, PASSWORD_DEFAULT);
        $sql = "UPDATE client set password='$newPasswordHash' where email='" . $_SESSION['currentResetPassword_Email'] . "'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);

        if ($result == true) {
            echo "<script>window.alert('Reset Successful!');window.location.assign('login.php')</script>";
        }
    } else {
        echo "<script>window.alert('Error while reset, please try again!');window.location.assign('login.php')</script>";
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

        #password_empty,
        #password_length {
            display: none;
            color: red;
        }
    </style>
</head>

<header>
    <?php include("header1.php") ?>
</header>

<body>
    <form action="resetPassword.php" method="POST">
        <div class="container">
            <div class="row">

                <div class="col-md-12" style="text-align:center">
                    <h5 class="modal-title" id="exampleModalLabel">Reset new password</h5> <br>
                    <input type="text" name="newPass" id="newPass"> <br><br>
                    <span id="password_empty">Password cannot be empty!</span>
                    <span id="password_length">Password must over 6 digit!</span>
                    <button class="btn btn-success" id="submit" name="submit">Submit</button>
                </div>

            </div>
        </div>
    </form>
</body>

<script type="text/javascript">
    $(document).ready(function(e) {
        $("#submit").click(function() {
            if ($('#newPass').val().length < 7 && $('#newPass').val() != "") {
                event.preventDefault();
            } else if ($('#newPass').val() == "") {
                $("#password_empty").css({
                    display: "block"
                });
                event.preventDefault();
            }
        });

        $("#newPass").keyup(function() {
            if ($('#newPass').val().length < 7) {
                $('#password_length').css({
                    display: "block"
                })
            } else {
                $('#password_length').css({
                    display: "none"
                })
            }
        });
    });
</script>

</html>