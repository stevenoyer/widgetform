<?php

use Systrio\Database;

require 'db.class.php';

$bdd = new Database('localhost', 'widget', 'widget', '1$9Zyjk0');


$name = 'widget';
//$secret = '1$9Zyjk0';

$sql_parts = [];
$attributes = [];

foreach ($_GET as $k => $v)
{
    $get[$k] = htmlspecialchars($v);
    $sql_parts[] = "$key = ?";
    $attributes[] = htmlspecialchars($v);
}
$sql = implode(', ', $sql_parts);

extract($get);



$data = $bdd->save("INSERT INTO form_dev SET $sql", $attributes, true);

var_dump($data);


