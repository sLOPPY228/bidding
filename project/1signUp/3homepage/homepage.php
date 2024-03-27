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
    <link rel="stylesheet" href="homepage.css" />
    <title>Galler-E</title>
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


<!-- container product start -->

<div class="container_product" ">
<?php foreach($result as $r){ ?>
    <div class="item_product">
    <td class="imgCell">
        <?php if($r['P_image'] != null) ?>
        <img src="../pic/<?php echo $r['P_image']; ?>" alt="Image">
        </td>
      <h3><?php echo $r['name']; ?></h3>
      <p><?php echo $r['description']; ?></p>
      <p>Star Bid</p>
      <P><?php echo $r['start_bid']; ?></P>
      <button><a href="bidui.php">Bid item</a></button>
    </div>
    <?php } ?>
    
    
    
    <!-- Add more item_products here -->
  </div>

<!-- container product end -->

</div>

    <footer></footer>
    <script>
      const prev = document.getElementById("prev-btn");
      const next = document.getElementById("next-btn");
      const list = document.getElementById("item-list");

      const itemWidth = 150;
      const padding = 10;

      prev.addEventListener("click", () => {
        list.scrollLeft -= itemWidth + padding;
      });

      next.addEventListener("click", () => {
        list.scrollLeft += itemWidth + padding;
      });
    </script>
  </body>
</html>
