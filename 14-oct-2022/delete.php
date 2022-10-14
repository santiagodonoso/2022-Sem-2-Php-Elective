<?php
try{
  require_once __DIR__.'/db.php';
  $query = $_db->prepare('DELETE FROM users WHERE user_id = :user_id');
  $query->bindValue(':user_id', '1');
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
