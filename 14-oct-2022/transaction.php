<?php

// For every statement 1 rollback when you check
// Always a rollback in the last catch
// Tehre is only 1 commit when everything went OK

require_once(__DIR__.'/db.php');
try{
  $_db->beginTransaction();
  $query = $_db->prepare('UPDATE users 
                          SET user_name=:user_name 
                          WHERE user_id=:user_id');
  $query->bindValue(':user_name', 'CCC');
  $query->bindValue(':user_id', '3');
  $query->execute();
  
  // if rowCount then it was updated
  if( $query->rowCount() == 0 ){
    $_db->rollback();
    echo 'Could not update the user';
    exit();
  }


  $query = $_db->prepare('UPDATE usersxxx 
                          SET user_name=:user_name 
                          WHERE user_id=:user_id');
  $query->bindValue(':user_name', 'DDD');
  $query->bindValue(':user_id', '4');
  $query->execute();
  if( $query->rowCount() == 0 ){
    $_db->rollback();
    echo 'this went wrong';
    exit();
  }
  // EVERYTHING PERFECT
  $_db->commit();
  echo 'YES';

}catch(Exception $ex){
  $_db->rollback();
  echo $ex;
}




