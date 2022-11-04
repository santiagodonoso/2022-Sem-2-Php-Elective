<?php
require_once __DIR__.'/_x.php';

$id = _db("CREATE user SET name='A' ")['result'][0]['id'];

echo $id;

// Connect to the database using the driver
// Save your name in the database
// CREATE user SET name = "XXX"
// Show the user's id in the screen