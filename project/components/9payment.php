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
<!DOCTYPE html>
<html lang="en">
<head>
   
    <title>Payment Form</title>
    <link rel="stylesheet" href="../css/9payment.css">
   
</head>
<!-- navigation bar begin -->
<?php 
if ($_SESSION["usertype"]==0) {
    require_once "../components/0nav.php";
}else {
    require_once "../components/0adminnav.php";
}

?>
   <!-- navigation bar ends -->
<body>
    <div class="container">
        <h1>Payment Details</h1>
        <form action="mail.php" method="POST">
            <input type="hidden" name="product_id" value= "<?php echo $product_id;?>">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="card_number">Card Number:</label>
            <input type="text" id="card_number" name="card_number" placeholder="XXXX XXXX XXXX XXXX" required>

            <label for="card_holder">Cardholder Name:</label>
            <input type="text" id="card_holder" name="card_holder" required>

            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="3" required></textarea>

            <label for="card_holder">Price:<?php echo "$data";?></label>
            
            <button type="submit">Pay Now</button>
        </form>
    </div>
</body>
</html>
