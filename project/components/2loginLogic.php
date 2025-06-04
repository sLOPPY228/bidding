<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpgallery";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate input
    if (empty($username) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "Username and password are required"]);
        exit();
    }

    // Prepare SQL query with prepared statements for security
    $stmt = $conn->prepare("SELECT * FROM login_data WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Set session variables
            $_SESSION["userid"] = $row["user_id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["usertype"] = $row["usertype"];
            
            echo json_encode([
                "status" => "success", 
                "message" => "Login successful!", 
                "redirect" => "3homepage.php",
                "usertype" => $row["usertype"]
            ]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid password"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Username not found"]);
    }
    
    $stmt->close();
}

$conn->close();
?>
