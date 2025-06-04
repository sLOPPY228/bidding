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

// eSewa API configuration
$id = rand(0,999999);
$total_amount = $data;
$message = "total_amount=" . $total_amount . ",transaction_uuid=" . $id . ",product_code=EPAYTEST";
$secr = "8gBm/:&EnhH.1/q";
$s = hash_hmac('sha256', $message, $secr, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment - eSewa</title>
    <link rel="stylesheet" href="../css/9payment.css">
    <style>
        .payment-summary {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .amount {
            font-size: 2.5em;
            font-weight: 600;
            color: #2d3748;
            margin: 20px 0;
        }
        
        .currency {
            font-size: 0.5em;
            vertical-align: super;
        }

        .payment-method {
            text-align: center;
            margin-top: 20px;
        }

        .payment-method p {
            color: #718096;
            margin-bottom: 15px;
        }

        .esewa-button {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            transition: transform 0.3s ease;
            display: inline-block;
        }

        .esewa-button:hover {
            transform: translateY(-2px);
        }

        .esewa-button img {
            max-width: 200px;
            height: auto;
        }

        .esewa-form {
            display: none;
        }
    </style>
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

    <div class="container">
        <div class="payment-summary">
            <h1>Total Amount</h1>
            <div class="amount">
                <!-- <span class="currency">Rs.</span> -->
                <?php echo number_format($total_amount, 2); ?>
            </div>
        </div>

        <div class="payment-method">
            <p>Pay via</p>
            <button type="button" class="esewa-button" onclick="submitEsewaForm()">
                <img src="../System_images/Esewa.jpg" alt="eSewa Payment">
            </button>
        </div>

        <!-- Hidden eSewa form -->
        <form id="esewaForm" class="esewa-form" action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
            <input type="hidden" name="amount" value="<?php echo $total_amount ?>">
            <input type="hidden" name="tax_amount" value="0">
            <input type="hidden" name="total_amount" value="<?php echo $total_amount ?>">
            <input type="hidden" name="transaction_uuid" value="<?php echo $id ?>">
            <input type="hidden" name="product_code" value="EPAYTEST">
            <input type="hidden" name="product_service_charge" value="0">
            <input type="hidden" name="product_delivery_charge" value="0">
            <input type="hidden" name="success_url" value="https://esewa.com.np">
            <input type="hidden" name="failure_url" value="https://google.com">
            <input type="hidden" name="signed_field_names" value="total_amount,transaction_uuid,product_code">
            <input type="hidden" name="signature" value="<?php echo base64_encode($s) ?>">
        </form>
    </div>

    <script>
        function submitEsewaForm() {
            // Add loading state to button
            const button = document.querySelector('.esewa-button');
            button.style.opacity = '0.7';
            button.style.transform = 'scale(0.98)';
            
            // Submit the form after a brief delay to show the loading state
            setTimeout(() => {
                document.getElementById('esewaForm').submit();
            }, 300);
        }
    </script>
</body>
 
</html>