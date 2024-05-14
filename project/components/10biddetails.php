<?php
include 'db_connect.php';

// $query = "SELECT product_id, COUNT(*) AS count_occurrences
// FROM bids
// GROUP BY product_id
// HAVING COUNT(*) >= 1;
// ";


$query = "SELECT p.*, b.count_occurrences
FROM products p
INNER JOIN (
    SELECT product_id, COUNT(*) AS count_occurrences
    FROM bids
    GROUP BY product_id
    HAVING COUNT(*) >= 1
) b ON p.product_id = b.product_id
WHERE p.product_status = 'ACTIVE';
";



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
   <h1>BID DETAILS</h1>
     
   </div>
   <table>
      <div class="content">
          <tr>
           
            <th>Product Name</th>
            <th>Category</th>
            <th>Product Description</th>
            <th>Product Image</th>
            <th>Bid Status</th>
            <th>Further Details</th>
          </tr>
          <?php foreach($result as $r){ ?>
        <tr>
         <!-- <td><?php echo $r['product_id']; ?></td> -->
          
         <td><?php echo $r['product_name']; ?></td>
         <td><?php echo $r['category']; ?></td>
         <td><?php echo $r['description']; ?></td>
         <td class="imgCell">
        <?php if($r['P_image'] != null) ?>
        <img src="../<?php echo $r['P_image']; ?>" alt="Image">
        </td>
         <td> <?php
          $currentdate=date("Y-m-d");

            if ($currentdate >= $r['Bid_end']) {
               echo"<h3>Bid ended</h3>";
            }else {
               echo"<h3>On going</h3>";
            }
            ?></td>
        
         <td>
          
         <button ><a href="11product_bids.php?product_id=<?php echo $r["product_id"]; ?>">View Details</a></button>
        </td>
         
  </tr>
  <?php } ?>
        
      </div>
    </table>
  </body>
</html>