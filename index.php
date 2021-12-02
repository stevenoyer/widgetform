<?php

use Systrio\Database;

require_once 'database/db.class.php';

$bdd = new Database();
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
</head>
<body>

    <div class="container-fluid container-md mt-4">
        <form id="form-widget" action="script.php" medthod="POST">
            <div class="mb-3">
                <label class="form-label" for="prenom">Prénom</label>
                <input id="prenom" class="form-control" name="prenom" type="text" placeholder="Votre prénom">
            </div>
    
            <div class="mb-3">
                <label class="form-label" for="nom">Nom</label>
                <input id="nom" class="form-control" name="nom" type="text" placeholder="Votre nom">
            </div>
    
            <div class="mb-3">
                <label class="form-label" for="email">E-mail</label>
                <input id="email" class="form-control" name="email" type="email" placeholder="Votre e-mail">
            </div>
    
            <div class="mb-3">
                <label class="form-label" for="tel">Téléphone</label>
                <input id="tel" class="form-control" name="tel" type="text" placeholder="Votre téléphone">
            </div>
    
            <div class="mb-3">
                <label class="form-label" for="adresse">Adresse</label>
                <input id="adresse" class="form-control" name="adresse" type="text" placeholder="Votre adresse">
            </div>
    
            <div class="mb-3">
                <label class="form-label" for="postal">Code Postal</label>
                <input id="postal" class="form-control" name="postal" type="text" placeholder="Votre code postal">
            </div>
    
            <div class="mb-3">
                <label class="form-label" for="ville">Ville</label>
                <input id="ville" class="form-control" name="ville" type="text" placeholder="Votre ville">
            </div>
    
            <div class="mt-2 text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send"></i> 
                    Envoyer
                </button>
            </div>
    
            <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>