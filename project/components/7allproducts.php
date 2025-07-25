<?php
include 'db_connect.php';
// Check if the email already exists
$query = "SELECT * FROM products
WHERE product_status = 'ACTIVE'";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>All Products</title>
    <link rel="stylesheet" href="../css/4product.css" />
    <style>
      .feedback-message {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px;
        border-radius: 4px;
        display: none;
        z-index: 1000;
        animation: slideIn 0.3s ease-out;
      }
      
      @keyframes slideIn {
        from {
          transform: translateX(100%);
          opacity: 0;
        }
        to {
          transform: translateX(0);
          opacity: 1;
        }
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

      .deleteBtn {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
      }

      .deleteBtn:hover {
        background-color: #c82333;
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
    
   <!-- Feedback message container -->
   <div id="feedbackMessage" class="feedback-message"></div>

   <div class="content">
     <h1>ALL PRODUCTS</h1>
   </div>
   <table>
      <div class="content">
          <tr>
            <th>Product Name</th>
            <th>Category</th>
            <th>Product Description</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Product Image</th>
            <th>Action</th>
          </tr>
          <?php foreach($result as $r){ ?>
        <tr id="product-row-<?php echo $r['product_id']; ?>">
         <td><?php echo $r['product_name']; ?></td>
         <td><?php echo $r['category']; ?></td>
         <td><?php echo $r['description']; ?></td>
         <td><?php echo $r['start_bid']; ?></td>
         <td><?php echo $r['Bid_end']; ?></td>
         <td class="imgCell">
        <?php if($r['P_image'] != null) ?>
        <img src="../<?php echo $r['P_image']; ?>" alt="Image">
        </td>
         <td>
         <button class="deleteBtn" onclick="deleteProduct(<?php echo $r['product_id']; ?>)">Delete</button>
        </td>
  </tr>
  <?php } ?>
      </div>
    </table>
  </body>
  <script>
    function deleteProduct(productId) {
      if (confirm("Are you sure you want to delete this product?")) {
        const formData = new FormData();
        formData.append('product_id', productId);
        
        fetch('filedeletelogic.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          const feedbackDiv = document.getElementById('feedbackMessage');
          feedbackDiv.textContent = data.message;
          feedbackDiv.className = 'feedback-message ' + (data.status === 'success' ? 'success' : 'error');
          feedbackDiv.style.display = 'block';
          
          if (data.status === 'success') {
            // Remove the product row from the table
            const productRow = document.getElementById('product-row-' + productId);
            if (productRow) {
              productRow.style.animation = 'fadeOut 0.3s ease-out';
              setTimeout(() => {
                productRow.remove();
              }, 300);
            }
            
            // Hide the feedback message after 3 seconds
            setTimeout(() => {
              feedbackDiv.style.animation = 'slideOut 0.3s ease-out';
              setTimeout(() => {
                feedbackDiv.style.display = 'none';
                feedbackDiv.style.animation = '';
              }, 300);
            }, 3000);
          }
        })
        .catch(error => {
          const feedbackDiv = document.getElementById('feedbackMessage');
          feedbackDiv.textContent = 'An error occurred while deleting the product.';
          feedbackDiv.className = 'feedback-message error';
          feedbackDiv.style.display = 'block';
        });
      }
    }

    function disableRightClick() {
      return false;
    }
  </script>

  <style>
    @keyframes fadeOut {
      from {
        opacity: 1;
        transform: translateX(0);
      }
      to {
        opacity: 0;
        transform: translateX(-20px);
      }
    }

    @keyframes slideOut {
      from {
        transform: translateX(0);
        opacity: 1;
      }
      to {
        transform: translateX(100%);
        opacity: 0;
      }
    }
  </style>
</html>