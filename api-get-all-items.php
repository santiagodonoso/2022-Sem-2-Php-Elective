<?php
// APIs do not respond with HTML
// APIs do not redirect
// APIs respond with JSON
// In an API do not close the PHP tag
// The ONLY way you test an API is via Postman/Thunder Client 

// ini_set('display_errors', 1);

$items = ['id'=>1, 
          'address'=>'address one',
          'price'=>10];
header('Content-Type:application/json');
http_response_code(200);
echo json_encode($items);