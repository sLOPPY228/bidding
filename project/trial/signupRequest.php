<?php
include 'db_connect.php';
if($_SERVER['REQUEST_METHOD']=== 'POST'){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  
  //server-side check if user left any empty field
  if(empty($name) || empty($email) || empty ($password) || empty($cpassword) ){
    header("Location: signup.php?error=fill up the form");
    exit;
  }
  //checking email through function made in php 
  if(validateEmail($email) === false){
    header("Location: signup.php?error=Invalid email");
    exit;
  }
  //checking if the password and confirm password match
  if($password !== $cpassword){
    header("Location: signup.php?error=Password doesn't match");
    exit;
  }
  //checking if email exist in the database
  $copy = mysqli_query($conn, "select * from users where email = '$email'" );
  if(mysqli_num_rows($copy) > 0){
    header('Location: signup.php?error=Email already taken');
    exit;
  }
  //inserting data into database users

  $password = password_hash($password, PASSWORD_DEFAULT);
  $query = "insert into users(user_id,name,email,password) values('','$name','$email','$password')";
  $result = mysqli_query($conn, $query);

  //if result is true then goes to login
  if($result){
    header('Location: login.php');
  }
}
function validateEmail($email){
  return filter_var($email,FILTER_VALIDATE_EMAIL);
}
?>