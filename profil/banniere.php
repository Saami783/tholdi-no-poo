<?php
require_once "_profil_inc.php";

if (!empty($_SESSION['login']) && !empty($_SESSION['mdp'])) {
    ?>


    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title> Profil </title>

    </head>

    <!-- Ajouter une banniere -->
    <form enctype="multipart/form-data" action="../banniere_upload.php" method="post">
        <input type="file" name="monfichier">
        <!--   <p>Cliquez ici pour importer votre avatar.</p> -->
        <button type="submit">Importer</button>
    </form>
    <!-- Fin Ajouter une banniere -->


    <!-- Supprimer une banniere -->
    <a href="../img/banniere/banniere_remove.php/">
        <button>Cliquez ici pour la bannière par defaut.</button>
    </a>
    <br/>
    <!-- Fin Supprimer une banniere -->


    <body>

    </body>
    </html>

    <?php
} else {
    header('location: ../accueil');
}
?>