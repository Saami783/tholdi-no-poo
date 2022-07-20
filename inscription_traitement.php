<?php
    session_start();
    require_once '_gestionBase.inc.php';

    $raisonSociale = htmlspecialchars($_POST['raisonSociale']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $cp = htmlspecialchars($_POST['cp']);
    $ville = htmlspecialchars($_POST['ville']);
    $adrMel = htmlspecialchars($_POST['adrMel']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $contact = htmlspecialchars($_POST['contact']);
    $codePays = $_POST['codePaysDisposition'];
    $login = htmlspecialchars($_POST['login']);
    $mdp = htmlspecialchars($_POST['mdp']);

    ajouterUtilisateur($raisonSociale, $adresse, $cp, $ville, $adrMel, $telephone, $contact, $codePays, $login, $mdp);
    header('location: connexion');
?>
