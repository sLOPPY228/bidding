<?php
// Include the database connection
include 'db_connect.php';

// Query to fetch active products
$query = "SELECT * FROM products WHERE product_status = 'ACTIVE'";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

// Get the user type from session
$usertype = $_SESSION["usertype"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/3homepage.css" />
  <title>Galler-E</title>
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
  <?php foreach ($result as $r): ?>
    <div class="item_product">
      <?php
        // Check if the product has an image
        if (!empty($r['P_image'])):
          // Construct the source path of the original image
          $sourcePath = "../" . $r['P_image'];
          
          // Define the path for the watermark image
          $watermarkPath = "../image/watermark.png";
          
          // Apply watermark on the image and get the output path
          $watermarkedImage = applyWatermark($sourcePath, $watermarkPath);

          // Display the watermarked image
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
      <p>BID END IN:<br><?php echo htmlspecialchars($r['Bid_end']); ?></p>
      <p>Starting Bid: <?php echo htmlspecialchars($r['start_bid']); ?></p>

      <?php if ($usertype == 0): ?>
        <button onclick="goToBid('<?php echo $r['product_id']; ?>')">Bid Item</button>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
</div>

</body>
</html>

<?php
// Function to apply watermark to the image with alpha blending
function applyWatermark($imagePath, $watermarkPath) {
    // Check if the image and watermark exist
    if (!file_exists($imagePath) || !file_exists($watermarkPath)) {
        return false;
    }

    // Get the image type
    $imageType = exif_imagetype($imagePath);
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $image = imagecreatefromjpeg($imagePath);
            break;
        case IMAGETYPE_PNG:
            $image = imagecreatefrompng($imagePath);
            break;
        case IMAGETYPE_GIF:
            $image = imagecreatefromgif($imagePath);
            break;
        default:
            return false;
    }

    // Load the watermark image (PNG with transparency support)
    $watermark = imagecreatefrompng($watermarkPath);
    
    // Get the size of the original image and watermark
    $imageWidth = imagesx($image);
    $imageHeight = imagesy($image);
    $watermarkWidth = imagesx($watermark);
    $watermarkHeight = imagesy($watermark);
    
// Calculate the position of the watermark (centered)
$xPosition = ($imageWidth - $watermarkWidth) / 2;
$yPosition = ($imageHeight - $watermarkHeight) / 2;


    // Apply alpha blending for watermark (the fourth argument defines opacity)
    imagealphablending($image, true);
    imagecopymerge($image, $watermark, $xPosition, $yPosition, 0, 0, $watermarkWidth, $watermarkHeight, 20); // 50% opacity

    // Save the watermarked image to a temporary file
    $outputPath = '../temp/' . uniqid() . '.png';  // Save as PNG for transparency
    imagepng($image, $outputPath);
    
    // Clean up
    imagedestroy($image);
    imagedestroy($watermark);
    
    return $outputPath;
}
?>
