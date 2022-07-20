<?php
require '../_gestionBase.inc.php';
session_start();
?>

<!DOCTYPE html>


<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="profil.css">
    <link rel="stylesheet" type="text/css" href="../style.css">


    <title>Profil</title>
</head>

<body>

<div class="container">
    <div class="informations-bar">
        <ul class="lu">
            <li class="infos"><a href="../profil/parametres">Paramètres</a></li>
            <li class="infos"><a href="../profil/informations">Mes informations</a></li>

            <li class="infos"><a href="../accueil">Accueil</a></li>
        </ul>

        <!-- <div class="profile">
        <img id="profil-img" src="../img/avatar/avatar.png" /> -->

        <div class="profile">
            <img id="profil-img" src="img/avatar/avatar.png">
            <strong><p class="name"
                       style="color: white; background-color: black"><?= "Bonjour " . $_SESSION['login']; ?></p>
            </strong>
        </div>
    </div>
</div>

