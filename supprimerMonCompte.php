<?php
require_once '_gestionBase.inc.php';
include_once "_head.inc.php";

if (empty($_SESSION['login']) && empty($_SESSION['codeUtilisateur'])) {
    header('location:connexion');
} else {
    ?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="NoS1gnal"/>

        <link rel="stylesheet" href="css/connexion_bootstrap.css" media="screen">
        <link rel="stylesheet" href="css/connexion.css" media="screen">

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet"
              type="text/css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet"
              type="text/css">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>


        <title>Connexion</title>
    </head>
    <body>

    <br/> <br/> <br/> <br/> <br/> <br/> <br/>
    <div class="login-form">
        <form action="supprimerMonCompte_traitement.php" method="post">

            <!-- Saisit du login -->
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                </div>
                <input name="login" class="form-control" placeholder="Identifiant" type="text">
            </div>

            <!-- Saisit du mot de passe -->
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                </div>
                <input name="mdp" class="form-control" placeholder="Mot de passe" type="password">
            </div>

            <!-- Bouton valider -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Supprimer mon compte</button>
            </div>
        </form>
    </div>


    </body>
    </html>

    <?php
}
?>