  <?php
  include 'db_connect.php';

  // Query active products
  $query = "SELECT * FROM products WHERE product_status = 'ACTIVE'";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $result = $stmt->get_result();

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

  <?php 
  require_once $_SESSION["usertype"] == 0 ? "../components/0nav.php" : "../components/0adminnav.php";
  ?>

  <div class="container_product">
    <?php foreach ($result as $r): ?>
      <div class="item_product">
        <?php
          if (!empty($r['P_image'])):
            $sourcePath = "../" . $r['P_image'];
            $watermarkedImage = applyTextWatermark($sourcePath, "Galler-E");

            if ($watermarkedImage):
        ?>
          <img src="<?php echo $watermarkedImage; ?>" alt="<?php echo htmlspecialchars($r['product_name']); ?>">
        <?php
            else:
              echo "<p><i>Image not found or watermark failed.</i></p>";
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
  // Function to apply centered text watermark
  function applyTextWatermark($imagePath, $text = "Galler-E") {
      if (!file_exists($imagePath)) return false;

      // Detect type
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

      // Font settings
      $fontPath = __DIR__ . '/../fonts/arial.ttf';
      if (!file_exists($fontPath)) return false;

      $fontSize = 20;
      $angle = 0;

      // Image dimensions
      $imageWidth = imagesx($image);
      $imageHeight = imagesy($image);

      // Text box calculation
      $bbox = imagettfbbox($fontSize, $angle, $fontPath, $text);
      $textWidth = $bbox[2] - $bbox[0];
      $textHeight = $bbox[1] - $bbox[7];

      $x = ($imageWidth - $textWidth) / 2;
      $y = ($imageHeight + $textHeight) / 2;

      // Alpha white color
      $textColor = imagecolorallocatealpha($image, 255, 255, 255, 80); // 80 is semi-transparent

      // Apply
      imagealphablending($image, true);
      imagesavealpha($image, true);
      imagettftext($image, $fontSize, $angle, $x, $y, $textColor, $fontPath, $text);

      // Save watermarked image
      $outputPath = '../temp/' . uniqid() . '.png';
      imagepng($image, $outputPath);
      imagedestroy($image);
      return $outputPath;
  }
  ?>
