<?php
include 'db_connect.php';
// Check if the email already exists
$query = "SELECT * FROM login_data WHERE usertype = 0";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>All Users</title>
    <link rel="stylesheet" href="../css/4product.css" />
</head>
<body oncontextmenu="return disableRightClick();">

    <!-- navigation bar begin -->
    <?php 
    if ($_SESSION["usertype"] == 0) {
        require_once "../components/0nav.php";
    } else {
        require_once "../components/0adminnav.php";
    }
    ?>
    <!-- navigation bar ends -->

    <div class="content">
        <h1>ALL USERS</h1>
    </div>
    <div class="content">
        <table>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
            <?php foreach($result as $r) { ?>
            <tr>
                <td><?php echo $r['user_id']; ?></td>
                <td><?php echo $r['username']; ?></td>
                <td><?php echo $r['email']; ?></td>
                <td><?php echo $r['password']; ?></td>
                <td>
                    <button class="deleteBtn" onclick='return checkdelete(<?php echo $r["user_id"]; ?>)'>Delete User</button>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <script>
    function checkdelete(user_id) {
        if (confirm('Are you sure you want to delete this user?')) {
            window.location.href = 'adminuserprofiledelete.php?user_id=' + user_id;
            return true;
        }
        return false;
    }

    function disableRightClick() {
        return false;
    }
    </script>
</body>
</html>
