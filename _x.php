<?php

define('_ITEM_ADDRESS_MIN_LEN', 10);
define('_ITEM_ADDRESS_MAX_LEN', 100);


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


