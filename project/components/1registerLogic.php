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
    $usertype = 0;


    if (!preg_match("/^[a-zA-Z0-9]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        die("Invalid email format.");
    }
    

    if (strlen($password) < 8 || strlen($password) > 50) {
        die("Password must be between 8 and 50 characters long.");
    }

    if ($password!=$repassword) {
        die("Password do not match!");    
    }        

    $sql = $conn->prepare("SELECT user_id FROM login_data WHERE username = ?");
    $sql->bind_param("s", $username);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        die("Username already exists. Please choose a different username.");
    }

    $sql = $conn->prepare("SELECT user_id FROM login_data WHERE email = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        die("email already exists. Please choose a different email.");
    }

    // Hash the password before storing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = $conn->prepare("INSERT INTO login_data (username, email, password, usertype) VALUES (?, ?, ?, ?)");
    $sql->bind_param("sssi", $username, $email, $hashed_password, $usertype);

    if ($sql->execute()) {
        header("location: 2signin.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>