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
    $name = $_POST["product-name"];
    $category = $_POST["category"];
    $description = $_POST["description"];
    $start_bid = $_POST["bid1"];
    $regular_price = $_POST["price"];
    $Bid_end = $_POST["end_date"];
    $P_image = $_POST["image"];
    

    $sql = "INSERT INTO products (name,category,description,start_bid,regular_price,Bid_end,P_image) 
    VALUES ('$name','$category','$description','$start_bid','$regular_price','$Bid_end','$P_image')";

    if ($conn->query($sql) === TRUE) {
        echo "file uploaded successfully";
        // header("location: ../login/signin.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>