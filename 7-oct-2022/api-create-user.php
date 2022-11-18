<?php

require_once __DIR__.'/_x.php';

_validate_user_name();

$user = [ 'id'=>1, 
          'user_name' => $_POST['user_name']
        ];

_respond($user);



