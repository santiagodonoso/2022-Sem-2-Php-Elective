<?php
require_once __DIR__.'/classes/SurrealConnector.php';
require_once __DIR__.'/_x.php';
require_once __DIR__.'/nav.php';

$db = New SurrealConn($DB_CONFIG);

$user = $db->execute('CREATE user:xxxx SET name = "Steve"');
echo json_encode($user);