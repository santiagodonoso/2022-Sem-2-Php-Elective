<?php
require_once(__DIR__.'/db.php');
try{
  $_db->beginTransaction();
  $q = $_db->prepare(''); // First of 2 or more updates, inserts, or deletes
  $q->execute();
  
  
  // if rowCount then it was updated
  if( $q->rowCount() == 0 ){
    $db->rollback();
    echo 'Could not update the user';
    exit();
  }
  // This is the 2nd or 3rd.......
  $q = $db->prepare(''); // update, insert, or delete
  $q->execute();
  if( $q->rowCount() == 0 ){
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




