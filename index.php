<?php

use Systrio\Database;

require 'db.class.php';

    $bdd = new Database('localhost', 'widget', 'root', '');
    $client_id = htmlspecialchars($_GET['client_id']);
    $token = htmlspecialchars($_GET['token']);

    if (!empty($client_id) && !empty($token)) {

        $res = $bdd->query("SELECT * FROM client WHERE client_id = '$client_id' AND token = '$token'", true);
        if (!$res) {
            die('Votre client id ou votre token n\'est pas répertorié dans notre base de données.');
        }

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

        <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
        <input type="hidden" name="token" value="<?php echo $token; ?>">
    </form>
    
</body>
</html>