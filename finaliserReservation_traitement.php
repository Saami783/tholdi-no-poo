<?php
    session_start();
    require_once '_gestionBase.inc.php';

    $codeReservation = $_SESSION["codeReservation"];

    foreach ($_SESSION["ligneDeReservation"] as $key => $value)
    {
        ajouterLigneDeReservation($codeReservation, $key, $value);
    }

    $montantDevis = $_SESSION['total'];
    ajouterUnDevis($montantDevis);

    header("location:ajouterDevis.php");
?>