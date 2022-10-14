<?php
try{
  require_once __DIR__.'/db.php';
  $query = $db->prepare('UPDATE users SET name="X" WHERE id=2');
  $query->execute();
  if( $query->rowCount() == 0 ){
    echo 'User cannot be updated';
    exit();
  }
  // header('Content-Type: application/json');
  echo 'User updated successfully';
  exit();   
}catch(PDOException $ex){
 echo $ex;
}
