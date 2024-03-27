<?php
$servername = "localhost";  
$username = "root";
$password = "";
$dbname = "phpgallery";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $category = $_POST["category"];
    $name = $_POST["product-name"];
    $description = $_POST["description"];
    $start_bid = $_POST["bid1"];
    $regular_price = $_POST["price"];

    

    $sql = "INSERT INTO products (name,description,start_bid,regular_price) 
    VALUES ('$name','$description','$start_bid','$regular_price')";

    // if ($conn->query($sql) === TRUE) {
    //     header("location: ../login/signin.html");
    //     exit();
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }
}
$conn->close();
?>