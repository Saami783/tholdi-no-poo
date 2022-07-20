<?php
    session_start();
    require_once '_gestionBase.inc.php';

    $codeReservation = $_SESSION["codeReservation"];

    $monDevis = obtenirCodeDevis();

    $monCodeDevis = null;
    foreach($monDevis as $devis)
    {
        $monCodeDevis = $devis['codeDevis'];
    }

    ajouterCodeDevisInReservation($monCodeDevis, $codeReservation);

    header("location: contact_traitement.php");
?>