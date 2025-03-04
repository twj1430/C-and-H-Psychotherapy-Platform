<?php
include('sessionTop.php');
$date = date("Y-m-d"); //get the current date);

$sum = 0;
if (isset($_GET['appointmentID'])) {
    $_SESSION['pay_appointmentID'] = $_GET['appointmentID'];
    $appointmentID = $_GET['appointmentID'];
    $sql = "SELECT * FROM appointment left join therapist on appointment.therapist_ID=therapist.therapist_id where appointment_id='$appointmentID'";
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $appointment_id = $row['appointment_id'];
            $user_Email = $row['user_Email'];
            $user_method = $row['user_method'];
            $user_date = $row['user_date'];
            $paymentStatus = $row['paymentStatus'];
            $created_TIME = $row['created_TIME'];
            $therapist = $row['name_first'] . "&nbsp;" . $row['name_last'];

            $user_time3 = strtotime($user_date);
            $user_time4 = date("Y-m-d", $user_time3);

            $sum+=110;
        }
    }
} else {
    echo '<script>window.alert("You cannot direct access this page..!")</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="images/Logo.jpg" type="image/x-icon" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C&H</title>
    <link href="css/paymentform.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">

    <style>
        h4 {
            color: rgba(34, 19, 48);
        }

        input[type='text'] {
            font-size: 20px;
            background-color: white !important;
            border: none !important;
        }

        input[type='text']#Amount {
            font-size: 20px;
            font-weight: 700;
            background-color: white !important;
            border: none !important;
        }

        .col-md-12 {
            padding-left: 0 !important;
            padding-right: 0 !important;
            margin-bottom: 20px;
        }
    </style>
</head>

<section id="payment">

    <body>
        <div class="wrapper">
            <h2>Payment Form</h2>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Appointment ID</h4>
                        <input type="text" class="form-control" name="appointmentID" id="appointmentID" value="<?php echo $appointment_id ?>" readonly>
                    </div>

                    <div class="col-md-12">
                        <h4>Therapist</h4>
                        <input type="text" class="form-control" name="Therapist" id="Therapist" value="<?php echo $therapist ?>" readonly>
                    </div>

                    <div class="col-md-12">
                        <h4>Payment amount(RM)</h4>
                        <input type="text" class="form-control" name="Amount" id="Amount" value="<?php
                                                                                                    echo number_format($sum, 2);
                                                                                                    ?>" readonly>
                    </div>

                    <div class="col-md-12">
                        <div id="paypal-button-container"></div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script src="https://www.paypal.com/sdk/js?client-id=AWvgBnBqNDG7BblFWo-V7Jx_cKStjDXdalDvZiJ4QqcnKYtcCBGkTd1hn3LPCELeXgiNwl0RI9Tnsxsc&currency=MYR">
            // Required. Replace SB_CLIENT_ID with your sandbox client ID.
        </script>
        <script>
            var Amount = $('#Amount').val();
            paypal.Buttons({
                createOrder: function(data, actions) {
                    // This function sets up the details of the transaction, including the amount and line item details.
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: Amount
                            }
                        }],
                    });
                },
                onApprove: function(data, actions) {
                    // This function captures the funds from the transaction.
                    window.location = "transaction-completed.php?&orderID=" + data.orderID;
                }
            }).render('#paypal-button-container');
        </script>
    </body>
</section>

</html>