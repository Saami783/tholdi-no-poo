<?php
    session_start();
    require_once '_gestionBase.inc.php';

    $loginSaisit = htmlspecialchars($_POST['login']);
    $mdpSaisit = htmlspecialchars($_POST['mdp']);

    connexionUtilisateur($loginSaisit, $mdpSaisit);
?>