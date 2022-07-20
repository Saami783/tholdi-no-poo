<?php
session_start();
require '../_gestionBase.inc.php';

$user = htmlspecialchars($_POST['login']);
$nouveauMdp = htmlspecialchars($_POST['newMdp']);
$mdpCourant = htmlspecialchars($_POST['mdp']);
$codeUtilisateur = $_SESSION['codeUtilisateur'];

changerMdp($user, $mdpCourant, $nouveauMdp, $codeUtilisateur);