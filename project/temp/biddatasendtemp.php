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
$product_id=$_POST["product_id"];
$user_id= $_SESSION["userid"];
$bid_amount=$_POST["bid-amount"];
$bid_time= date("Y-m-d");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // $sql = "SELECT * FROM products";
    // $result = $conn->query($sql);

    // // Check if the query executed successfully
    // if ($result === FALSE) {
    //     die("Error executing query: " . $conn->error);
    // }else {
    //     $row = $result->fetch_assoc();
    //     $_SESSION["product_id"] = $row["product_id"];
    //     // echo  $_SESSION["product_id"];
    // }




    $sql = "INSERT INTO bids (user_id,bid_amount,bid_time,product_id) VALUES ('$user_id', '$bid_amount','$bid_time','$product_id')";


    if ($conn->query($sql) === TRUE) {
        // header("location: 3homepage.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$conn->close();
?>