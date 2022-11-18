<?php
try{
  require_once(__DIR__.'/db.php');
  $q = $_db->prepare('SELECT * FROM users');
  $q->execute();
  $rows = $q->fetchAll();
  // echo $aRows[0]['name']; // PDO::FETCH_ASSOC 
  // echo $aRows[0]->name; // PDO::FETCH_OBJ 
  // header('Content-Type: application/json');
  echo json_encode($rows);
}catch(PDOException $ex){
  echo $ex;
}
