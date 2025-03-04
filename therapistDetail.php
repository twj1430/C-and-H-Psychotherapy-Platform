<?php
include("sessionTop.php");

//if get therapist id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "select * from therapist where therapist_id='$id'";
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result->num_rows > 0) { //over 1 database(record) so run
        while ($row = $result->fetch_assoc()) {
            $_SESSION['detail_work_theraID'] = $row['therapist_id'];
            $_SESSION['detail_thera_name_first'] = $row['name_first'];
            $_SESSION['detail_thera_name_last'] = $row['name_last'];
            $_SESSION['detail_thera_about'] = $row['about'];
            $_SESSION['detail_thera_gender'] = $row['gender'];
            $_SESSION['detail_thera_address'] = $row['address'];
            $_SESSION['detail_thera_city'] = $row['therapist_city'];
            $_SESSION['detail_thera_postCode'] = $row['therapist_postCode'];
            $_SESSION['detail_thera_state'] = $row['therapist_state'];
            $_SESSOPM['detail_thera_phone'] = $row['phone'];
            $_SESSION['detail_thera_age'] = $row['age'];
            $_SESSION['detail_thera_email'] = $row['email'];
            $_SESSION['detail_education_level'] = $row['education_level'];
            $_SESSION['detail_thera_profile_image'] = $row['profile_image'];
        }
    }
}


if (isset($_POST['direct'])) {
    $_SESSION['work_id'] = $_SESSION['detail_work_theraID'];
    echo "<script>window.location.assign('Appointment.php')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="images/Logo.jpg" type="image/x-icon" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C&H</title>

    <style>
        #submit {
            margin-top: 10px;
        }
    </style>
</head>

<header>
    <?php include("header1.php") ?>
</header>

<body>

    <section id="theraDetail">
        <div class="container">
            <a href="OurTherapist.php">
                <h3>Back</h3>
            </a>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 text-center" id="theraTop">
                        <img src="./images/therapists/<?php echo $_SESSION['detail_thera_profile_image'] ?>" alt="image" id="image" name="image">
                        <h3 class="theraName"><?php echo $_SESSION['detail_thera_name_first'] . "&nbsp;" . $_SESSION['detail_thera_name_last'] ?></h3>
                        <h4 id="theraLic"><?php echo $_SESSION['detail_education_level'] ?></h4>
                        <h4 class="paraTop">
                            Age: <?php echo $_SESSION['detail_thera_age'] ?>
                        </h4>
                        <h4 class="paraTop">
                            Gender:<?php echo $_SESSION['detail_thera_gender'] ?>
                        </h4>
                        <button type="submit" name="submit" id="submit" class="btn btn-outline-danger" data-toggle="modal" data-target="#check">Work with me!</button>
                        <hr>
                    </div>



                    <div class="col-md-12" id="theraAbout">
                        <h3 class="theraAbout">ABOUT ME</h3>
                        <p class="para">
                            <?php echo $_SESSION['detail_thera_about'] ?>
                        </p>
                        <hr>
                    </div>

                    <div class="col-md-12" id="theraSpec">
                        <h3 class="theraAbout">SPECIALTIES</h3>

                        <ul>
                            <?php
                            $runSpec = "SELECT * FROM specialties where Therapist_ID ='" . $_SESSION['detail_work_theraID'] . "'";
                            $getSpec = $conn->query($runSpec) or die($conn->error . __LINE__);

                            if ($getSpec->num_rows > 0) {
                                while ($row = $getSpec->fetch_array()) {
                                    $specialty = $row['specialty'];

                            ?>

                                    <li><?php echo $specialty ?></li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                        <p class="para"><strong>Years of Experience</strong>&nbsp;:22</p>
                        <hr>
                    </div>

                    <div class="col-md-12" id="theraService">
                        <h3 class="theraService">SERVICES OFFERED</h3>

                        <ul class="noStyle">
                            <li><i class="fa fa-comments-o" aria-hidden="true"></i>
                                <br>
                                <h5>WhatsApp Chat</h5>
                            </li>

                            <li>
                                <i class="fa fa-mobile" aria-hidden="true"></i>
                                <br>
                                <h5>WhatsApp Call</h5>
                            </li>
                        </ul>

                    </div>


                    <div class="col-md-12" id="theraLic">
                        <hr>
                        <h3 class="theraLic">LICENSING</h3>
                        <p class="para">
                            LPC #2266 (Expires: 2022-07-31)
                        </p>
                        <hr>
                    </div>

                    <div class="col-md-12" id="theraRe">
                        <h3 class="theraRe">REVIEWS</h3>
                        <?php
                        $checkReview = "SELECT * FROM review left join therapist on review.Therapist_ID=therapist.therapist_id where checkReview='2' and review.Therapist_ID='" . $_SESSION['detail_work_theraID'] . "' ORDER BY Created_Time DESC";
                        $runCheck = $conn->query($checkReview) or die($conn->error . __LINE__);

                        if ($runCheck->num_rows > 0) {
                            while ($row = $runCheck->fetch_array()) {
                                $review_ID = $row['review_ID'];
                                $Appointment_ID = $row['Appointment_ID'];
                                $review = $row['review'];
                                $client_Name = $row['client_Name'];

                                $user_time1 = strtotime($row['Created_Time']);
                                $name = $row['name_first'] . " " . $row['name_last'];

                                // $Time = date("h:i a", $user_time1);
                                $Date_Time = date("Y-m-d h:i a", $user_time1);

                                $image = $row['profile_image'];

                        ?>

                                <p class="review">
                                    <h5>Written by <?php echo $client_Name ?> on <?php echo $Date_Time ?></h5>
                                    <?php echo $review ?>
                                </p>
                        <?php
                            }
                        } ?>

                        <!-- <p class="review">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt, omnis. Ad nobis eveniet suscipit aliquid voluptate voluptatem a, nihil sapiente inventore perspiciatis, voluptas cupiditate magnam dolor asperiores quis eaque quam.
                        </p> -->
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- Modal -->
    <div class="modal fade" id="check" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Do you want to answer the questions to help the therapist know your situation better?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="therapistDetail.php" method="POST" id="detail" enctype="multipart/form-data">
                </form>
                <div class="modal-body" align="center">
                    <a href="question.php?work_id=<?php echo $_SESSION['detail_work_theraID'] ?>" class="btn btn-outline-success mx-3" style="display:inline-block">Yes</a>
                    <button class="btn btn-outline-danger" id="direct" name="direct" style="display:inline-block" form="detail">No, direct make appointment</button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>