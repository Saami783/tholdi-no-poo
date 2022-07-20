<?php
    session_start();
    require_once '_gestionBase.inc.php';
?>
<!DOCTYPE html>
<html style="font-size: 16px;">
<head>
    <link rel="icon" type="image/png" sizes="16x16" href="images/index/gt_favicon.png"/>
    <link rel="stylesheet" href="css/header.css" media="screen">
    
</head>
<div class="box">
    <header class="header">
        <a href="index.php" class="header-logo">THOLDI</a>
        <nav class="header-nav">
            <a href="accueil">Accueil</a>
            <a href="tarif">Tarif</a>
<!-- Si l'utilisateur est connecté alors j'affiche la page de reservations et celle de consultation des reservations dans le header -->
            <?php
                if (!empty($_SESSION['login']) && !empty($_SESSION['codeUtilisateur']))
                {
                    echo "<a href=\"reservation\">Reservation</a>";
                    echo " <a href=\"consultationReservation\">Consultation des Reservations</a>";
                }
            ?>

        </nav>
        <!-- Si l'utilisateur n'est pas connecté j'affiche la page de connecion -->
        <?php
            if (empty($_SESSION['login']) && empty($_SESSION['codeUtilisateur']))
                {
                    echo " <a class=\"button\" href=\"connexion\">S'authentifier</a>";
                }else
                {
        // Sinon si l'utilisateur est connecté j'affiche la page profil et déconnexion
                    echo "<a class=\"button\" href=\"profil\parametres.php\">profil</a>";
                    echo "<a class=\"button\" href=\"deconnexion.php\">Deconnexion</a>";
                }
        ?>
    </header>
</div>
