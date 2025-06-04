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

// Get current date
$currentDate = date('Y-m-d');
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
    // Compare only dates

    $isBidEnded = strtotime($currentDate) > strtotime(date('Y-m-d', strtotime($r['Bid_end'])));
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
        Bid End Date: <?php echo date('Y-m-d', strtotime($r['Bid_end'])); ?>
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

    // Create a new true color image with same dimensions
    $width = imagesx($image);
    $height = imagesy($image);
    $newImage = imagecreatetruecolor($width, $height);

    // Set alpha blending and saving for the new image
    imagealphablending($newImage, false);
    imagesavealpha($newImage, true);

    // Fill new image with transparent background
    $transparent = imagecolorallocatealpha($newImage, 0, 0, 0, 127);
    imagefilledrectangle($newImage, 0, 0, $width, $height, $transparent);

    // Copy original image to new image
    imagecopy($newImage, $image, 0, 0, 0, 0, $width, $height);

    // Load the watermark image (PNG with transparency support)
    $watermark = imagecreatefrompng($watermarkPath);
    
    // Enable alpha blending on the watermark
    imagealphablending($watermark, true);
    
    // Get the size of the watermark and container
    $watermarkWidth = imagesx($watermark);
    $watermarkHeight = imagesy($watermark);
    $containerWidth = $width;
    $containerHeight = $height;
    
    // Calculate new watermark size (half of container)
    $newWatermarkWidth = round($containerWidth / 2);
    $newWatermarkHeight = round(($watermarkHeight * $newWatermarkWidth) / $watermarkWidth); // maintain aspect ratio
    
    // Create a temporary image for the resized watermark
    $tempWatermark = imagecreatetruecolor($newWatermarkWidth, $newWatermarkHeight);
    imagealphablending($tempWatermark, false);
    imagesavealpha($tempWatermark, true);
    
    // Resize watermark
    imagecopyresampled($tempWatermark, $watermark, 0, 0, 0, 0, $newWatermarkWidth, $newWatermarkHeight, $watermarkWidth, $watermarkHeight);
    
    // Calculate the position (center)
    $xPosition = ($width - $newWatermarkWidth) / 2; // horizontally centered
    $yPosition = ($height - $newWatermarkHeight) / 2; // vertically centered

    // Apply the watermark with alpha blending
    imagealphablending($newImage, true);
    imagecopymerge($newImage, $tempWatermark, $xPosition, $yPosition, 0, 0, $newWatermarkWidth, $newWatermarkHeight, 30);

    // Clean up the temporary watermark
    imagedestroy($tempWatermark);

    // Save the watermarked image to a temporary file
    $outputPath = '../temp/' . uniqid() . '.png';
    
    // Set alpha blending off and save alpha on for output
    imagealphablending($newImage, false);
    imagesavealpha($newImage, true);
    
    // Save as PNG to preserve transparency
    imagepng($newImage, $outputPath);
    
    // Clean up
    imagedestroy($image);
    imagedestroy($watermark);
    imagedestroy($newImage);
    
    return $outputPath;
}
?>

