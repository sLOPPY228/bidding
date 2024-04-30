<?php
include 'db_connect.php';

// Check if the email already exists
$query = "SELECT * FROM products";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
  <head>
    <link rel="stylesheet" href="../css/3homepage.css" />
    <title>Galler-E</title>
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


<!-- container product start -->

<div class="container_product" >
<?php foreach($result as $r){ ?>
    <div class="item_product">
    <td class="imgCell">
        <?php if($r['P_image'] != null) ?>
        <img src="../<?php echo $r['P_image']; ?>" alt="Image">
        </td>
      <h3><?php echo $r['product_name']; ?></h3>
      <p>BID END IN:<BR><?php echo $r['Bid_end']; ?></p>
      <p>Starting Bid : <?php echo $r['start_bid']; ?></p>
      
      <button><a href="6bidui.php?product_id=<?php echo $r["product_id"]; ?>">Bid item</a></button>
    </div>
    <?php } ?>
    
    
    <!-- Add more item_products here -->
  <!-- </div> -->

<!-- container product end -->

</div>

  </body>
</html>
