<?php
include 'db_connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["product_id"];
}
$sql = "UPDATE products set product_status = 'SOLD' WHERE product_id = '$id'";
$result = $conn->query($sql);
header("Location:8yourbids.php?message=The payment has been successful");

?>