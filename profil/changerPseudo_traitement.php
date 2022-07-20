<?php
session_start();
require '../_gestionBase.inc.php';

$log = htmlspecialchars($_POST['login']);
$newLogin = htmlspecialchars($_POST['newLogin']);
$codeUser = $_SESSION['codeUtilisateur'];


changerPseudo($log, $newLogin, $codeUser);

// sami -> sami
// root -> root
//admin -> admin