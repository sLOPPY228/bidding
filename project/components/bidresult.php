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
    echo "<div class='bid-result'>";
    while($row = $result->fetch_assoc()) {
        if ($_SESSION["username"] == $row["username"]) {
            ?>
            <div class="success-message">
                <h3>Congratulations!</h3>
                <p>You have won the bid</p>
                <button class="pay-button" 
                        onclick="proceedToPayment('<?php echo urlencode($r['bid_amount']); ?>', '<?php echo $r['product_id']; ?>')">
                    Proceed to Payment
                </button>
            </div>
            <?php  
        } else {
            ?>
            <div class="error-message">
                <h3>Better luck next time!</h3>
                <p>Sorry, you didn't win this bid.</p>
            </div>
            <?php
        }
    }
    echo "</div>";
} 


?>

<style>
.bid-result {
    margin: 20px 0;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
}
</style>

<script>
function proceedToPayment(bidAmount, productId) {
    // Add loading state to button
    const button = event.target;
    const originalText = button.textContent;
    button.disabled = true;
    button.innerHTML = '<span class="loading-text">Processing...</span>';
    
    // Add a small delay to show the loading state
    setTimeout(() => {
        window.location.href = `9.1payment.php?bid_amount=${bidAmount}&product_id=${productId}`;
    }, 500);
}
</script>
