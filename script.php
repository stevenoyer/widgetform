<?php

use Systrio\Database;

require_once 'database/db.class.php';

$bdd = new Database();

$sql_parts = [];
$values = [];

foreach ($_GET as $k => $v)
{
    if (!empty($v)) {
        $sql_parts[] = "$k = ?";
        $values[] = htmlspecialchars($v);
    }
}
$sql = implode(', ', $sql_parts);

$data = $bdd->save('form_dev', $sql, $values);

var_dump($data);


