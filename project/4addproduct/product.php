<?php include('db_connect.php');?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../3homepage/homepage.css">
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
        <table>
         <div class="content">
             <label for="">Your products</label>
                <button><a href="create.php">New post</a></button>
         </div>
         <div class="content">
             <thead>
                 <tr>
                     <th>S.N.</th>
                     <td></td>
                     <th>Image</th>
                     <td></td>
                     <th>Category</th>
                     <td></td>
                     <th>Product Info</th>
                     <td></td>
                     <th>Action</th>
                     <td></td>
                 </tr>
             </thead>
             <tbody>
             
             </tbody>
         </div>
                                    
        </table>
    </body>
    <style>
        
    </style>
</html>
