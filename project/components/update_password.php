<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION["userid"])) {
    header("Location: 2signin.php");
    exit();
}

$id = $_SESSION["userid"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldPassword = $_POST['old-password'];
    $newPassword = $_POST['new-password'];
    $confirmPassword = $_POST['confirm-password'];

    // Validate password length
    if (strlen($newPassword) < 8) {
        header("Location: 13userprofile.php?message=New password must be at least 8 characters long");
        exit();
    }

    // Check if new passwords match
    if ($newPassword !== $confirmPassword) {
        header("Location: 13userprofile.php?message=New password and confirm password do not match");
        exit();
    }

    // Get the current password hash from database
    $stmt = $conn->prepare("SELECT password FROM login_data WHERE user_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        // Verify the old password
        if (password_verify($oldPassword, $row['password'])) {
            // Hash the new password
            $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
            
            // Update the password
            $updateStmt = $conn->prepare("UPDATE login_data SET password = ? WHERE user_id = ?");
            $updateStmt->bind_param("si", $newPasswordHash, $id);
            
            if ($updateStmt->execute()) {
                header("Location: 13userprofile.php?message=Password updated successfully");
            } else {
                header("Location: 13userprofile.php?message=Error updating password");
            }
            $updateStmt->close();
        } else {
            header("Location: 13userprofile.php?message=Current password is incorrect");
        }
    } else {
        header("Location: 13userprofile.php?message=User not found");
    }
    $stmt->close();
}

$conn->close();
?>
