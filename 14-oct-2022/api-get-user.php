<?php
try{
  require_once(__DIR__.'/db.php');
  $query = $_db->prepare('SELECT * FROM users WHERE user_id = :user_id LIMIT 1');
  $query->bindValue(':user_id', $_GET["user_id"]);
  $query->execute();
  $user = $query->fetch();
  if (!$user){
    http_response_code(204);
    echo json_encode(['info'=>'user not found']);
    exit();
  }
  // Success
  header('Content-Type:application/json');
  echo json_encode($user);
  exit();
}catch(PDOException $ex){
  http_response_code(500);
  echo json_encode(['info'=>'Error in line'.__LINE__]);
  exit();
}
