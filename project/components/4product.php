<?php
include 'db_connect.php';
?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../css/product.css" />
  </head>
  <body>


    <!-- navigation bar begin -->
   <?php
   require_once "../components/nav.php";
   ?>
   <!-- navigation bar ends -->
   
   
   <!-- userphpstart -->
   <?php

if(isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
  $userid = $_SESSION['userid'];
}

$query = "SELECT * FROM products where user_id = $userid";
$result = $conn->query($query);
$r = $result;
 ?>
   <!-- userphpend -->
   
    
   <table>
      <div class="content">
        <label for="">Your products</label>
        <button><a href="5create.php">New post</a></button>
      </div>
      <div class="content">
          <tr>
           
            <th>Product Name</th>
            <th>Category</th>
            <th>Product Description</th>
            <th>Start Date</th>
            <th>Regular Price</th>
            <th>End Date</th>
            <th>Product Image</th>
            <th>Action</th>
          </tr>
          <?php foreach($result as $r){ ?>
        <tr>
          
         <td><?php echo $r['name']; ?></td>
         <td><?php echo $r['category']; ?></td>
         <td><?php echo $r['description']; ?></td>
         <td><?php echo $r['start_bid']; ?></td>
         <td><?php echo $r['regular_price']; ?></td>
         <td><?php echo $r['Bid_end']; ?></td>
         <td class="imgCell">
        <?php if($r['P_image'] != null) ?>
        <img src="../<?php echo $r['P_image']; ?>" alt="Image">
        </td>
         <td>
          <button class="editBtn" >Edit</button>
         <button class="deleteBtn"><a href="filedeletelogic.php?id=<?php echo $r["id"]; ?>">Delete</a></button>
        </td>
         
  </tr>
  <?php } ?>
        
      </div>
    </table>
  </body>
  <style></style>
</html>