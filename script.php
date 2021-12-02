<?php

use Systrio\Database;

require 'db.class.php';

$bdd = new Database();

$sql_parts = [];
$values = [];

foreach ($_GET as $k => $v)
{
    if (!empty($v)) {
        $get[$k] = htmlspecialchars($v);
        $sql_parts[] = "$k = ?";
        $values[] = htmlspecialchars($v);
    }
}
$sql = implode(', ', $sql_parts);
extract($get);

$data = $bdd->save('form_dev', $sql, $values);

var_dump($data);


