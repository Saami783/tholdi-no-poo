<?php
session_start();
include_once '_gestionBase.inc.php';

$id = $_GET['id'];
$codeUtilisateur = $_SESSION['codeUtilisateur'];
$codeReservation = obtenirCodeReservation();

$resultat = estLaDerniereLigneDeReservation($codeReservation);

if($resultat)
{
    supprimerUneReservation($codeReservation, $codeUtilisateur);
    header('location: mesReservations');
}else{
    supprimerUneLigneDeReservation($id);
    header('location: mesReservations');
}
