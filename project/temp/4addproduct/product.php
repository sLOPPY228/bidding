

<?php
include 'db_connect.php';

// Check if the email already exists
$query = "SELECT * FROM products";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="product.css" />
  </head>
  <body>
    <nav>
      <div class="logo">
        Galler-E
      </div>
      <div class="menu">
        <ul>
          <li><a href="../3homepage/homepage.php">Home</a></li>
          <li><a href="#">Categories</a></li>
          <li><a href="product.php">Products</a></li>
          <li>
            <a href="#"><img src="../pic/pfp.png" /></a>
          </li>
        </ul>
      </div>
    </nav>
    <table>
      <div class="content">
        <label for="">Your products</label>
        <button><a href="create.php">New post</a></button>
      </div>
      <div class="content">
          <tr>
           
            <th>Product Name</th>
            <th>Category</th>
            <th>Product Description</th>
            <th>Start Date</th>
            <th>Regular Price</th>
            <th>End Date</th>
            <th>Product Image</th>
            <th>Action</th>
          </tr>
          <?php foreach($result as $r){ ?>
        <tr>
          
         <td><?php echo $r['name']; ?></td>
         <td><?php echo $r['category']; ?></td>
         <td><?php echo $r['description']; ?></td>
         <td><?php echo $r['start_bid']; ?></td>
         <td><?php echo $r['regular_price']; ?></td>
         <td><?php echo $r['Bid_end']; ?></td>
         <td class="imgCell">
        <?php if($r['P_image'] != null) ?>
        <img src="../pic/<?php echo $r['P_image']; ?>" alt="Image">
        </td>
         <td>
          <button class="editBtn">Edit</button>
         <button class="deleteBtn">Delete</button>
        </td>
         
  </tr>
  <?php } ?>
        
      </div>
    </table>
  </body>
  <style></style>
</html>