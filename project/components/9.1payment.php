




<?php

include 'db_connect.php';
// if (isset($_GET['bid_amount'])) {
//     $data = $_GET['bid_amount'];
//     echo "Received data: " . $data;
// } else {
//     echo "No data received.";
// }
$data = $_GET["bid_amount"];
$product_id = $_GET['product_id'];
?>

<!--esewa begin -->
<?php
$id = rand(0,999999);
$total_amount = $data;
// $id = $product_id;
$message = "total_amount=" . $total_amount . ",transaction_uuid=" . $id . ",product_code=EPAYTEST";
// $message = "total_amount=$total_amount,transaction_uuid=".$id.",product_code=EPAYTEST";
$secr = "8gBm/:&EnhH.1/q";
$s = hash_hmac('sha256', $message, $secr, true);
// echo base64_encode($s); 
?>
<!--esewa end -->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>esewa payment</title>
    <link rel="stylesheet" href="../css/9payment.css">
</head>
<body>
    <!-- navigation bar begin -->
    <?php 
    if ($_SESSION["usertype"]==0) {
        require_once "../components/0nav.php";
    }else {
        require_once "../components/0adminnav.php";
    }
    
    ?>
       <!-- navigation bar ends -->
        <br><br>

 <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
 <input type="text" id="amount" name="amount" value="<?php echo $total_amount ?>" required>
 <input type="text" id="tax_amount" name="tax_amount" value ="0" required>
 <input type="text" id="total_amount" name="total_amount" value="<?php echo $total_amount ?>" required>
 <input type="text" id="transaction_uuid" name="transaction_uuid" value="<?php echo $id ?>" required>
 <input type="text" id="product_code" name="product_code" value ="EPAYTEST" required>
 <input type="text" id="product_service_charge" name="product_service_charge" value="0" required>
 <input type="text" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
 <input type="hidden" id="success_url" name="success_url" value="https://esewa.com.np" required>
 <input type="hidden" id="failure_url" name="failure_url" value="https://google.com" required>
 <input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
 <input type="hidden" id="signature" name="signature" value="<?PHP echo base64_encode($s) ?>" required>
 <input value="Submit" type="submit">
 </form>
</body>
 
</html>