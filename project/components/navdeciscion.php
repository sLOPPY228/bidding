<?php session_start(); 
if ($_SESSION["usertype"]==0) {
    require_once "../components/nav.php";
}else {
    require_once "../components/adminnav.php";
}

?>