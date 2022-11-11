<?php
require_once __DIR__.'/classes/SurrealConnector.php';
require_once __DIR__.'/_x.php';
require_once __DIR__.'/nav.php';

$db = New SurrealConn($DB_CONFIG);

$id = 'user:xxxx';
$db->execute('DELETE ?', [$id]);
header('Location: get_all_users.php');