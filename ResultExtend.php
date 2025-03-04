<?php
if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan'] == 98))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Male' and therapist.age<=44 and English='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";
        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

        <?php }
        } ?>
        <?php
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Male' and therapist.age<=44 and English='Yes'";
        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
        ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan'] == 98))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Female' and therapist.age<=44 and English='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";
        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Female' and therapist.age<=44 and English='Yes'";
        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan'] == 98))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.age<=44 and English='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";
        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.age<=44 and English='Yes'";
        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan'] == 98))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Male' and therapist.age>=45 and English='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Male' and therapist.age>=45 and English='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan'] == 98))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Male' and English='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Male' and English='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan'] == 98))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Female' and therapist.age>=45 and English='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Female' and therapist.age>=45 and English='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan'] == 98))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Female' and English='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Female' and English='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan'] == 98))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.age>=45 and English='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.age>=45 and English='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan'] == 98))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and English='Yes' and specialties.Therapist_ID !='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and English='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan'] == 99))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Male' and therapist.age<=44 and Malay='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Male' and therapist.age<=44 and Malay='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan'] == 100))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Male' and therapist.age<=44 and Mandarin='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Male' and therapist.age<=44 and Mandarin='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan'] == 99))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Female' and therapist.age<=44 and Malay='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Female' and therapist.age<=44 and Malay='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan'] == 100))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Female' and therapist.age<=44 and Mandarin='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Female' and therapist.age<=44 and Mandarin='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan'] == 99))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.age<=44 and Malay='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.age<=44 and Malay='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan'] == 100))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.age<=44 and Mandarin='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.age<=44 and Mandarin='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan'] == 99))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Male' and therapist.age>=45 and Malay='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Male' and therapist.age>=45 and Malay='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>
                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan'] == 100))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Male' and therapist.age>=45 and Mandarin='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>
                    </p>

                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Male' and therapist.age>=45 and Mandarin='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>
                    </p>

                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan'] == 99))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Female' and therapist.age>=45 and Malay='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>

                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Female' and therapist.age>=45 and Malay='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>

                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan'] == 100))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Female' and therapist.age>=45 and Mandarin='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>

                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Female' and therapist.age>=45 and Mandarin='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>

                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan'] == 99))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.age>=45 and English='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>

                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.age>=45 and English='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>

                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan'] == 100))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.age>=45 and Mandarin='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>

                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.age>=45 and Mandarin='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>

                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan'] == 99))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Male' and Malay='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>

                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Male' and Malay='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>

                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan'] == 100))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Male' and Mandarin='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>

                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Male' and Mandarin='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>

                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan'] == 99))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Female' and Malay='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>

                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Female' and Malay='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>

                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan'] == 100))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Female' and Mandarin='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>

                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and therapist.gender='Female' and Mandarin='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>

                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan'] == 99))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and Malay='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>

                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and Malay='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>

                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
} else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan'] == 100))) {
    if (isset($_SESSION['change_id']) && (!empty($_SESSION['change_id']))) {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and Mandarin='Yes' and specialties.Therapist_ID!='" . $_SESSION['change_therapist'] . "'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>

                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            <?php }
        }
    } else {
        $sqli = "SELECT * FROM `specialties` left join therapist on specialties.therapist_ID=therapist.therapist_id LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where specialty='" . $_SESSION['specialty_name'] . "' and therapist.statusID='2' and Mandarin='Yes'";

        $run = $conn->query($sqli) or die($conn->error . __LINE__);
        if ($run->num_rows > 0) { //over 1 database(record) so run
            while ($row = $run->fetch_assoc()) {
                $id = $row['therapist_id']; //[] inside is follow database 
                $name_first = $row['name_first'];
                $name_last = $row['name_last'];
                $ic = $row['ic'];
                $age = $row['age'];
                $address = $row['address'];
                $therapist_city = $row['therapist_city'];
                $therapist_postCode = $row['therapist_postCode'];
                $therapist_state = $row['therapist_state'];
                $education_level = $row['education_level'];
                $profile_image = $row['profile_image'];
                $gender = $row['gender'];
            ?>
                <div class="col-md-6">
                    <img src="./images/therapists/<?php echo $profile_image ?>" alt="image">

                </div>
                <div class="col-md-6">
                    <p>
                        Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                        Age: <?php echo $age ?> <br>
                        Gender: <?php echo $gender ?> <br>
                        Education_Level: <?php echo $education_level ?> <br>
                        Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                    </p>

                    <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


                </div>
                <div class="col-md-12">
                    <hr>
                </div>

<?php }
        } else {
            $generate = $_SESSION['generate_id'];

            $sql = "SELECT * from user_choices where selectID='$generate'";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) {
                $sqli = "delete from user_choices where selectID='$generate'";
                $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            } else {
                echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
            }
        }
    }
}
?>