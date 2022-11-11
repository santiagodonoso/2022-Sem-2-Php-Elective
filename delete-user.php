<?php

require_once __DIR__.'/surrealdb.php';

// GET the user's id from the url
if(!isset($_GET['id']) ){
  header("Location: get-users.php");
}
// Connect to SurrealDB 
try{
  surrealdb('DELETE :id', ['id'=>$_GET['id']]);
  header("Location: get-users.php");
  exit();
}catch(Exception $ex){
  echo $ex;
}



