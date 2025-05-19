<?php
include 'db_connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_SESSION['userid'];
    $username = $_SESSION['username'];
    $email = $_POST['email'];
    $category = $_POST["category"];
    $complaint = $_POST["complaint"];

    
    

    $sql = "INSERT INTO complaints (user_id,username,Email,Category,Complaint) 
    VALUES ('$user_id','$username','$email','$category','$complaint')";

    if ($conn->query($sql) === TRUE) {
        header("location: 15docomplain.php?message=Your complain has been sent successfully");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>