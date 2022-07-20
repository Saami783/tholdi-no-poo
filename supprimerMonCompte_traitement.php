<?php
session_start();
require '_gestionBase.inc.php';

$login = htmlspecialchars($_POST['login']);
$mdp = htmlspecialchars($_POST['mdp']);
$id = $_SESSION['codeUtilisateur'];


supprimerUtilisateur($login, $id);

header('location: inscription');

?>
