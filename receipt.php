<?php
include("sessionTop.php");

if (isset($_SESSION['receipt_ID'])) {
    $receiptID = $_SESSION['receipt_ID'];
    $sql = "SELECT * FROM payments left join appointment on payments.appointmentID=appointment.appointment_id where receiptID='$receiptID'";
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['receipt_ID'] = $row['receiptID'];
            $_SESSION['receipt_name'] = $row['name'];
            $_SESSION['receipt_email'] = $row['email'];
            $_SESSION['receipt_appointmentID'] = $row['appointmentID'];
            $_SESSION['receipt_amount'] = $row['amount'];

            $user_time1 = strtotime($row['created_time']);
            $_SESSION['receipt_Date'] = date("Y-m-d", $user_time1);

            $user_time2 = strtotime($row['created_time']);
            $_SESSION['receipt_Time'] = date("h:i a", $user_time2);
        }
    }
} else if (isset($_GET['receiptID'])) {
    $receiptID = $_GET['receiptID'];
    $sql = "SELECT * FROM payments left join appointment on payments.appointmentID=appointment.appointment_id where receiptID='$receiptID'";
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['receipt_ID'] = $row['receiptID'];
            $_SESSION['receipt_name'] = $row['name'];
            $_SESSION['receipt_email'] = $row['email'];
            $_SESSION['receipt_appointmentID'] = $row['appointmentID'];
            $_SESSION['receipt_amount'] = $row['amount'];

            $user_time1 = strtotime($row['created_time']);
            $_SESSION['receipt_Date'] = date("Y-m-d", $user_time1);

            $user_time2 = strtotime($row['created_time']);
            $_SESSION['receipt_Time'] = date("h:i a", $user_time2);
        }
    }
} else {
    echo "<script>window.alert('You cannot directly access this page...!')</script>";
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
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: rgba(48, 83, 125);
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

        #paid {
            font-size: 80px;
            margin-bottom: 10px;
            color: green;
            border-color: green
        }

        #invoiceTo {
            border: 1px solid black;
            padding: 15px !important;
        }

        p {
            font-size: 20px;
        }
    </style>
</head>

<section id="invoice">

    <body>
        <div class="wrapper">
            <center><i class="fa fa-check" aria-hidden="true" id="paid"></i></center>
            <h2 id="Invoice">Receipt</h2>
            <div class="container">
                <p>Hi <b><?php echo $_SESSION['client_name_first'] . "&nbsp;" . $_SESSION['client_name_last'] ?></b>, this is your receipt for Appointment ID: <?php echo $_SESSION['receipt_appointmentID'] ?>.</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row" id="invoiceTo">
                            <div class="col-md-12">
                                <h4>Receipt ID</h4>
                                <input type="text" class="form-control" name="appointmentID" id="appointmentID" value="<?php echo $_SESSION['receipt_ID'] ?>" readonly>
                            </div>

                            <div class="col-md-12">
                                <h4>Date and Time</h4>
                                <input type="text" class="form-control" name="date" id="date" value="<?php echo $_SESSION['receipt_Date'] . "&nbsp;" . $_SESSION['receipt_Time'] ?>" readonly>
                            </div>

                            <div class="col-md-12">
                                <h4>Amount</h4>
                                <input type="text" class="form-control" name="amount" id="amount" value="MYR <?php echo $_SESSION['receipt_amount'] ?>" readonly>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <p>Thank you for choosing us to solve your problem!</p>
                        </div>

                        <div class="col-md-12 my-3">
                            <a href="profileCopy.php"><button class="btn btn-success" style="width:100%;">Back</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </body>
</section>

</html>