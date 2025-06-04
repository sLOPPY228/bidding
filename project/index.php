<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is already logged in
if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
    // If logged in, redirect to homepage
    header("Location: components/3homepage.php");
    exit();
} else {
    // If not logged in, redirect to login page
    header("Location: components/2signin.php");
    exit();
}
?> 