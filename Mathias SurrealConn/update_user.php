<?php
require_once __DIR__.'/classes/SurrealConnector.php';
require_once __DIR__.'/_x.php';
require_once __DIR__.'/nav.php';

$db = New SurrealConn($DB_CONFIG);

$id = 'user:xxxx';
$name = 'Allan';

$user = $db->execute('UPDATE ? SET name = ?', [$id, $name]);
echo json_encode($user);