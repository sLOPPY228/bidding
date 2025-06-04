<?php
session_start(); 

$servername = "localhost";  
$username = "root";
$password = "";
$dbname = "phpgallery";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $user_id = $_SESSION["userid"];
    $bid_amount = $_POST["bid-amount"];
    $bid_time = date("Y-m-d");
    $bid_status = "NORMAL";

    // First check if the user is the owner of the product
    $owner_check_sql = "SELECT user_id FROM products WHERE product_id = '$product_id'";
    $owner_result = $conn->query($owner_check_sql);
    
    if ($owner_result && $owner_result->num_rows > 0) {
        $product_owner = $owner_result->fetch_assoc();
        if ($product_owner['user_id'] == $user_id) {
            echo json_encode(["status" => "error", "message" => "Error: You cannot bid on your own product!"]);
            exit();
        }
    }

    // Check if the user has already placed a bid for the given product
    $check_sql = "SELECT * FROM bids WHERE product_id = '$product_id' AND user_id = '$user_id'";
    $check_result = $conn->query($check_sql);
    
    if ($check_result && $check_result->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "You have already placed a bid for this product."]);
    } else {
        // Insert the bid into the database
        $sql = "INSERT INTO bids (user_id, bid_amount, bid_time, product_id, bid_status) VALUES ('$user_id', '$bid_amount', '$bid_time', '$product_id', '$bid_status')";
        
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["status" => "success", "message" => "Bid placed successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $sql . "<br>" . $conn->error]);
        }
    }
}

$conn->close();
?>
