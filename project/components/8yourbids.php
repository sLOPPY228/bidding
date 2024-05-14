<?php
include 'db_connect.php';
?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bids</title>
    <link rel="stylesheet" href="../css/8yourbids.css" />
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
// $query = "SELECT b.bid_id, b.product_id, b.user_id, p.product_name,p.category,p.description,p.Bid_end,p.P_image

$query = "SELECT b.*,p.*
FROM bids b 
INNER JOIN products p
ON b.product_id = p.product_id
where b.user_id = $userid
AND p.product_status = 'ACTIVE';
";

// $query = "SELECT * FROM bids where user_id = $userid";
// $query = "SELECT p.*,b.* FROM products p,bids b where p.user_id = $userid AND b.user_id = $userid";
// $query = "SELECT p.*,b.product_id,user_id,bid_amount,bid_id FROM products p,bids b where  b.user_id = $userid";

$result = $conn->query($query);
$r = $result;
 ?>
   <!-- userphpend -->
   
    
   <table>
      <div class="content">
        <h1>YOUR BIDS</h1>
        
      </div>
      <div class="content">
          <tr>
           <!-- <th>bid id</th> -->
            <th>Product Name</th>
            <!-- <th>Category</th>
            <th>Product Description</th> -->
            <!-- <th>Start price</th>
            <th>Regular Price</th> -->
            <th>Bidded amount</th>
            <th>Product Image</th>
            <th>Bid Status</th>
            <th>Bid result</th>
          </tr>
          <?php foreach($result as $r){ ?>
        <tr>
          <!-- <td><?php echo $r['bid_id']; ?></td> -->
         <td><?php echo $r['product_name']; ?></td>
         <!-- <td><?php echo $r['category']; ?></td>
         <td><?php echo $r['description']; ?></td> -->
         <td><?php echo $r['bid_amount']; ?></td>
         

        <div class="item_product">
         <td class="imgCell">
        <?php if($r['P_image'] != null) ?>
        <img src="../<?php echo $r['P_image']; ?>" alt="Image">
        </td>
          </div>

        </td>
        <td> 
            <?php
          $currentdate=date("Y-m-d");

            if ($currentdate >= $r['Bid_end']) {
               echo"<h3>Bid ended</h3>";
            }else {
               echo"<h3>On going</h3>";
            }
            ?>
        </td>
         <td>
         <?php
          $currentdate=date("Y-m-d");

            if ($currentdate >= $r['Bid_end']) { ?>
          
         <?php
         require "bidresult.php";
            }else {
              ?>
              <h3>Results will be shown after bid has ended.</h3>
            <?php
            }
            ?>
        </td>
         
  </tr>
  <?php } ?>
        
      </div>
    </table>
  </body>
</html>