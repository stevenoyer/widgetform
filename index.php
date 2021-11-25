<?php

use Systrio\Database;

require 'db.class.php';

    $bdd = new Database('localhost', 'widget', 'widget', '1$9Zyjk0');

    if (!empty($_GET['client_id']) && !empty($_GET['token'])) {
        $client_id = htmlspecialchars($_GET['client_id']);
        $token = htmlspecialchars($_GET['token']);

        $res = $bdd->query("SELECT * FROM client WHERE client_id = '$client_id' AND token = '$token'", true);

        var_dump($res);

    }else {
        die('Vous n\'avez pas spécifier de client id et de token.');
    }
    

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Widget Form</title>
</head>
<body>

    <form id="form-widget" action="script.php" medthod="POST">
        <input name="prenom" type="text" placeholder="Votre prénom">
        <input type="submit" value="Envoyer">
    </form>
    
</body>
</html>