<link rel="stylesheet" href="../css/0nav.css">


<!-- usernavstart -->
<nav>
    <div class="logo">
        Galler-E 
    </div>
    <div class="menu">
        <ul>
            <li><a href="3homepage.php">Home</a></li>
            <li><a href="4product.php">Products</a></li>
            <li><a href="8yourbids.php">Your bids</a></li>

            <?php
            
            if(isset($_SESSION['userid'])) {
                echo '<li><a href="logout.php">Logout</a></li>';
            } else {
        header("location: 2signin.php");      
            }
            ?>
            <!-- <li><a href="#"><img src="../pic/pfp.png"></a></li> -->
            <li><p><?= $_SESSION['username'];?></p></li>
            
        </ul>
    </div>
</nav>
<!-- usernavend -->
<?php
require_once "norightclick.php";
?>

