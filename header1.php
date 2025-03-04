<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">

    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/appointment.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/FAQ.css">
    <link rel="stylesheet" type="text/css" href="css/Help.css">
    <link rel="stylesheet" type="text/css" href="css/Therapistinfo.css">
    <link rel="stylesheet" type="text/css" href="css/Profile.css">
    <link rel="stylesheet" type="text/css" href="css/Reviews.css">
    <link rel="stylesheet" type="text/css" href="css/therapistRegister.css">
    <link rel="stylesheet" type="text/css" href="css/OurTherapist.css">
    <link rel="stylesheet" type="text/css" href="css/theraDetail.css">
    <link rel="stylesheet" type="text/css" href="css/profileCopy.css">

    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<html>
<html lang="en">

<header id="header1">
    <!-- nav bar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="position:fixed;background-color:rgba(34,19,48);">
        <!-- Brand -->
        <a class="navbar-brand" href="Home.php"><img src="images/Logo.jpg" alt="logo" style="width:35px"></a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2 " id="collapsibleNavbar">

            <ul class="navbar-nav ml-auto">

                <li class="nav-item active">
                    <a class="nav-link" href="help.php" style="color:white">Service</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="FAQ.php" style="color:white">FAQ</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="reviews.php" style="color:white">Reviews</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="OurTherapist.php" style="color:white">Our Therapist</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="Therapistinfo.php" style="color:white">Therapist Job</a>
                </li>
                <form action="sessionTop.php" method="POST" id="getLogout"></form>
                <?php
                if (isset($_SESSION['client_id'])) {
                    $client = " <li class=\"nav-item active\" id=\"DropDown\"><div class=\"dropdown\">";
                    $client .= "<button onclick=\"myFunction()\" class=\"dropbtn\">" . $_SESSION['client_name_first'] . "&nbsp;" . $_SESSION['client_name_last'] . "<i class=\"fa fa-arrow-down\" aria-hidden=\"true\" style=\"margin-left:10px;font-size: 12px;\" id=\"arrow-down\"></i><i class=\"fa fa-arrow-up\" aria-hidden=\"true\" style=\"margin-left:10px;font-size: 12px;\" id=\"arrow-up\"></i></button>";
                    if ($appointmentNumTop > 0) {
                        $client .= "<span class=\"badge badge-danger\" style=\"padding:5px;font-size:20px;\" id=\"appointmentSecond_number\">$appointmentNumTop</span>";
                    }

                    $client .= "<div id=\"myDropdown\" class=\"dropdown-content\">
                          <a href=\"profileCopy.php\">Profile</a>
                          <button type=\"submit\" id=\"logout\" name=\"logout\" onclick=\"return confirm('Are you sure you want to Log out?')\" form=\"getLogout\">Log out<i class=\"fa fa-sign-out\" aria-hidden=\"true\" id=\"logout_iconSecond\" style=\"margin-left:10px;font-size:20px;\"></i></button>
                        </div>
                      </div></li>";

                    echo $client;
                } else {
                    echo "<li class=\"nav-item active\"><a class=\"nav-link\" href=\"login.php\" style=\"color:white;\">Login</a></li>";
                }
                ?>
                </li>

            </ul>


        </div>

    </nav>
</header>

</html>

<script type="text/javascript">
    /* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */

    let arrowup = document.querySelector("#arrow-up");
    let arrowdown = document.querySelector('#arrow-down');

    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
        arrowup.style.display = "inline-block";
        arrowdown.style.display = "none";
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {

        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
            arrowup.style.display = "none";
            arrowdown.style.display = "inline-block";
        }
    }
</script>