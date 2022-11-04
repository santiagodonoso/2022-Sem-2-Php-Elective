<?php

// user:454565665656; CREATE user SET name = 'A';
$_id = $_GET['id'];

require_once __DIR__.'/_x.php';
_db('LET $id = "'.$_id.'"; DELETE $id');

header('Location: /');

