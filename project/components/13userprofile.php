<?php
include 'db_connect.php';
$id = $_SESSION["userid"];
$stmt = $conn->prepare("SELECT * FROM login_data WHERE user_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../css/userprofile.css">
</head>

<body oncontextmenu="return disableRightClick();">
<!-- navigation bar begin -->
<?php 
if ($_SESSION["usertype"]==0) {
    require_once "../components/0nav.php";
}else {
    require_once "../components/0adminnav.php";
}
?>
<!-- navigation bar ends -->

<?php
if(isset($_GET['message'])) {
    $message = htmlspecialchars($_GET['message']);
    $messageClass = (strpos(strtolower($message), 'success') !== false) ? 'alert-success' : 'alert-error';
    echo "<div class='alert $messageClass'>$message</div>";
}
?>

<?php if($row = $result->fetch_assoc()){ ?>
    <form action="update_password.php" method="post" class="product">
        <div class="product-data">
            <label>Username: <span class="username"><?php echo htmlspecialchars($row['username']);?></span></label>
        </div>

        <div class="product-data">
            <label for="old-password">Current Password</label>
            <input type="password" id="old-password" name="old-password" required 
                   pattern=".{8,}" title="Password must be at least 8 characters long">
        </div>

        <div class="product-data">
            <label for="new-password">New Password</label>
            <input type="password" id="new-password" name="new-password" required 
                   pattern=".{8,}" title="Password must be at least 8 characters long">
        </div>

        <div class="product-data">
            <label for="confirm-password">Confirm New Password</label>
            <input type="password" id="confirm-password" name="confirm-password" required 
                   pattern=".{8,}" title="Password must be at least 8 characters long">
        </div>

        <div class="product-data">
            <button type="submit" name="update">Update Password</button>
        </div>
    </form>

    <?php if ($_SESSION["usertype"]==0) { ?>
        <div class="delete-section">
            <label>Delete Account</label>
            <p>Warning: This action cannot be undone.</p>
            <button type="button" class="deleteBtn" 
                    onclick="if(checkdelete()) window.location.href='14ownuserprofiledelete.php?user_id=<?php echo htmlspecialchars($row["user_id"]); ?>'">
                Delete Account
            </button>
        </div>
    <?php } ?>
<?php } ?>

</body>
<script>
    function checkdelete() {
        return confirm("Are you sure you want to delete your account? This action cannot be undone.");
    }
</script>
</html>