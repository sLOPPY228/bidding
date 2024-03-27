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
    <div class="item_product">
      <img src="./pfp.png" alt="item 1">
      <h3>item 1</h3>
      <p>Description of item 1</p>
      <p>$20.00</p>
      <button><a href="bidui.php">Bid item</a></button>
    </div>
    <div class="item_product">
      <img src="pfp.png" alt="item_product 2">
      <h3>item_product 2</h3>
      <p>Description of item_product 2</p>
      <p>$25.00</p>
      <button><a href="bidui.php">Bid item</a></button>
    </div>
    <div class="item_product">
      <img src="pfp.png" alt="item_product 3">
      <h3>item_product 3</h3>
      <p>Description of item_product 3</p>
      <p>$30.00</p>
      <button><a href="bidui.php">Bid item</a></button>
    </div>
    <div class="item_product">
      <img src="pfp.png" alt="item 1">
      <h3>item 1</h3>
      <p>Description of item 1</p>
      <p>$20.00</p>
      <button><a href="bidui.php">Bid item</a></button>
    </div>
    <div class="item_product">
      <img src="pfp.png" alt="item_product 2">
      <h3>item_product 2</h3>
      <p>Description of item_product 2</p>
      <p>$25.00</p>
      <button><a href="bidui.php">Bid item</a></button>
    </div>
    <div class="item_product">
      <img src="pfp.png" alt="item_product 3">
      <h3>item_product 3</h3>
      <p>Description of item_product 3</p>
      <p>$30.00</p>
      <button><a href="bidui.php">Bid item</a></button>
    </div>
    <div class="item_product">
      <img src="pfp.png" alt="item 1">
      <h3>item 1</h3>
      <p>Description of item 1</p>
      <p>$20.00</p>
      <button><a href="bidui.php">Bid item</a></button>
    </div>
    <div class="item_product">
      <img src="pfp.png" alt="item_product 2">
      <h3>item_product 2</h3>
      <p>Description of item_product 2</p>
      <p>$25.00</p>
      <button><a href="bidui.php">Bid item</a></button>
    </div>
    <div class="item_product">
      <img src="pfp.png" alt="item_product 3">
      <h3>item_product 3</h3>
      <p>Description of item_product 3</p>
      <p>$30.00</p>
      <button><a href="bidui.php">Bid item</a></button>
    </div>
    
    
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
