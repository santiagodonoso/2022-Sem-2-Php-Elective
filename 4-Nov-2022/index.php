<?php
require_once __DIR__.'/_x.php';
$users = _db("SELECT * FROM user")['result'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

  <div id="users">

  <?php foreach($users as $user){ ?>
    <div class="user">
      <div><?= $user['id'] ?></div>
      <div><?= $user['name'] ?></div>
      <!-- <a href="delete-user.php?id=<?=$user['id']?>; CREATE user SET name = 'B';">🗑️</a> -->
      <a href="delete-user.php?id=<?=$user['id']?>">🗑️</a>
    </div>
  <?php } ?>

  


  </div>
  
</body>
</html>