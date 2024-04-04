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


    if (!preg_match("/^[a-zA-Z]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
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
    // hashing end

    // $password = password_hash($password, PASSWORD_DEFAULT);
    // $query = "insert into users(user_id,name,email,password) values('','$name','$email','$password')";
    // $result = mysqli_query($conn, $query);


    // hashingstart
    
    $sql = "INSERT INTO login_data (username,email, password,usertype) VALUES ('$username', '$email','$password','$usertype')";


    if ($conn->query($sql) === TRUE) {
        header("location: 2signin.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>