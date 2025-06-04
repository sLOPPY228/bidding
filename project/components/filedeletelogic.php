<?php
include 'db_connect.php';

if (!isset($_POST["product_id"])) {
    echo json_encode(["status" => "error", "message" => "No product ID provided"]);
    exit();
}

$product_id = $_POST["product_id"];

// Update product status to 'DELETED' instead of actually deleting
$sql = "UPDATE products SET product_status = 'DELETED' WHERE product_id = '$product_id'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success", "message" => "Product deleted successfully!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error deleting product: " . $conn->error]);
}

$conn->close();
?>
