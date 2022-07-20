<?php
include_once '_profil_inc.php';
require_once '../_gestionBase.inc.php';

if (empty($_SESSION['login']) && empty($_SESSION['codeUtilisateur'])) {
    header('location:../accueil');
} else {
    ?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <title>Mon profil</title>
    </head>

    <body>
    <br><br><br><br>
    <?php
    $collectionUtilisateur = afficherUtilisateur();
    foreach ($collectionUtilisateur as $lesUtilisateurs): ?>
        <!--Reservation-->
        <center>
            <div class="container-fluid">
                <div class="panel-body">
                    <div id='kk'>
                        <strong><p>Nom & Prénom :</strong> <?php echo $lesUtilisateurs["contact"]; ?><p>
                            <strong>
                        <p> Raison sociale :</strong> <?php echo $lesUtilisateurs["raisonSociale"]; ?> </p>
                        <strong><p> Pays :</strong><?php echo $lesUtilisateurs["codePays"]; ?> </p>
                        <strong><p> Adresse :</strong><?php echo $lesUtilisateurs["adresse"]; ?> </p>
                        <strong><p> Code Postale :</strong><?php echo $lesUtilisateurs["cp"]; ?> </p>
                        <strong><p> Ville :</strong><?php echo $lesUtilisateurs["ville"]; ?> </p>
                        <strong><p> Adresse mail :</strong><?php echo $lesUtilisateurs["adrMel"]; ?> </p>
                        <strong><p> Numéro de téléphone :</strong><?php echo $lesUtilisateurs["telephone"]; ?> </p>
                        <strong><p> Identifiant :</strong><?php echo $lesUtilisateurs["login"]; ?> </p>
                        <strong><p> Mot de passe :</strong><?php echo $lesUtilisateurs["mdp"]; ?> </p>
                    </div>
                </div>
            </div>
        </center>
    <?php endforeach;
    ?>

    <style>
        #kk {
            border: 2px solid black;
        }
    </style>

    </body>
    </html>
    <?php
}
?>




