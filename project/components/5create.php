<?php
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/5create.css">
</head>

<body oncontextmenu=" return disableRightClick();">
<!-- navigation bar begin -->
<?php 
if ($_SESSION["usertype"]==0) {
    require_once "../components/0nav.php";
}else {
    require_once "../components/0adminnav.php";
}

?>
   <!-- navigation bar ends -->


   <form action="filesendlogic.php " method="post" class="product" enctype="multipart/form-data">
        <div class="product-data">
            <label>Product Name</label>
            <input type="text" name="product-name" required>
        </div>

        <div class="product-data">
            <label>Category</label>
            <select  name="category">
                <option value="Painting">Painting</option>
                <option value="Fine Art">Fine Art</option>
                <option value="Pixel Art">Pixel Art</option>
                <option value="Sculpture">Sculpture</option>
            </select>
        </div>

        <div class="product-data">
            <label for="Description" >Description</label>
            <input type="text" value="description" name="description" id="Description_box" style="height: 150px;">
        </div>

        <div class="product-data">
            <label for="Starting bid">Starting bid</label>
            <input type="number" value="bid1" name="bid1" required>
        </div>
        
        <div class="product-data">
            <label for="Bidding End Date/Time">Bidding End Date/Time</label>
            <input type="datetime-local" id="date" required name="end_date" min="" />
        </div>

        <div class="product-data">
            <label for="Product Image">Product Image</label>
            <input type="file"  name="image" accept=".jpg, .jpeg, .png" required><br>
        </div>

        <div class="product-data">
            <button type="submit" name="Add" >Add Product</button>
        </div>
   </form>
<!-- form end -->



<!-- no old date -->
<script>
    // Get today's date and time
    var now = new Date();
    // Set it to tomorrow, same time
    var tomorrow = new Date(now);
    tomorrow.setDate(now.getDate() + 1);
    // Format as YYYY-MM-DDTHH:MM for datetime-local
    var pad = n => n < 10 ? '0' + n : n;
    var tomorrowFormatted = tomorrow.getFullYear() + '-' + pad(tomorrow.getMonth() + 1) + '-' + pad(tomorrow.getDate()) + 'T' + pad(tomorrow.getHours()) + ':' + pad(tomorrow.getMinutes());
    document.getElementById("date").setAttribute("min", tomorrowFormatted);
</script>
<!-- no old date -->
</body>
</html>