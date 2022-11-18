<?php

define('_USER_NAME_MIN_LEN', 2);
define('_USER_NAME_MAX_LEN', 20);
define('_USER_LAST_NAME_MIN_LEN', 2);
define('_USER_LAST_NAME_MAX_LEN', 20);
define('_USER_PASSWORD_MIN_LEN', 6);
define('_USER_PASSWORD_MAX_LEN', 50);
// define('_USER_PHONE_REGEX', '^[5][6-9][0-9]+$'); // 563
define('_REGEX_EMAIL', '^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$');

define('_ITEM_NAME_MIN_LEN', 2);
define('_ITEM_NAME_MAX_LEN', 20);
define('_ITEM_PRICE_REGEX', '^[1-9][0-9]*\.[0-9]{2}$');
define('_ITEM_KEY_REGEX', '^[0-9]+$');


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
function _validate_user_last_name(){
  $error_message = 'user_last_name'._USER_LAST_NAME_MIN_LEN.' to '._USER_LAST_NAME_MAX_LEN.' characters';
  if( ! isset($_POST['user_last_name'])){ _respond($error_message, 400); }
  $_POST['user_last_name'] = trim($_POST['user_last_name']);
  if(strlen($_POST['user_last_name']) < _USER_LAST_NAME_MIN_LEN){ _respond($error_message); }
  if(strlen($_POST['user_last_name']) > _USER_LAST_NAME_MAX_LEN){ _respond($error_message); }
  return $_POST['user_last_name'];
}

// ##############################
function _validate_user_password(){
  $error_message = 'user_password '._USER_PASSWORD_MIN_LEN.' to '._USER_PASSWORD_MAX_LEN.' characters';
  if( ! isset($_POST['user_password'])){ _respond($error_message, 400); }
  $_POST['user_password'] = trim($_POST['user_password']);
  if(strlen($_POST['user_password']) < _USER_PASSWORD_MIN_LEN){ _respond($error_message); }
  if(strlen($_POST['user_password']) > _USER_PASSWORD_MAX_LEN){ _respond($error_message); }
  return $_POST['user_password'];
}

// ##############################
function _validate_user_email(){
  $error_message = 'user_email invalid';
  if( ! isset($_POST['user_email']) ){ _respond($error_message, 400); }
  $_POST['user_email'] = trim($_POST['user_email']);
  if( ! preg_match('/'._REGEX_EMAIL.'/', $_POST['user_email']) ){ _respond($error_message, 400); }  
  return $_POST['user_email'];
}

// ##############################
function _validate_item_key(){
  $error_message = 'item_key invalid';
  if( ! isset($_POST['item_key'])){ _respond($error_message, 400); }
  $_POST['item_key'] = trim($_POST['item_key']);
  if( ! preg_match('/'._ITEM_KEY_REGEX.'/', $_POST['item_key']) ){ _respond($error_message, 400); }  
  return $_POST['item_key'];
}

// ##############################
function _validate_item_name(){
  $error_message = 'item_name '._ITEM_NAME_MIN_LEN.' to '._ITEM_NAME_MAX_LEN.' characters';
  if( ! isset($_POST['item_name'])){ _respond($error_message, 400); }
  $_POST['item_name'] = trim($_POST['item_name']);
  if(strlen($_POST['item_name']) < _ITEM_NAME_MIN_LEN){ _respond($error_message); }
  if(strlen($_POST['item_name']) > _ITEM_NAME_MAX_LEN){ _respond($error_message); }
  return $_POST['item_name'];
}

// ##############################
function _validate_item_price(){
  $error_message = 'item_price must be a whole number, or a number with two decimals';
  if( ! isset($_POST['item_price']) ){ _respond($error_message, 400); }
  $_POST['item_price'] = trim($_POST['item_price']);
  if( ctype_digit($_POST['item_price']) ){ $_POST['item_price'] .= '.'.$_POST['item_price']; }
  $_POST['item_price'] = str_replace(',', '.', $_POST['item_price']);
  if( ! preg_match('/'._ITEM_PRICE_REGEX.'/', $_POST['item_price']) ){ _respond($error_message, 400); }
  return $_POST['item_price'];
}

// ##############################
function _validate_from_to(){
  $error_message = 'from and to must be integers. to must be larger than from';
  if( ! isset($_GET['from']) ){ _respond($error_message, 400); }
  if( ! isset($_GET['to']) ){ _respond($error_message, 400); }
  $_GET['from'] = trim($_GET['from']);
  $_GET['to'] = trim($_GET['to']);
  if( ! ctype_digit($_GET['from']) ){ _respond($error_message, 400); }
  if( ! ctype_digit($_GET['to']) ){ _respond($error_message, 400); }
  if( $_GET['from'] >= $_GET['to']){ _respond($error_message, 400); }
  $_GET['from'] = intval(trim($_GET['from']));
  $_GET['to'] = intval(trim($_GET['to']));  
}


// ##############################
// test.png test.jpg

function _validate_item_image(){
  if($_FILES['item_image']['error'] === UPLOAD_ERR_INI_SIZE) {
    _respond('item_image too large', 400);
  }
  $item_image_temp_name = $_FILES["item_image"]["tmp_name"]; // C:\xampp\tmp\php791.tmp || C:\xampp\tmp\php5245.tmp
  $target_dir = "images/";
  $target_file = $target_dir . basename($_FILES["item_image"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // just reads the extension of the file
  $image_mime = mime_content_type($_FILES["item_image"]["tmp_name"]); // reads the mime inside the file
  $accepted_image_formats = ['image/png', 'image/jpeg'];
  if( ! in_array($image_mime, $accepted_image_formats) ){
    http_response_code(400);
    echo 'image not allowed';
    exit();
  }
  $random_image_name = bin2hex(random_bytes(16));
  switch($image_mime){
    case 'image/png':
      $random_image_name .= '.png';
    break;
    case 'image/jpeg':
      $random_image_name .= '.jpeg';
    break;
  }

  if(move_uploaded_file($_FILES["item_image"]["tmp_name"], 'images/2.png')){
    echo 'ok';
    exit();
  }  
}


// ##############################
function _respond($message='', $status=200){
  http_response_code($status);
  header('Content-Type: application/json');
  $res = is_array($message) ? $message : ['info' => $message];
  echo json_encode($res);
  exit();
}



