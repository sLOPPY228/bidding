<?php
// Check if the email already exists


$id = $r["product_id"];
$sql = "SELECT login_data.username, MAX(bids.bid_amount) AS highest_bid 
        FROM login_data 
        JOIN bids ON login_data.user_id = bids.user_id 
        WHERE bids.product_id = $id
        GROUP BY login_data.username 
        ORDER BY highest_bid DESC 
        LIMIT 1";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // echo "<h3>Highest Bidder</h3>";
    echo "<ol>";
    while($row = $result->fetch_assoc()) {
        // echo  $row["username"] . " - Rs." . $row["highest_bid"] ;
        if ($_SESSION["username"] == $row["username"]) {
            ?>
                <br>Congratulations,you have won the bid<br>Proceed to payment <br>
                
         <button ><a href="9payment.php?bid_amount=<?php echo urlencode($r["bid_amount"]);?>&product_id= <?php echo $r['product_id']?>">Pay</a></button>
            <?php  
            
        } else {
            ?>
            <h3>Sorry, you didn't win this bid.</h3>
            <?php
        }
    }
    echo "</ol>";
} 


?>
