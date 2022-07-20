<?php
session_start();
require_once '_gestionBase.inc.php';

$codeUtilisateur = $_SESSION['codeUtilisateur'];
$codeReservationASupprimer = $_POST['codeReservationASupprimer'];

supprimerUneReservation($codeReservationASupprimer, $codeUtilisateur);
