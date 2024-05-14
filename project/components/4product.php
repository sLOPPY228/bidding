<?php
include 'db_connect.php';
?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product</title>
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
   <?php

if(isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
  $userid = $_SESSION['userid'];
}

$query = "SELECT * FROM products where user_id = $userid AND product_status = 'ACTIVE'";
$result = $conn->query($query);
$r = $result;
 ?>
   <!-- userphpend -->
   
    
   <div class="content">
    <h1>YOUR PRODUCTS</h1>
     <button><a href="5create.php">New post</a></button>
     
   </div>
   <div class="content">
    <br>
     <table>
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
          
         <td><?php echo $r['product_name']; ?></td>
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
          
         <button ><a href="11product_bids.php?product_id=<?php echo $r["product_id"]; ?>">View Details</a></button>

         <button class="deleteBtn" onclick='return checkdelete()'><a href="filedeletelogic.php?product_id=<?php echo $r["product_id"]; ?>">Delete</a></button>
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