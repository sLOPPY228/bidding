<?php 
session_start(); 
$conn= new mysqli('localhost','root','','phpgallery')
or die("Could not connect to mysql".mysqli_error($conn));
?>