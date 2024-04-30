<?php
include 'db_connect.php';
// Check if the email already exists
$id = $_GET['product_id'];
// echo $id;
// $query = "SELECT *
// FROM products
// WHERE product_id = $id
// ";

$query = "SELECT b.*,l.*
FROM bids b 
INNER JOIN login_data l
ON b.user_id = l.user_id
where b.product_id = $id
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
   <h1>ALL BIDS ON THIS PRODUCTS</h1>
     
   </div>
   <table>
      <div class="content">
          <tr>
           
            <th>User Name</th>
            <th>Email</th>
            <th>Bid Amount</th>
            <th>Bid Time</th>
          </tr>
          <?php foreach($result as $r){ ?>
        <tr>
          
         <td><?php echo $r['username']; ?></td>
         <td><?php echo $r['email']; ?></td>
         <td><?php echo $r['bid_amount']; ?></td>
         <td><?php echo $r['bid_time']; ?></td>
         
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