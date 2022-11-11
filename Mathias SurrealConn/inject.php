<?php
require_once __DIR__.'/classes/SurrealConnector.php';
require_once __DIR__.'/_x.php';
require_once __DIR__.'/nav.php';

$db = New SurrealConn($DB_CONFIG);

// Parsing vars in array
$injection = 'user:xxxx; CREATE user:yyyy SET name=99';
// $db->execute('SELECT * FROM user WHERE id=?', [$injection]);

// Parsing vars directly in query
$db->execute("SELECT * FROM user WHERE id=$injection");

$users = $db->execute('SELECT * FROM user');
echo json_encode($users);
