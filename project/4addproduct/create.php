<!-- <?php
    require 'db_connect.php';
    if (isset($_POST["save"])) {
        // echo"<pre>";
        // print_r($_POST);
        // die();
        $name = $_POST['product-name'];
        $category_id = $_POST['category'];
        $description = $_POST['description'];
        $regular_price = $_POST['price'];
        $start_bid = $_POST['bid1'];
        $bid_end_datetime = $_POST['date'];


        if($_FILES["image"]["error"] === 4){
            echo
            "<script> alert('Image Does Not Exist'); </script>"
            ;
        } else {
            $filename =$_FILES["image"]["name"];
            $fileSize = $_FILES["image"]["size"];
            $tempName = $_FILES["image"]['temp_name'];

            $validImageExtention = ['jpg','jpeg','png'];
            $imageExtention = explode('.',$fileName);
            $imageExtention = strtolower(end($imageExtention));
            if(!in_array($imageExtention,$validImageExtention)){
                echo
                    "<script> alert('Invalid Image Extention'); </script>"
                ;
            }else if($fileSize>1000000){
                echo
                "<script> alert('Image Size is too large'); </script>"
                ;
            }else{
                $newImageName = uniqid();
                $newImageName .= '.' . $imageExtension;

                move_uploaded_file($tmpName, 'img/' . $newImageName);


                $query = "INSERT INTO products VALUES('', '$name','$category_id','$description','$regular_price','$start_bid','$bid_end_datetime','$newImageName')";
                mysqli_query($conn, $query);
                echo
                    "<script> 
                        alert('Successfully Added');
                        document.location.href = 'product.php';
                    </script>
                    ";
            }
        }

    }
?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="create.css">
</head>
<body>
   <nav>
    <div class="logo">
        Galler-E 
     </div>
     <div class="menu">
         <ul>
             <li><a href="../3homepage/homepage.php">Home</a></li>
             <li><a href="#">Categories</a></li>
             <li><a href="product.php">Products</a></li>
             <li><a href="#"><img src="../pic/pfp.png"></a></li>
         </ul>
     </div>
   </nav>
   <!-- nav end -->


   <form action="filesendlogic.php " method="post" class="product">
        <div class="product-data">
            <label>Product Name</label>
            <input type="text" name="product-name">
        </div>

        <!-- <div class="product-data">
            <label>Category</label>
            <select name="" id="" value="category" name="category">
                <option value="Painting">Painting</option>
                <option value="Fine Art">Fine Art</option>
                <option value="Pixel Art">Pixel Art</option>
                <option value="Sculpture">Sculpture</option>
            </select>
        </div> -->

        <div class="product-data">
            <label for="Description" >Description</label>
            <input type="text" value="description" name="description" id="Description_box" style="height: 150px;">
        </div>

        <div class="product-data">
            <label for="Regular Price">Regular Price</label>
            <input type="number" value="price" name="price">
        </div>

        <div class="product-data">
            <label for="Starting bid">Starting bid</label>
            <input type="number" value="bid1" name="bid1">
        </div>

        <!-- <div class="product-data">
            <label for="Bidding End Date/Time">Bidding End Date/Time</label>
            <input type="datetime-local" value="date"  name="date" id="">
        </div>

        <div class="product-data">
            <label for="Product Image">Product Image</label>
            <input type="file" name="image" accept=".jpg, .jpeg, .png" ><br>
        </div> -->

        <div class="product-data">
            <button type="submit" name="save">Save</button>
        </div>
   </form>
<!-- form end -->

</body>
</html>