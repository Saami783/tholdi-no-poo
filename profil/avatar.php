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

    <body>
    <!-- Ajouter un avatar -->
    <form enctype="multipart/form-data" action="../avatar_upload.php" method="post">
        <input type="file" name="monfichier">
        <!--   <p>Cliquez ici pour importer votre avatar.</p> -->
        <button type="submit">Importer</button>
    </form>
    <!-- Fin Ajouter un avatar -->


    <!-- Supprimer un avatar -->
    <a href="../img/avatar/avatar_remove.php/">
        <button>Cliquez ici pour le avatar par defaut.</button>
    </a>
    <br/>
    <!-- Fin Supprimer un avatar -->


    <body>

    </body>
    </html>

    <?php
} else {
    header('location: ../accueil');
}
?>