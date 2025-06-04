<?php
include 'db_connect.php';
if (!isset($_GET["product_id"])) {
  echo "no id found";
die();
}
$id = $_GET["product_id"];
// Check if the email already exists
$query = "SELECT * FROM products where product_id=$id";
$result = $conn->query($query);
$r = $result;


// // Prepare SQL query
// $sql = "SELECT user_id FROM product WHERE product_id = $id";

// // Execute query
// $result = $conn->query($sql);

// // Check if any rows were returned
// if ($result->num_rows > 0) {
//   // Fetch the data from the result set
//   $row = $result->fetch_assoc();
//   $user_id = $row["user_id"];
//   echo "Username: " . $username;
// } else {
//   echo "No results found.";
// }


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bidding Page</title>
  <link rel="stylesheet" href="../css/6bidui.css">
  <style>
    .feedback-message {
      padding: 15px;
      margin: 10px 0;
      border-radius: 4px;
      display: none;
    }
    
    .success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }
    
    .error {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }
  </style>
</head>
<body oncontextmenu="return disableRightClick();">

<!-- navigation bar begin -->
<?php 
if ($_SESSION["usertype"]==0) {
    require_once "../components/0nav.php";
}else {
    require_once "../components/0adminnav.php";
}

?>
   <!-- navigation bar ends -->


 <!-- for bidding start --> 
<div class="product_container">
  <?php foreach($result as $r){ ?>

  <div class="container_image">

    <?php 
    if($r['P_image'] != null) {
        // Construct the source path of the original image
        $sourcePath = "../" . $r['P_image'];
        
        // Define the path for the watermark image
        $watermarkPath = "../image/watermark.png";
        
        // Apply watermark on the image and get the output path
        $watermarkedImage = applyWatermark($sourcePath, $watermarkPath);

        // Display the watermarked image
        if ($watermarkedImage) {
            echo '<img src="' . $watermarkedImage . '" alt="Image">';
        } else {
            echo '<img src="../' . $r['P_image'] . '" alt="Image">';
        }
    }
    ?>
  </div>
  
      <div class="container_description" style="border: 2 2 2 2;">
      <h1>User name:<?php echo $r['username']; ?></h1>
      <h3><?php echo $r['description']; ?></h3>
      <p>Minimum Bid Amount:<?php echo $r['start_bid']; ?></span></p>
      <p>BID ENDS IN:<?php echo $r['Bid_end']; ?></p>
      <h3><p><?php require_once "highestbid.php"  ?></span></p></h3>
      
       <!-- Feedback message container -->
       <div id="feedbackMessage" class="feedback-message"></div>
       
       <?php
       $usertype = $_SESSION["usertype"];
       $currentdate=date("Y-m-d");
      //  echo $currentdate;
      //  echo $r['user_id'];
       $currentuser=$r['user_id']; 
      //  echo $currentuser;
      //  echo "and";
      //  echo $_SESSION["userid"];
      if ($usertype == 0) {
        
      if ($currentdate <= $r['Bid_end']) {
        if ($currentuser != $_SESSION["userid"]) {
          ?>
          <form id="bid-form" onsubmit="submitBid(event)">
            <input type="hidden" name="product_id" value="<?php echo $r["product_id"]; ?>">
            <label for="bid-amount">Enter your bid:</label>
            <input type="number" id="bid-amount" name="bid-amount" min="<?php echo $r['start_bid']; ?>" required>
            <button type="submit">Place Bid</button>
          </form>
          <?php
         }else {
          echo "<br>";
          echo "<h1>You cannot bid on your own product!</h1>";
         }
      }else{
        echo "<br>";
          echo "<h1>Bidding time has ended!</h1>";
      }
       
       ?>
    </div>
    <?php }
      }
     ?>

</div>
<!-- for bidding end -->
  
<script>
function submitBid(event) {
  event.preventDefault();
  
  const form = event.target;
  const formData = new FormData(form);
  const feedbackDiv = document.getElementById('feedbackMessage');
  
  fetch('biddatasend.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    feedbackDiv.textContent = data.message;
    feedbackDiv.className = 'feedback-message ' + (data.status === 'success' ? 'success' : 'error');
    feedbackDiv.style.display = 'block';
    
    if (data.status === 'success') {
      // Clear the form
      form.reset();
      // Optionally reload the highest bid display after a successful bid
      setTimeout(() => {
        location.reload();
      }, 2000);
    }
  })
  .catch(error => {
    feedbackDiv.textContent = 'An error occurred while processing your bid.';
    feedbackDiv.className = 'feedback-message error';
    feedbackDiv.style.display = 'block';
  });
}

function disableRightClick() {
  return false;
}
</script>

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
    
    // Calculate the position (middle-right)
    $xPosition = $width - $newWatermarkWidth - 20; // 20px padding from right
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
