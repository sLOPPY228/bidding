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
    <title>Document</title>
</head>
<style>
    .product_container {
  display: flex;
  background-color: bisque;
}

.container_image, .container_description {
  flex: 1; /* This makes both child divs take up equal space */
  padding: 10px;
  border: 1px solid #ccc;
}

.container_image {
  margin-right: 10px; /* Add some space between the child divs */
}

</style>
<body>
<?php foreach($result as $r){ ?>
    <div class="product_container">
        <div class="container_image" style="background-color: blue;">
        <?php if($r['P_image'] != null) ?>
        <img src="../pic/<?php echo $r['P_image']; ?>" alt="Image">
      </div>

        <div class="container_description" style="background-color: aqua;">
        <h1>user name</h1>
      <h3><?php echo $r['description']; ?></h3>
      <p>Minimum Bid Amount:<?php echo $r['start_bid']; ?></span></p>
      <form id="bid-form">
        <label for="bid-amount">Enter your bid:</label>
        <input type="number" id="bid-amount" name="bid-amount" min="<?php echo $r['start_bid']; ?>" required>
        <button type="submit">Place Bid</button>
      </form>
      </div>
      </div>
    <?php } ?>
      
</body>
</html>