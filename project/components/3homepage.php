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
    imagecopymerge($newImage, $tempWatermark, $xPosition, $yPosition, 0, 0, $newWatermarkWidth, $newWatermarkHeight, 50);

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

