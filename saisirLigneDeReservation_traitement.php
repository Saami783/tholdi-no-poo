<?php
session_start();
require_once '_gestionBase.inc.php';

$code = obtenirCodeReservation();
$codeReservation = $code ;

$numTypeContainer = $_POST['numTypeContainer'];
$quantite = $_POST["quantite"];

ajouterLigneDeReservation($codeReservation,$numTypeContainer,$quantite);
header("location:saisirLigneDeReservation");

//$collectionDureeContainer = afficherLigneDeReservation($codeReservation);


?>