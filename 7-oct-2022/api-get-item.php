<?php

require_once __DIR__.'/_x.php';

_validate_item_address();

$item = [
  'id'=>'1',
  'address'=>'address one',
  'price'=>10
];

_respond($item);



