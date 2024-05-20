<?php
include 'db_connect.php';
// Check if the email already exists
$query = "SELECT * FROM COMPLAINTS ";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>All ISSUES</title>
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
        <h1>USER ISSUES</h1>
    </div>
    <div class="content">
        <table>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Complain</th>
                
            </tr>
            <?php foreach($result as $r) { ?>
            <tr>
                <td><?php echo $r['user_id']; ?></td>
                <td><?php echo $r['username']; ?></td>
                <td><?php echo $r['Email']; ?></td>
                <td><?php echo $r['Complaint']; ?></td>
                
            </tr>
            <?php } ?>
        </table>
    </div>

    
</body>
</html>
