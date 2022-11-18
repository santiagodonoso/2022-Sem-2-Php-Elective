<?php
header('Content-Type:application/json');

try{
    require_once __DIR__.'/db.php';
    $user_id = $_GET['user_id'];

    $q = $_db->prepare('DELETE FROM users WHERE user_id = :user_id');
    $q->bindValue(':user_id', $user_id);
    $q->execute();

    if( $q->rowCount() == 0 ){
        http_response_code(204);
        exit();
    }

    echo json_encode(['info' => "user deleted with id: $user_id"]);
    exit();

  }catch(PDOException $ex){
    http_response_code(500);
    echo json_encode(['info'=>'Server error']);
    exit();
  }