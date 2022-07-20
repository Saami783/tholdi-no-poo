<?php
    session_start();
    // Je détruis la session pour deconnecter l'utilisateur
    session_destroy();
    header('location: accueil');
    exit;
?>