<?php
    session_start();
    include_once '_gestionBase.inc.php';

    $codeUtilisateur = $_SESSION['codeUtilisateur'];
    $dateDeDebutReservation = $_POST['dateDebutReservation'];
    $dateFinReservation = $_POST['dateFinReservation'];
    $volumeEstime = $_POST['volumeEstime'];
    $etat = 'en cours';
    $codeVilleMiseDisposition = $_POST['codeVilleMiseDisposition'];
    $codeVilleRendre = $_POST['codeVilleRendre'];

    // Mise en format date pour Mysql
    $dateReservation = date("Y-m-d", time());
    $dateDeDebutReservation = date("Y-m-d",strtotime($dateDeDebutReservation));
    $dateFinReservation = date("Y-m-d",strtotime($dateFinReservation));

    // Permet de faire la différence entre la date de début de reservation
    // et la fin de la reservation que je stock dans differenceEntreLesDeuxDates
    $date1 = new DateTime($dateDeDebutReservation);
    $date2 = new DateTime($dateFinReservation);
    $differenceEntreLesDeuxDates = $date2->diff($date1)->format("%a");


    $_SESSION['codeReservation'] = ajouterUneReservation($dateDeDebutReservation, $dateFinReservation, $dateFinReservation, $volumeEstime, $codeVilleMiseDisposition, $codeVilleRendre, $codeUtilisateur, $etat, $differenceEntreLesDeuxDates);
    header('location: saisirLigneDeReservation');
?>
