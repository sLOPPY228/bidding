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

require_once 'watermark_util.php';
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
