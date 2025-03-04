<?php
include("sessionTop.php");
?>

<!doctype html>
<html lang="en">

<head>
    <link rel="icon" href="images/Logo.jpg" type="image/x-icon" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C&H</title>
</head>
<header>
    <?php require_once("header1.php"); ?>
</header>

<section id="ourtherapist">

    <body>
        <div class="container">
            <!-- page-header -->

            <div class="page-header">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-caption">
                            <h1 class="page-title">Meet our therapist</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.page-header-->
            <!-- news -->

            <div class="card-section">
                <div class="card-block mb30" style="background-color:rgba(210,232,246);">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <!-- section-title -->
                            <div class="section-title mb-0">
                                <h2>Counselor as Friend.</h2>
                                <p>Our Counselors are licensed, trained, experienced, and accredited psychologists (PhD / PsyD),
                                    marriage and family therapists (MFT), clinical social workers (LCSW),
                                    or licensed professional counselors (LPC). All of them have a Masters Degree or a Doctorate Degree
                                    in their field. They have been qualified and certified by their state professional board after successfully completing the necessary education, exams, training and practice. While their experience, expertise and background vary,
                                    they all possess at least 3 years and 1,000 hours of hands-on experience. </p>
                            </div>
                            <!-- /.section-title -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div clas="col-md-12" id="search">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group w-100">
                                <label for="searchText" id="searchWord">
                                    <h2>Search</h2>
                                </label>
                                <input type="search" id="searchText" name="Search" class="form-control" placeholder="Search">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group w-100">
                                <label for="licenseType" style="display:block">
                                    <h2>Sort by Education Level</h2>
                                </label>
                                <select name="educationType" class="custom-select" style="width:50%;" id="educationType">
                                    <option value="All" class="getLicense">All</option>
                                    <option value="M. Clin. Psych." class="getLicense">M. Clin. Psych.</option>
                                    <option value="M.A. Coun. Psych." class="getLicense">M.A. Coun. Psych.</option>
                                    <option value="M.A. Counseling" class="getLicense">M.A. Counseling</option>
                                    <option value="PhD" class="getLicense">PhD</option>
                                    <option value="PsyD" class="getLicense">PsyD</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card border-0" style="margin-left: -14px;margin-right:-13px;">
                    <div class="row" id="results">
                        <?php
                        $sql = "select * from therapist where statusID='2'"; //有where在sql，search sql 不能再有where 换成and
                        $result = $conn->query($sql) or die($conn->error . __LINE__); //Define sql, run sql
                        if ($result->num_rows > 0) { //over 1 database(record) so run
                            while ($row = $result->fetch_assoc()) {
                                //display result
                                $id = $row['therapist_id']; //[] inside is follow database 
                                $name_first = $row['name_first'];
                                $name_last = $row['name_last'];
                                $profile_image = $row['profile_image'];
                                $education_level = $row['education_level'];
                        ?>
                                <div class="col-md-3">
                                    <a href="therapistDetail.php?id=<?php echo $id ?>">
                                        <div class="card h-100 border-0">
                                            <div class="card-body">
                                                <img src="./images/therapists/<?php echo $profile_image ?>" alt="" id="therapist1">
                                                <h4 class="therapistname"><?php echo $name_first . "&nbsp;" . $name_last ?></h4>
                                                <h5 class="therapistedu"><?php echo $education_level ?></h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                        <?php
                            } //while
                        } //if
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</section>
<!-- Team -->
<script src="js/main.js" type="text/javascript"></script>

<footer>
    <?php require_once("footer.php"); ?>

</footer>

</html>