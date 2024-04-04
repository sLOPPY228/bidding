<?php
// Check if the email already exists
global $conn;

$id = $_GET["product_id"];
$sql = "SELECT login_data.username, MAX(bids.bid_amount) AS highest_bid 
        FROM login_data 
        JOIN bids ON login_data.user_id = bids.user_id 
        WHERE bids.product_id = $id
        GROUP BY login_data.username 
        ORDER BY highest_bid DESC 
        LIMIT 3";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Top 3 Bidders:</h2>";
    echo "<ol>";
    while($row = $result->fetch_assoc()) {
        echo "<li>" . $row["username"] . " - Rs." . $row["highest_bid"] . "</li>";
    }
    echo "</ol>";
} else {
    echo "No bidders found.";
}

$conn->close();
?>
