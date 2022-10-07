<?php

define('_USER_NAME_MIN_LEN', 5);
define('_USER_NAME_MAX_LEN', 20);

define('_ITEM_ADDRESS_MIN_LEN', 10);
define('_ITEM_ADDRESS_MAX_LEN', 100);

// ##############################
function _validate_user_name(){
  $error_message = 'user_name '._USER_NAME_MIN_LEN.' to '._USER_NAME_MAX_LEN.' characters';
  if( ! isset($_POST['user_name'])){ _respond($error_message, 400); }
  $_POST['user_name'] = trim($_POST['user_name']);
  if(strlen($_POST['user_name']) < _USER_NAME_MIN_LEN){ _respond($error_message); }
  if(strlen($_POST['user_name']) > _USER_NAME_MAX_LEN){ _respond($error_message); }
  return $_POST['user_name'];
}

// ##############################
function _validate_item_address(){
  $error_message = 'item_address '._ITEM_ADDRESS_MIN_LEN.' to '._ITEM_ADDRESS_MAX_LEN.' characters';
  if( ! isset($_POST['item_address'])){ _respond($error_message, 400); }
  $_POST['item_address'] = trim($_POST['item_address']);
  if(strlen($_POST['item_address']) < _ITEM_ADDRESS_MIN_LEN){ _respond($error_message); }
  if(strlen($_POST['item_address']) > _ITEM_ADDRESS_MAX_LEN){ _respond($error_message); }
  return $_POST['item_address'];
}


// ##############################
function _respond($message='', $status=200){
  http_response_code($status);
  header('Content-Type: application/json');
  $res = is_array($message) ? $message : ['info' => $message];
  echo json_encode($res);
  exit();
}


