<?php
include 'database.php';

// Check if the email already exists
$query = "SELECT * FROM requests";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./assets/css/admin.css">
</head>
<body>

<header class="header">
    <div class="header-content">
      <div class="header-logo">
        <h1 class="logo">ADMIN Dashboard</h1>
      </div>
      <nav class="header-navigation">
        <a href="/index.php" class="<?= $page == 'home'? 'active-nav': '' ?>">Users</a>
        <a href="/aboutUs.php" class="<?= $page == 'aboutUs'? 'active-nav': '' ?>">Requests</a>
        <a href="/aboutUs.php" class="<?= $page == 'aboutUs'? 'active-nav': '' ?>">Notify</a>
      </nav>
    </div>
  </header>

  <main>
  <h2>HTML Table</h2>

<table>
  <tr>
    <th>Location</th>
    <th>Date</th>
    <th>Time</th>
    <th>Urgency</th>
    <th>Description</th>
    <th>Image</th>
    <th>Accept</th>
    <th>Delete</th>
  </tr>
    <?php foreach($result as $r){ ?>
  <tr>
    <td><?php echo $r['collection_location']; ?></td>
    <td><?php echo $r['pick_up_date']; ?></td>
    <td><?php echo $r['pick_up_time']; ?></td>
    <td><?php echo $r['urgency']; ?></td>
    <td><?php echo $r['description']; ?></td>
    <td class="imgCell">
        <?php if($r['img_path_1'] != null) ?>
        <img src="<?php echo $r['img_path_1']; ?>" alt="Image">
        <?php if(isset($r['img_path_2']) && $r['img_path_2'] != null) ?>
        <img src="<?php echo $r['img_path_2']; ?>" alt="Image">
        <?php if($r['img_path_3'] != null) ?>
        <img src="<?php echo $r['img_path_3']; ?>" alt="Image">
</td>
    <td><button class="acceptBtn">Accept</button></td>
    <td><button class="deleteBtn">Delete</button></td>
  </tr>
  <?php } ?>
</table>
  </main>
</body>
</html>
