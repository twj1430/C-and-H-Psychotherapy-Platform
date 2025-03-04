<?php
include("sessionTop.php");
$sql = "select * from services";
$result = $conn->query($sql) or die($conn->error . __LINE__);
$_SESSION['generate_id'] = '';
$_SESSION['change_id'] = "";
$_SESSION['specialty_name'] = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="images/Logo.jpg" type="image/x-icon" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C&H</title>
</head>

<header>
    <?php require_once("header1.php") ?>
</header>

<section id="help">

    <body>
        <div class="container" style="max-width: 1262px;">
            <div class="top-service">
                <img src="images/onlineService.jpg" alt="onlineService">
                <div class="service-inside">
                    <h2>Help yourself to thrive with professional therapist</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-md-12">
                <h2 style="text-align:center;margin-bottom:50px;margin-top:20px;font-family:Arial, Helvetica, sans-serif">Therapists that can help with...</h2>

                <div class="row">
                    <?php
                    if ($result->num_rows > 0) :
                        while ($row = $result->fetch_assoc()) : ?>
                            <div class="col-sm-3 col-xs-6" id="<?php echo $row['name'] ?>">
                                <a href="checkDirect.php?id=<?php echo $row['id'] ?>" name="insert">
                                    <div class="serviceName">
                                        <span><?php echo $row['name'] ?></span>
                                    </div>
                                    <img src="<?php echo $row['image'] ?>" alt="image" class="img-responsive">
                                </a>
                            </div>
                    <?php endwhile;
                    endif; ?>
                </div>
            </div>

            <div class="container bot">
                <hr>
                <h3 style="text-align:center">How it works</h3>
                <div class="row inside">
                    <div class="col-md-3">
                        <h3 class="work">Tell us about yourself</h3>
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <p class="work-text">C&H is accepting of people from every gender, orientation and identity</p>
                    </div>

                    <div class="col-md-3 offset-md-1">
                        <h3 class="work">Get matched to a licensed therapist</h3>
                        <i class="fa fa-id-card-o" aria-hidden="true"></i>
                        <p class="work-text">Our counselors specialize in the C&H community</p>
                    </div>

                    <div class="col-md-3 offset-md-1">
                        <h3 class="work">Start Chatting</h3>
                        <i class="fa fa-comments-o" aria-hidden="true"></i>
                        <p class="work-text">Message whenever you want, Schedule sessions</p>
                    </div>
                </div>

            </div>
            </form>

        </div>
    </body>
</section>
<?php require_once("footer.php") ?>

</html>