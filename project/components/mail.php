
<?php
include 'db_connect.php';

$to = $_POST["email"] // Recipient's email address
$subject = echo "Test Emailasdf"; // Email subject
$message = "This is a test email sent from PHP."; // Email message
$headers = "From: sender@example.com"; // Sender's email address

// Send the email
if (mail($to, $subject, $message, $headers)) {
    echo "Product will be sent to your mail";
} else {
    echo "Error sending email.";
}
?>
