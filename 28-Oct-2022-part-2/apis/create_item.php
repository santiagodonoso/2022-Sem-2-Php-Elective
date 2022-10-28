<?php

require_once __DIR__.'/../_x.php';

_validate_item_name();
_validate_item_image();

echo "Item created: {$_POST['item_name']}";