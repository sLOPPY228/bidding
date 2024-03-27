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
    $password = $_POST["password"];

    $sql = "SELECT * FROM login_data WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header("Location: ../3homepage/homepage.php");
        exit();
    } else {
        echo "Invalid username or password";
    }
}

$conn->close();
?>