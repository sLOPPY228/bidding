<?php
include 'db_connect.php';

// Check if product_id is set in the URL parameters
if (!isset($_GET["product_id"])) {
    echo "No product ID found.";
    die();
}

// Get the product_id from the URL
$id = $_GET["product_id"];

// Delete from products database
$query_products = "UPDATE products SET product_status = 'DELETED' WHERE user_id = '$id'";
$result_products = mysqli_query($conn, $query_products);

// Delete from bids database
$query_bids = $query_user = "UPDATE bids SET bid_status = 'DELETED' WHERE user_id = '$id'";
$result_bids = mysqli_query($conn, $query_bids);

// Check if deletion was successful for both databases
if ($result_products && $result_bids) {
    echo "Data deleted successfully from both databases.";
    header("Location: 3homepage.php");
} else {
    echo "Error deleting data.";
}
?>
