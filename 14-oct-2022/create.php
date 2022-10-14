<?php

try{
  // $_POST['password'] = password_hash( $_POST['password'], PASSWORD_DEFAULT );
  require_once __DIR__.'/db.php';
  $query = $_db->prepare('INSERT INTO users  
            VALUES (NULL, :user_name, :user_email, :user_password)');
  $query->bindValue(':user_name', 'A');
  $query->bindValue(':user_email', '@a');
  $query->bindValue(':user_password', 'passwordA');
  $query->execute();
  $id = $_db->lastInsertId();
  // http_response_code(200); // default is this line
  // header('Content-Type: application/json');
  // echo '{"id":'.$id.'}';
  echo $id;
}catch(PDOException $ex){
  echo $ex;
}
