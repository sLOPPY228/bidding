<form  id="bid-form" action="biddatasend.php" method="post">
        <input type="hidden" name="product_id" value= "<?php echo $r["product_id"]; ?>">
        <label for="bid-amount">Enter your bid:</label>
        <input type="number" id="bid-amount" name="bid-amount" min="<?php echo $r['start_bid']; ?>" required>
        <button type="submit" >Place Bid</button>
      </form>