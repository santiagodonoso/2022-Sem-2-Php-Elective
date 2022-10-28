<?php

require_once __DIR__.'/router.php';

// ##################################################
// ##################################################
// ##################################################

// Static GET
// In the URL -> http://localhost
// The output -> Index
get('/',                            'views/index.php');
get('/item/$id',                    'views/item');
get('/$gender/shoes/$brand/$size',  'views/product');
get('/test/$word', function($word){
  echo $word;
});

// APIS
post('/item', 'apis/create_item');



// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404','views/404.php');