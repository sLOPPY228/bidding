<?php 
include 'db_connect.php';

if ($_SESSION["usertype"]==0) {
    require_once "../components/0nav.php";
}else {
    require_once "../components/0adminnav.php";
}
$Username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Complaint Form</title>
<link rel="stylesheet" href="../css/9payment.css">
</head>
<body>
    <div class="container">
        <h2>Complaint Form</h2>
        <form action="sendcomplain.php" method="POST">
            <label for="name">Name:  <?php  echo $Username?></label>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label>Category</label>
            <select  name="category">
                <option value="Painting">Bugs</option>
                <option value="Fine Art">User complain</option>
                <option value="Pixel Art">Other please explain</option>
            </select>

            <label for="complaint">Complaint:</label>
            <textarea id="complaint" name="complaint" required></textarea>

            <button type="submit">Submit</button>

        </form>
    </div>
</body>
</html>
