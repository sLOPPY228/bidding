<?php
include 'db_connect.php';
// Check if the email already exists
$query = "SELECT * FROM login_data
where usertype = 0";


$result = $conn->query($query);
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../css/4product.css" />
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
    
   <div class="content">
   <h1>ALL USERS</h1>
     
   </div>
   <table>
      <div class="content">
          <tr>
           
            <th>User_id</th>
            <th>Username</th>
            <th>E-mail</th>
            <th>Password</th>
            <th>Action</th>
          </tr>
          <?php foreach($result as $r){ ?>
        <tr>
          
         <td><?php echo $r['user_id']; ?></td>
         <td><?php echo $r['username']; ?></td>
         <td><?php echo $r['email']; ?></td>
         <td><?php echo $r['password']; ?></td>

         <td>
          
         <button class="deleteBtn"  onclick='return checkdelete()'><a href="adminuserprofiledelete.php?user_id=<?php echo $r["user_id"]; ?>">Delete User</a></button>
        </td>
         
  </tr>
  <?php } ?>
        
      </div>
    </table>
  </body>
  <script>
    function checkdelete() {
      return confirm("Are you sure about that?");
    }
  </script>
</html>