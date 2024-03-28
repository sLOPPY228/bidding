<link rel="stylesheet" href="../css/nav.css">
<?php session_start(); ?>
<nav>
    <div class="logo">
        Galler-E 
    </div>
    <div class="menu">
        <ul>
            <li><a href="3homepage.php">Home</a></li>
            <li><a href="4product.php">Products</a></li>
            <?php
            // session_start();
            if(isset($_SESSION['userid'])) {
                echo '<li><a href="logout.php">Logout</a></li>';
            } else {
                echo '<li><a href="2signin.php">Login</a></li>';
            }
            ?>
            <!-- <li><a href="#"><img src="../pic/pfp.png"></a></li> -->
            <li><p><?= $_SESSION['username'];?></p></li>
        </ul>
    </div>
</nav>