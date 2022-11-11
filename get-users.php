<?php
// ini_set('display_errors', 1);
require_once __DIR__.'/surrealdb.php';

try{

  $users = json_decode(surrealdb('SELECT * FROM user'), true)[0]['result'];
  foreach($users as $user){ ?>
    <div class="user">
      <div>
        <?= $user['id'] ?>
      </div>
      <div>
        <?= $user['name'] ?>
      </div>

      <?php if(isset($user['created_at'])){ ?>
        <div><?= $user['created_at'] ?></div>
      <?php } ?>

    


    </div>
  <?php }
}catch(Exception $ex){
  echo $ex;
}


  /*
  [
    {
      "time":"126.3µs",
      "status":"OK",
      "result":
      [
        {"id":"user:vpi5zyuzbw4733uor6pn","name":"A"}
      ]
    }
  ]
  */




