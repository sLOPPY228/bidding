<?php
include 'db_connect.php';
$id = $_SESSION["userid"] ;
// $username = $_GET["username"];
// $query = "SELECT *
// FROM login_data
// where user_id = $id;
// ";


// $result = $conn->query($query);

?>
<?php
// Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input fields
    // $username = htmlspecialchars($_POST['username']);
    $oldPassword = htmlspecialchars($_POST['old-password']);
    $newPassword = htmlspecialchars($_POST['new-password']);
    $confirmPassword = htmlspecialchars($_POST['confirm-password']);

    // Check if old password matches the one in the database
    $query = "SELECT * FROM login_data WHERE user_id = '$id' AND password = '$oldPassword'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Check if new password and confirm password match
        if ($newPassword === $confirmPassword) {
            // Update the password in the database
            $updateQuery = "UPDATE login_data SET password = '$newPassword' WHERE user_id = '$id'";
            if (mysqli_query($conn, $updateQuery)) {
                echo "Password updated successfully.";
            } else {
                echo "Error updating password: " . mysqli_error($conn);
            }
        } else {
            echo "New password and confirm password do not match.";
        }
    } else {
        echo "Username or old password is incorrect.";
    }
}
?>
