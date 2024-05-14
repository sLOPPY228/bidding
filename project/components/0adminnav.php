<link rel="stylesheet" href="../css/0nav.css">

<nav>
    <div class="logo">
        Galler-E 
    </div>
    <div class="menu">
        <ul>
            <li><a href="3homepage.php">Home</a></li>
            <li><a href="12allusers.php">Users</a></li>
            <!-- <li><a href="4product.php">Products</a></li> -->
            <li><a href="7allproducts.php">Products Details</a></li>
            <li><a href="10biddetails.php">Bid Details</a></li>
            <!-- <li><a href="8yourbids.php">Your bids</a></li> -->

            <li><p><?= $_SESSION['username'];?></p>
            <div class="hover-content">
            <a href="13userprofile.php"> Edit profile</a> <br>
            <a href="16seecomplain.php"> User Issues</a>

         </div>
        </li>
            <?php
            
            if(isset($_SESSION['userid'])) {
                echo '<li><a href="0logout.php">Logout</a></li>';
            } else {
        header("location: 2signin.php");      
            }
            ?>
        </ul>
        </ul>
    </div>
</nav>

<?php
require_once "norightclick.php";
?>