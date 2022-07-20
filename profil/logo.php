<?php
require_once "_profil_inc.php";

if (!empty($_SESSION['login']) && !empty($_SESSION['mdp'])) {
    ?>


    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title> Profil </title>
        <link rel="stylesheet" type="text/css" href="logo.css">
    </head>
    <body>

    <!-- Ajouter un logo -->
    <form class="forme" enctype="multipart/form-data" action="../file_upload.php" method="post">
        <input type="file" name="monfichier">
        <p>Cliquez ici pour importer votre logo.</p>
        <button class="button, button2" type="submit">Importer</button>
    </form>
    <!-- Fin Ajouter un logo -->


    <!-- Supprimer un logo -->
    <a class="selection_logo" href="../img/file_remove.php/">
        <button class="button button2">Cliquez ici pour le logo par defaut.</button>
    </a>
    <br/>
    <!-- Fin Supprimer un logo -->


    </body>
    </html>

    <?php
} else {
    header('location: ../accueil');
}
?>