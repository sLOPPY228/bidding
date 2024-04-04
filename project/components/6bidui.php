<?php
include 'db_connect.php';
if (!isset($_GET["product_id"])) {
  echo "no id found";
die();
}
$id = $_GET["product_id"];
// Check if the email already exists
$query = "SELECT * FROM products where product_id=$id";
$result = $conn->query($query);
$r = $result;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bidding Page</title>
  <link rel="stylesheet" href="../css/6bidui.css">
  
 
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


 <!-- for bidding start --> 
<div class="product_container">
  <?php foreach($result as $r){ ?>

  <div class="container_image">

    <?php if($r['P_image'] != null) ?>
        <img src="../<?php echo $r['P_image']; ?>" alt="Image">
  </div>
  
      <div class="container_description" style="border: 2 2 2 2;">
      <h1>User name:<?php echo $r['username']; ?></h1>
      <h3><?php echo $r['description']; ?></h3>
      <p>Minimum Bid Amount:<?php echo $r['start_bid']; ?></span></p>
      <h3><p><?php require_once "highestbid.php"  ?></span></p></h3>
      <form  id="bid-form" action="biddatasend.php" method="post">
        <input type="hidden" name="product_id" value= "<?php echo $r["product_id"]; ?>">
        <label for="bid-amount">Enter your bid:</label>
        <input type="number" id="bid-amount" name="bid-amount" min="<?php echo $r['start_bid']; ?>" required>
        <button type="submit" >Place Bid</button>
      </form>
    </div>
    <?php } ?>

</div>
<!-- for bidding end -->
  
</body>
</html>
