<?php
include("sessionTop.php");
$_SESSION['generate_id'] = '';
?>

<!doctype html>
<html lang="en">

<head>
  <link rel="icon" href="images/Logo.jpg" type="image/x-icon" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>C&H</title>
  <style>
    #map {
      height: 400px;
      /* The height is 400 pixels */
      width: 100%;
      /* The width is the width of the web page */
    }
  </style>
</head>

<header>
  <?php include("header1.php"); ?>
</header>


<body>
  <form action="Home.php" method="POST" id="Home" enctype="multipart/form-data"></form>
  <section id="home">
    <div class="container">
      <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" style="margin-top:55px;">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="images/counselling.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h3 style="padding-bottom:10px;color:black">Facing some problem?</h3>
              <h5 style="padding-bottom:30px;color:black;">Nulla vitae elit libero, a pharetra augue mollis interdum.</h5>
            </div>
          </div>
          <div class="carousel-item">
            <img src="images/depression.jpg" class="d-block w-100 " alt="...">
            <div class="carousel-caption d-none d-md-block">
            <h3 style="padding-bottom:10px;color:white">Facing some problem?</h3>
              <h5 style="padding-bottom:30px;color:white;">Nulla vitae elit libero, a pharetra augue mollis interdum.</h5>
            </div>
          </div>
          <div class="carousel-item">
            <img src="images/anxiety.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
            <h3 style="padding-bottom:10px;color:white">Facing some problem?</h3>
              <h5 style="padding-bottom:30px;color:white;">Nulla vitae elit libero, a pharetra augue mollis interdum.</h5>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>


      <div class="content">
        <div class="arti">
          <div class="arti-contentWhole1">
            <div class="arti-contentLeft">
              <h2><strong>Our Therapists</strong></h2>
              <img src="images/female.jpg">
              <img src="images/female.jpg">
              <img src="images/male.jpg">
            </div>

            <div class="arti-contentRight">
              <p>Counselors in C&H are licensed, trained and experienced. All of them have a Masters Degree or a Doctorate Degree in their field. They have been qualified and certified by their state professional board after successfully completing the necessary education, exams, training and practice. While their experience, expertise and background vary, they all possess at least 3 years and 1,000 hours of hands-on experience. <br></p>

              <button class="btn" type="submit"><a href="OurTherapist.php">Meet Our Therapists</a></button>
            </div>

          </div>


          <div class="arti-contentWhole2">

            <div class="arti-content1Left">
              <h3><strong>Chat online with therapist

                </strong></h3>

              <img src="images/chat.jpg">

            </div>

            <div class="arti-content1Right">
              <p>Need to talk to someone? Our therapists are available to give emotional support over online chat.<br><br>
                When you need someone to talk to, we're here to listen and help you feel better.<br>
              </p>

              <button class="btn1" type="submit"><a href="help.php">Get Started</a></button>
            </div>


          </div>

          <div class="arti-contentWhole3">

            <div class="arti-content2Left">
              <h3><strong>Try self help made easy</strong></h3><br>
              <img src="images/depression1.jpg">

            </div>

            <div class="arti-content2Right">

              <p id="right2">
                <br>
                Discover your personal growth path and learn new coping skills to grow stronger each day.<br><br>
                Each step on your path is a simple self help activity, designed to help you feel better.<br>

                <button class="btn2"><a href="help.php">Get Started</a></button>
              </p>

            </div>
          </div>

        </div>

        <?php require_once("footer.php"); ?>
      </div>
    </div>
  </section>
  <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/ScrollMagic.min.js"></script>
  <script src="js/main.js" type="text/javascript"></script>

</body>


</html>