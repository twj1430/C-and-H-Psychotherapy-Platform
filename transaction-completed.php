<?php

namespace Sample;

require __DIR__ . '/vendor/autoload.php';
//1. Import the PayPal SDK client that was created in `Set up Server-Side SDK`.
use Sample\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;

require 'paypal-client.php';

$orderID = $_GET['orderID'];

class GetOrder
{

  // 2. Set up your server to receive a call from the client
  /**
   *You can use this function to retrieve an order by passing order ID as an argument.
   */
  public static function getOrder($orderId)
  {

    // 3. Call PayPal to get the transaction details
    $client = PayPalClient::client();
    $response = $client->execute(new OrdersGetRequest($orderId));

    //transaction details
    $receiptID = $response->result->id;
    $email = $response->result->payer->email_address;
    $name = $response->result->purchase_units[0]->shipping->name->full_name;
    //   purchase_units: [{
    //     amount: {
    //         value: Amount
    //     }
    // }],
    $amount = $response->result->purchase_units[0]->amount->value;



    //include details to our database
    include("sessionTop.php");
    $appointmentID = $_SESSION['pay_appointmentID'];


    $payment = "INSERT INTO payments (name, email, receiptID, amount, appointmentID, created_time) VALUE ('$name','$email','$receiptID','$amount','$appointmentID',NOW())";
    $runPay = $conn->query($payment) or die($conn->error . __LINE__);

    if ($runPay == false) {
      echo "There was a problem on your code" . mysqli_error($conn);
    } else {
      $payment = "UPDATE appointment set paymentStatus='2'";
      $runPay = $conn->query($payment) or die($conn->error . __LINE__);
      $_SESSION['receipt_ID'] = $receiptID;
      echo '<script>window.location.assign("receipt.php")</script>';
      // header('url=Home.php');
    }
  }
}

if (!count(debug_backtrace())) {
  GetOrder::getOrder($orderID, true);
}
