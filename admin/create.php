<?php

use Systrio\Database;

require_once '../database/db.class.php';
$database = new Database();

$sql_parts = [];
$values = [];

foreach ($_POST as $k => $v)
{
    if (!empty($v))
    {
        if ($k == 'html')
        {
            $sql_parts[] = "$k = ?";
            $values[] = base64_encode($v);
        }else {
            $sql_parts[] = "$k = ?";
            $values[] = htmlspecialchars($v);
        }
    }
}

$sql = implode(', ', $sql_parts);

$save = $database->save('client', $sql, $values);


if ($save)
{
    $base_dir = 'clients/';
    $dirname = $values[0];
    $filename = $values[0] . '_' . date('d_m_Y') . '.php';

    $html = $_POST['html'];

    if (!is_dir($base_dir . $dirname)) 
    {
        mkdir($base_dir . $dirname, 0777, true);
        $open = fopen($base_dir . $dirname . '/' . $filename, 'a');
        fwrite($open, $html);
        fclose($open);
    }
    else 
    {
        $open = fopen($dirname . '/' . $filename, 'a');
        fwrite($open, $html);
        fclose($open);
    }

    header('Location: /admin');
}


?>