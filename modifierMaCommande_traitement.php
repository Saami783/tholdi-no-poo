<?php
    session_start();
    require_once '_gestionBase.inc.php';

    $codeReservation = obtenirCodeReservation();
    $numTypeContainer = $_POST['numTypeContainer'];
    $quantite = $_POST["quantite"];
    $idReserver = $_GET['id'];

    modifierLigneDeReservation($codeReservation, $numTypeContainer, $quantite, $idReserver);
    header("location:mesReservations");
?>