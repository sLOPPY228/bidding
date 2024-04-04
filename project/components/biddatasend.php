<?php
session_start(); 

$servername = "localhost";  
$username = "root";
$password = "";
$dbname = "phpgallery";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $user_id = $_SESSION["userid"];
    $bid_amount = $_POST["bid-amount"];
    $bid_time = date("Y-m-d");

    // Check if the user has already placed a bid for the given product
    $check_sql = "SELECT * FROM bids WHERE product_id = '$product_id' AND user_id = '$user_id'";
    $check_result = $conn->query($check_sql);
    
    if ($check_result && $check_result->num_rows > 0) {
        echo "You have already placed a bid for this product.";
    } else {
        // Insert the bid into the database
        $sql = "INSERT INTO bids (user_id, bid_amount, bid_time, product_id) VALUES ('$user_id', '$bid_amount', '$bid_time', '$product_id')";
        
        if ($conn->query($sql) === TRUE) {
            // Redirect to a success page or perform any other desired action
            echo "Bid placed successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
