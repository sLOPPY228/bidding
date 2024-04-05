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


// // Prepare SQL query
// $sql = "SELECT user_id FROM product WHERE product_id = $id";

// // Execute query
// $result = $conn->query($sql);

// // Check if any rows were returned
// if ($result->num_rows > 0) {
//   // Fetch the data from the result set
//   $row = $result->fetch_assoc();
//   $user_id = $row["user_id"];
//   echo "Username: " . $username;
// } else {
//   echo "No results found.";
// }


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
      <p>BID ENDS IN:<?php echo $r['Bid_end']; ?></p>
      <h3><p><?php require_once "highestbid.php"  ?></span></p></h3>
      
       <?php
       $currentdate=date("Y-m-d");
      //  echo $currentdate;
      //  echo $r['user_id'];
       $currentuser=$r['user_id']; 
      //  echo $currentuser;
      //  echo "and";
      //  echo $_SESSION["userid"];
      if ($currentdate <= $r['Bid_end']) {
        if ($currentuser !== $_SESSION["userid"]) {
          require_once "bidmodule.php";
         }else {
          echo "<br>";
          echo "<h1>You cannot bid on your own product!</h1>";
         }
      }else{
        echo "<br>";
          echo "<h1>Bidding time has ended!</h1>";
      }
       
       ?>
    </div>
    <?php } ?>

</div>
<!-- for bidding end -->
  
</body>
</html>
