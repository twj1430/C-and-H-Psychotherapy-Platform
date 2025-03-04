<?php
include("sessionTop.php");

$sql = "SELECT * FROM review left join therapist on review.Therapist_ID=therapist.therapist_id where checkReview='2' ORDER BY Created_Time ASC";
$run = $conn->query($sql) or die($conn->error . __LINE__);

?>

<!doctype html>
<html lang="en">

<head>
    <link rel="icon" href="images/Logo.jpg" type="image/x-icon" />
    <title>C&H</title>
    <link rel="stylesheet" type="text/css" href="css/Reviews.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <style>
        #reviews {
            background-image: url('images/twinkle.jpg');
            background-size: cover;
        }
    </style>

</head>


<header>
    <?php require_once("header1.php"); ?>
</header>

<section id="reviews">

    <div class="logo-header">
        <div class="align-items-center">
            <div class="col-md-12 text-center header-content" style="padding-top:100px;">
                <img src="images/Logo.jpg" style="width:20%;height:20%" class="img-fluid logo" alt="logo">
                <h1 style="color:white">Let's leave some review for us</h1>
                <p>These are reviews for therapists that work with Care and Healing</p>
            </div>
        </div>
    </div>

    <body>
        <div class="container" style="padding-top:15px;">
            <div class="row">
                <!--- \\\\\\\Post-->
                <?php
                if ($run->num_rows > 0) {
                    while ($row = $run->fetch_assoc()) {
                        $review_ID = $row['review_ID'];
                        $Appointment_ID = $row['Appointment_ID'];
                        $review = $row['review'];
                        $checkReview = $row['checkReview'];
                        $client_Name = $row['client_Name'];

                        $user_time1 = strtotime($row['Created_Time']);
                        $name = $row['name_first'] . " " . $row['name_last'];

                        $Time = date("h:i a", $user_time1);
                        $Date = date("Y-m-d", $user_time1);

                        $image = $row['profile_image'];
                ?>

                        <div class="col-md-6 gedf-main">
                            <div class="card gedf-card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="ml-2">
                                                <div class="h5 m-0">Review ID:# <?php echo $review_ID ?></div>
                                                <div class="h7 text-muted">Date of review: <?php echo $Date . " " . $Time ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Review written by user <?php echo $client_Name ?> after counseling with Dr. <?php echo $name ?></h5>

                                    <p class="card-text">
                                        <?php echo $review ?>
                                    </p>
                                </div>

                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="mr-2">
                                                <img class="rounded-circle" width="45" src="./images/therapists/<?php echo $image ?>" alt="image">
                                            </div>
                                            <div class="ml-2">
                                                <div class="h5 m-0"><?php echo $name ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>

        </div>

    </body>
</section>
<footer style="text-align:center">
    <?php require_once("footer.php"); ?>

</footer>


</html>