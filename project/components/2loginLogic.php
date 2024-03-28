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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST["username"]); // Using real_escape_string for SQL injection prevention
    $password = $conn->real_escape_string($_POST["password"]);

    $sql = "SELECT * FROM login_data WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["userid"] = $row["id"]; // Assuming your user id column name is 'id'
        $_SESSION["username"] = $row["username"];
        header("Location:3homepage.php");
        exit();
    } else {
        echo "Invalid username or password";
    }
}

$conn->close();
?>
