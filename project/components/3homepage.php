<?php
$conn= new mysqli('localhost','root','','phpgallery')or die("Could not connect to mysql".mysqli_error($con));

// Check if the email already exists
$query = "SELECT * FROM products";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
  <head>
    <link rel="stylesheet" href="../css/homepage.css" />
    <title>Galler-E</title>
  </head>



  <body>




   <!-- navigation bar begin -->
   <?php
   require_once "../components/nav.php";
   ?>
   <!-- navigation bar ends -->


<!-- container product start -->


<div class="container_product" ">
<?php foreach($result as $r){ ?>
    <div class="item_product">
    <td class="imgCell">
        <?php if($r['P_image'] != null) ?>
        <img src="../<?php echo $r['P_image']; ?>" alt="Image">
        </td>
      <h3><?php echo $r['name']; ?></h3>
      <p><?php echo $r['description']; ?></p>
      <p>Star Bid</p>
      <P><?php echo $r['start_bid']; ?></P>
      <button><a href="6bidui.php?id=<?php echo $r["id"]; ?>">Bid item</a></button>
    </div>
    <?php } ?>
    
    
    <!-- Add more item_products here -->
  </div>

<!-- container product end -->

</div>

  </body>
</html>
