<?php
try{
  require_once __DIR__.'/db.php';
  $q = $_db->prepare('SELECT * FROM users');
  $q->execute();
  $users = $q->fetchAll();
  header('Content-Type: application/json');
  echo json_encode($users);
}catch(PDOException $ex){
  http_response_code(500);
  echo json_encode(['info'=>'Error in line: '.__LINE__]);
}