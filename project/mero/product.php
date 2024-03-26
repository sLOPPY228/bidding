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
                  <li><a href="#">Home</a></li>
                  <li><a href="#">Categories</a></li>
                  <li><a href="#">Products</a></li>
                  <li><a href="product.php">Products</a></li>
                  <li><a href="#"><img src="pfp.png"></a></li>
                  
              </ul>
          </div>
        </nav>
        <table>
         <div class="content">
             <label for="">Your products</label>
                <button><a href="create.html">New post</a></button>
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
             <?php 
								$i = 1;
								$cat = array();
								$cat[] = '';
								$qry = $conn->query("SELECT * FROM categories ");
								while($row = $qry->fetch_assoc()){
									$cat[$row['id']] = $row['name'];
								}
								$products = $conn->query("SELECT * FROM products order by name asc ");
								while($row=$products->fetch_assoc()):
									$get = $conn->query("SELECT * FROM bids where product_id = {$row['id']} order by bid_amount desc limit 1 ");
									$bid = $get->num_rows > 0 ? $get->fetch_array()['bid_amount'] : 0 ;
									$tbid = $conn->query("SELECT distinct(user_id) FROM bids where product_id = {$row['id']} ")->num_rows;
								?>
								<tr data-id= '<?php echo $row['id'] ?>'>
									<td class=""><?php echo $i++ ?></td>
									<td class="">
										 <div class="">
										 	<img src="<?php echo 'assets/uploads/'.$row['img_fname'] ?>" alt="">
										 </div>
									</td>
									<td>
										 <p> <b><?php echo ucwords($cat[$row['category_id']]) ?></b></p>
									</td>
									<td class="">
										 <p>Name: <b><?php echo ucwords($row['name']) ?></b></p>
										 <p><small>Description: <b><?php echo $row['description'] ?></b></small></p>
									</td>
									<td>
										 <p><small>Regular Price: <b><?php echo number_format($row['regular_price'],2) ?></b></small></p>
										 <p><small>Start Price: <b><?php echo number_format($row['start_bid'],2) ?></b></small></p>
										 <p><small>End Date/Time: <b><?php echo date("M d,Y h:i A",strtotime($row['bid_end_datetime'])) ?></b></small></p>
										 <p><small>Highest Bid: <b class="highest_bid"><?php echo number_format($bid,2) ?></b></small></p>
										 <p><small>Total Bids: <b class="total_bid"><?php echo $tbid ?> user/s</b></small></p>
									</td>
									<td class="text-center">
										<button class="btn" type="button" data-id="<?php echo $row['id'] ?>" >Edit</button>
										<button class="btn" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
             </tbody>
         </div>
                                    
        </table>
    </body>
    <style>
        
    </style>
</html>
