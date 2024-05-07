<?php
include 'db_connect.php';
$id = $_SESSION["userid"] ;
$query = "SELECT *
FROM login_data
where user_id = $id;
";


$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/5create.css">
</head>

<body oncontextmenu=" return disableRightClick();">
<!-- navigation bar begin -->
<?php 
if ($_SESSION["usertype"]==0) {
    require_once "../components/0nav.php";
}else {
    require_once "../components/0adminnav.php";
}

?>
   <!-- navigation bar ends -->

   <?php foreach($result as $r){ ?>

   <form action="file_edit.php " method="post" class="product" enctype="multipart/form-data">
        <div class="product-data">
            <label>Username : <?php echo $r['username'];?></label>
            <!-- <input type="hidden" name="username" value=<?php  echo $r['username']; ?>> -->
            <!-- <input type="text" name="username" value="<?php echo $r['username']; ?>" required> -->
        </div>

        <div class="product-data">
            <label>Password</label>
            <input type="text" name="old-password" required>
        </div>

        <div class="product-data">
            <label>New Password</label>
            <input type="text" name="new-password" required>
        </div>

        <div class="product-data">
            <label>Confirm Password</label>
            <input type="text" name="confirm-password" required>
        </div>


        <div class="product-data">
            <button type="submit" name="Add" >Update Acccount</button>
        </div>

    </form>
    <form >
        <label >Delete account</label><br><br>
        <div class="product-data">
            <button class="deleteBtn"  onclick='return checkdelete()'><a href="14ownuserprofiledelete.php?user_id=<?php echo $r["user_id"]; ?>">Delete User</a></button>
            </div>
    </form>
    
<!-- form end -->
<?php } ?>


</body>
<script>
    function checkdelete() {
      return confirm("Are you sure about that?");
    }
  </script>
</html>