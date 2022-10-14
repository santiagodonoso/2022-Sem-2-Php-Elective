<?php
try{
  require_once __DIR__.'/db.php';
  $query = $db->prepare('DELETE FROM users WHERE id = :id');
  $query->bindValue(':id', '1');
  $query->execute();
  if( $query->rowCount() == 0 ){
    echo 'User was not deleted';
    exit();
  }
  // header('Content-Type: application/json');
  echo "user deleted with id: 1";
  exit();   
}catch(PDOException $ex){
  echo $ex;
}
