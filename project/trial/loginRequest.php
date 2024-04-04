-<?php
include 'db_connect.php';
if($_SERVER['REQUEST_METHOD']=== 'POST'){
  $email = $_POST['email'];
  $password = $_POST['password'];

  if(empty($email) || empty($password)){
    header("Location: login.php?error=Please fill the form");
    exit;
  }
  //checking if email exists in the database
  $check = "select * from users where email = '$email'";
  $result = mysqli_query($conn, $check);
  if(mysqli_num_rows($result) === 0){
    header("Location: login.php?error=Email does not exists");
    exit;
  }
  $user = mysqli_fetch_assoc($result);
  if(password_verify($password,$user['password'])){
    session_start();
    $_SESSION['user_id']= $user['user_id'];
    $_SESSION['user_email']= $user['email'];
    header("Location: index.php");
    exit;
  }else{
    header("Location: login.php?error=Incorrect Password");
    exit;
  }
}
?>