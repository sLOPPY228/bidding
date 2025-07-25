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
     <button id="newPostBtn" class="action-button">New post</button>
     
   </div>
   <div class="content">
    <br>
     <table>
     <tr>
           
            <th>Product Name</th>
            <th>Category</th>
            <th>Product Description</th>
            <th>Start Date</th>
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
         <td><?php echo $r['Bid_end']; ?></td>
         <td class="imgCell">
        <?php if($r['P_image'] != null) ?>
        <img src="../<?php echo $r['P_image']; ?>" alt="Image">
        </td>
         <td>
          
         <button class="view-details-btn action-button" data-product-id="<?php echo $r["product_id"]; ?>">View Details</button>

         <button class="delete-btn action-button" data-product-id="<?php echo $r["product_id"]; ?>">Delete</button>
        </td>
         
  </tr>
  <?php } ?>
        
      </div>
    </table>
  </body>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        // New Post Button
        document.getElementById('newPostBtn').addEventListener('click', function() {
            window.location.href = '5create.php';
        });

        // View Details Buttons
        document.querySelectorAll('.view-details-btn').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                window.location.href = `11product_bids.php?product_id=${productId}`;
            });
        });

        // Delete Buttons
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                if (confirm('Are you sure you want to delete this product?')) {
                    window.location.href = `filedeletelogic.php?product_id=${productId}`;
                }
            });
        });
    });

    function disableRightClick() {
        return false;
    }
  </script>

<style>
.action-button {
    padding: 8px 16px;
    margin: 4px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.1s;
}


</style>
</html>