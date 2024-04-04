<?php

include 'db_connect.php';
if (!isset($_GET["product_id"])) {
  echo "no id found";
die();
}

$id = $_GET["product_id"];
$query = "DELETE FROM products WHERE product_id = '$id'";
$data=mysqli_query($conn,$query);

if ($data) {
    echo "data deleted";
    header("Location:3homepage.php");
} else {
    echo "error";
}
?>
