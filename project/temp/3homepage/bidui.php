<?php
$conn= new mysqli('localhost','root','','phpgallery')or die("Could not connect to mysql".mysqli_error($con));
if (!isset($_GET["id"])) {
  echo "no id found";
die();
}
$id = $_GET["id"];
// Check if the email already exists
$query = "SELECT * FROM products where id=$id";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$r = $result;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bidding Page</title>
  <link rel="stylesheet" href="bidui.css">
  
 
</head>
<body>

 <!-- navigation bar begin -->
 <nav>
    <div class="logo">
        Galler-E 
     </div>
     <div class="menu">
         <ul>
             <li><a href="homepage.php">Home</a></li>
             <li><a href="#">Categories</a></li>
             <li><a href="../4addproduct/product.php">Products</a></li>
             <li><a href="#"><img src="../pic/pfp.png"></a></li>
         </ul>
     </div>
   </nav>


  
<div class="product_container">
  <?php foreach($result as $r){ ?>

  <div class="container_image">

    <?php if($r['P_image'] != null) ?>
        <img src="../pic/<?php echo $r['P_image']; ?>" alt="Image">
  </div>
  
      <div class="container_description" style="border: 2 2 2 2;">
      <h1>user name</h1>
      <h3><?php echo $r['description']; ?></h3>
      <p>Minimum Bid Amount:<?php echo $r['start_bid']; ?></span></p>
      <form id="bid-form">
        <label for="bid-amount">Enter your bid:</label>
        <input type="number" id="bid-amount" name="bid-amount" min="<?php echo $r['start_bid']; ?>" required>
        <button type="submit">Place Bid</button>
      </form>
    </div>
    <?php } ?>

</div>



  
    
</body>
</html>
