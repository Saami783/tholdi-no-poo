<?php
require '../_gestionBase.inc.php';
session_start();


?>


<html>
<head>
    <title>title</title>
</head>

<body>

<div id="div-h">
    <form class="form" action="" method="post">
        <div class='div-second'>
            <center><h3 style="color: black">Changer mon mot de passe </h3></center>
            <div class="div-form">

                <div class='div-sous-form'>
                    <p class='top-p' id='utilisateur-p'>Nom d'utilisateur </p>
                    <input class="input" name="login" type="text" required="Veuillez remplir le champ">
                </div>
            </div>

            <br>
            <div class="div-form">
                <div class='div-sous-form'>
                    <p class='top-p' id='mdp-p'>Mot de passe </p>
                    <input class="input" name="mdp" type="password" required="Veuillez remplir le champ">
                </div>
            </div>

            <br>
            <div class="div-form">
                <div class='div-sous-form'>
                    <p class='top-p' id='Newmdp-p'>Nouveau mdp </p>
                    <input class="input" name="newMdp" type="password" required="Veuillez remplir le champ">
                </div>
            </div>

            <br>
            <br>
            <input class='input' id="button" type="submit" value="Envoyer">

        </div>
    </form>
</div>

</body>

<?php


?>
</html>

