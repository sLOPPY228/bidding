<?php session_start(); ?>

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

    $user_id = $_SESSION['userid'];
    $username = $_SESSION['username'];
    $name = $_POST["product-name"];
    $category = $_POST["category"];
    $description = $_POST["description"];
    $start_bid = $_POST["bid1"];
    $regular_price = $_POST["price"];
    $Bid_end = $_POST["end_date"];
    $image = $_FILES['image']['name'];
    $target = "../pic/".basename($image);
    $P_image = "pic/".basename($image);
    $product_status = "ACTIVE";
    
    

    $sql = "INSERT INTO products (user_id,username,product_name,category,description,start_bid,regular_price,Bid_end,P_image,product_status) 
    VALUES ('$user_id','$username','$name','$category','$description','$start_bid','$regular_price','$Bid_end','$P_image','$product_status')";

    if ($conn->query($sql) === TRUE) {
        move_uploaded_file($_FILES['image']['tmp_name'],$target);
        // alert "file uploaded successfully";
        header("location: 4product.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>