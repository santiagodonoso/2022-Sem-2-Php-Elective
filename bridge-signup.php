<?php

require_once __DIR__.'/surrealdb.php';

try{
  if(!isset($_POST['name'])){
    header("Location: signup.php");
    exit();
  }
  if(!isset($_POST['email'])){
    header("Location: signup.php");
    exit();
  }
  if(!isset($_POST['password'])){
    header("Location: signup.php");
    exit();
  }  
  $user = [
            'name'=>$_POST['name'], 
            'email'=>$_POST['email'],
            'password'=>$_POST['password']
          ];
  surrealdb('CREATE user SET name=:name, email=:email, password=:password;', $user);

  // Success
  header("Location: get-users.php");
  exit();  

}catch(Exception $x){
  echo $ex;
}