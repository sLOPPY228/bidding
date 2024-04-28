<?php
include 'db_connect.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment Page</title>
<style>
    body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  
}

.container {
  max-width: 500px;
  margin: 50px auto;
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
  margin-bottom: 20px;
}

form {
  display: flex;
  flex-direction: column;
}

label {
  margin-bottom: 5px;
}

input[type="text"],
button {
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  
}

button {
  background-color: #007bff;
  color: #fff;
  border: none;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}

</style>
</head>
<!-- navigation bar begin -->
<?php 
if ($_SESSION["usertype"]==0) {
  require_once "../components/0nav.php";
}else {
  require_once "../components/0adminnav.php";
}

?>
<body>
   <!-- navigation bar ends -->
  <div class="container">
    <h1>Payment Details</h1>
    <form action="payment_process.php" method="post">
      <label for="card_number">Card Number:</label>
      <input type="text" id="card_number" name="card_number" placeholder="Enter your card number" required>
      
      <label for="exp_date">Expiration Date:</label>
      <input type="text" id="exp_date" name="exp_date" placeholder="MM/YYYY" required>
      
      <label for="cvv">CVV:</label>
      <input type="text" id="cvv" name="cvv" placeholder="CVV" required>
      
      <label for="name">Name on Card:</label>
      <input type="text" id="name" name="name" placeholder="Enter your name" required>
      
      <button type="submit">Pay Now</button>
    </form>
  </div>
</body>
</html>
