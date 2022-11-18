<?php
$user_password = 'passA';
$user_password_hashed = password_hash($user_password, PASSWORD_BCRYPT);
echo $user_password_hashed;

echo '******************************';
echo $user_password_hashed;
echo '******************************';



// This comes from the database... SELECT * FROM users WHERE email = "@a" AND password = "23333"
$hashed_password = '$2y$10$V3DYgrJtKnVwknZ3.bmotOPSJeCT6CE.njXBsB4cOVv73qRrWendK';

if( password_verify($user_password, $hashed_password )  ){
  echo 'YOU ARE LOGGED IN';
}else{
  echo 'TRY AGAIN';
}

