<?php 

include 'db_connect.php';

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

    
    

    $sql = "INSERT INTO products (user_id,username,product_name,category,description,start_bid,regular_price,Bid_end,P_image) 
    VALUES ('$user_id','$username','$name','$category','$description','$start_bid','$regular_price','$Bid_end','$P_image')";

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