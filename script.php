<?php

use Systrio\Database;

require 'db.class.php';

$bdd = new Database('localhost', 'widget', 'widget', '1$9Zyjk0');


$name = 'widget';
$secret = '1$9Zyjk0';

foreach ($_GET as $k => $v)
{
    $get[$k] = htmlspecialchars($v);
}

extract($get);



