<?php

include 'db_connect.php';
if (!isset($_GET["id"])) {
  echo "no id found";
die();
}

$id = $_GET["id"];
$query = "DELETE FROM products WHERE id = '$id'";
$data=mysqli_query($conn,$query);

if ($data) {
    echo "data deleted";
    header("Location:3homepage.php");
} else {
    echo "error";
}
?>
