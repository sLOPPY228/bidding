<?php
// Include the database connection
include 'db_connect.php';
require_once 'watermark_util.php';
// Query to fetch active products
$query = "SELECT * FROM products WHERE product_status = 'ACTIVE'";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

// Get the user type from session
$usertype = $_SESSION["usertype"];

// Get current date and time
date_default_timezone_set('Asia/Kathmandu');
$currentDateTime = date('Y-m-d H:i:s');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/3homepage.css" />
  <title>Galler-E</title>
  <style>
    .bid-status {
      padding: 8px 16px;
      border-radius: 4px;
      font-weight: 500;
      text-align: center;
      margin: 10px 0;
    }

    .bid-ended {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }

    .bid-active {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }

    .date-display {
      font-size: 0.9em;
      color: #666;
      margin: 5px 0;
    }
  </style>
  <script>
    function disableRightClick() {
      return false;
    }

    function goToBid(productId) {
      window.location.href = '6bidui.php?product_id=' + encodeURIComponent(productId);
    }
  </script>
</head>

<body oncontextmenu="return disableRightClick();">

<!-- Navigation Bar -->
<?php 
if ($_SESSION["usertype"] == 0) {
    require_once "../components/0nav.php";
} else {
    require_once "../components/0adminnav.php";
}
?>

<!-- Product Container -->
<div class="container_product">
  <?php foreach ($result as $r): 
    // Compare full datetime
    $isBidEnded = strtotime($currentDateTime) > strtotime($r['Bid_end']);
  ?>
    <div class="item_product">
      <?php
        // Check if the product has an image
        if (!empty($r['P_image'])):
          $sourcePath = "../" . $r['P_image'];
          $watermarkPath = "../image/watermark.png";
          $watermarkedImage = applyWatermark($sourcePath, $watermarkPath);
          if ($watermarkedImage):
      ?>
            <img src="<?php echo $watermarkedImage; ?>" alt="Product Image">
      <?php
          else:
            echo "<p><i>No Image Available</i></p>";
          endif;
        else:
          echo "<p><i>No Image Available</i></p>";
        endif;
      ?>

      <h3><?php echo htmlspecialchars($r['product_name']); ?></h3>
      
      <!-- Bid Status -->
      <div class="bid-status <?php echo $isBidEnded ? 'bid-ended' : 'bid-active'; ?>">
        <?php if ($isBidEnded): ?>
          Bidding Ended
        <?php else: ?>
          Bidding Active
        <?php endif; ?>
      </div>
      
      <!-- Date Display -->
      <div class="date-display">
        Bid End Date: <?php echo date('Y-m-d', strtotime($r['Bid_end'])); ?><br>
        Bid End Time: <?php echo date('H:i', strtotime($r['Bid_end'])); ?>
        <?php if (!$isBidEnded): ?>
          <br>
          <?php
            $now = new DateTime($currentDateTime);
            $end = new DateTime($r['Bid_end']);
            $interval = $now->diff($end);
            echo 'Time Left: ';
            if ($interval->d > 0) echo $interval->d . 'd ';
            if ($interval->h > 0) echo $interval->h . 'h ';
            if ($interval->i > 0) echo $interval->i . 'm ';
            if ($interval->s > 0 && $interval->d == 0 && $interval->h == 0 && $interval->i == 0) echo $interval->s . 's';
          ?>
        <?php endif; ?>
      </div>
      
      <p>Starting Bid: <?php echo htmlspecialchars($r['start_bid']); ?></p>

      <?php if ($usertype == 0 && !$isBidEnded): ?>
        <button onclick="goToBid('<?php echo $r['product_id']; ?>')">
          Bid Item
        </button>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>

  
</div>

</body>
</html>

