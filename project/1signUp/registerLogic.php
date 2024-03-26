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
    $username = $_POST["username"];
    $email = $_POST["email"];    
    $password = $_POST["password"];
    $repassword = $_POST["confirmpassword"];

    if ($password!=$repassword) {
        die("Password do not match!");    
    }        


    

    $sql = "INSERT INTO login_data (username,email, password) VALUES ('$username', '$email','$password')";

    if ($conn->query($sql) === TRUE) {
        header("location: ../login/signin.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>