<?php

$user = ['name'=>'A']; // user form db
session_start();
$_SESSION['user']=$user;

echo $_SESSION['user']['name'];

