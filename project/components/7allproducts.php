<?php
include 'db_connect.php';
// Check if the email already exists
$query = "SELECT * FROM products";


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
    
   <table>
      <div class="content">
        <label for="">All Products</label>
        
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
          <button class="editBtn" >Edit</button><br>
         <button class="deleteBtn"  onclick='return checkdelete()'><a href="filedeletelogic.php?product_id=<?php echo $r["product_id"]; ?>">Delete</a></button>
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