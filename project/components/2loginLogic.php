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
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Use prepared statement to prevent SQL injection
    $sql = $conn->prepare("SELECT * FROM login_data WHERE username = ?");
    $sql->bind_param("s", $username);
    $sql->execute();
    $result = $sql->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify the password hash
        if (password_verify($password, $row['password'])) {
            if ($row['usertype'] == 2) {
                echo "Your account has been deleted or disabled";
            } else {
                $_SESSION["userid"] = $row["user_id"];
                $_SESSION["username"] = $row["username"];
                $_SESSION["usertype"] = $row["usertype"];
                header("Location:3homepage.php");
                exit();
            }
        } else {
            echo "Invalid username or password";
        }
    } else {
        // Use the same message for both cases to not reveal which part was wrong
        echo "Invalid username or password";
    }
}

$conn->close();
?>
