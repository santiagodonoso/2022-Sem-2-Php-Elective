<?php
require_once __DIR__.'/classes/SurrealConnector.php';
require_once __DIR__.'/_x.php';
require_once __DIR__.'/nav.php';

$db = New SurrealConn($DB_CONFIG);

$users = $db->execute('SELECT * FROM user');
echo json_encode($users);