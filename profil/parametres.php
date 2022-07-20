<?php
require_once "_profil_inc.php";

if (!empty($_SESSION['login']) && !empty($_SESSION['codeUtilisateur'])) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title> Profil </title>
        <link rel="stylesheet" type="text/css" href="css/param.css">
    </head>
    <body>

    <!-- Debut de code pour changer le thème du site -->
    <!--<label for="colorInput" class="form-label">Color picker</label>
    <input type="color" class="form-control form-control-color" id="colorInput" value="#563d7c" title="Choose your color">
    <button id="buttonColorPicker" onclick="changeColor()">Appliquer la couleur</button>

    <script type="text/javascript">

    function changeColor(color){
      // document.getElementById('colorInput').stylebackgroundcolor = changeColor(this.value)
       document.body.style.backgroundColor =  changeColor(this.value)
    }
    </script>-->
    <br>
    <br>

    <!-- Section Contact -->
    <div id="div-f">

        <!--Formulaire changement de login-->
        <div id="div-g">
            <form class="form" action="changerPseudo_traitement.php" method="post">
                <div class='div-second'>
                    <center><h3 style="color: black">Changer mon pseudo</h3></center>
                    <div class="div-form">

                        <div class='div-sous-form'>
                            <p class='top-p' id='utilisateur-p'>Nom d'utilisateur </p>
                            <input class="input" name="login" type="text" required="Veuillez remplir le champ">
                        </div>
                    </div>

                    <br>
                    <div class="div-form">
                        <div class='div-sous-form'>
                            <p class='top-p' id='newLogin-p'>Nouveau pseudo </p>
                            <input class="input" name="newLogin" type="text" required="Veuillez remplir le champ">
                        </div>
                    </div>

                    <br>
                    <br>
                    <input class='input' id="button" type="submit" value="Envoyer">

                </div>
            </form>
        </div>

        <!--Formulaire changement de mot de passe-->
        <div id="div-h">
            <form class="form" action="changerMdp_traitement.php" method="post">
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

        <!--Formulaire supprimer compte-->
        <div>
            <form class="form" action="supprimerCompte_traitement.php" method="post">
                <div class='div-second'>
                    <center><h3 style="color: black">Supprimer mon compte</h3></center>

                    <div class="div-form">
                        <div class='div-sous-form'>
                            <p class='top-p' id='utilisateur-p'>Nom d'utilisateur </p>
                            <input class="input" name="login" type="text" required="Veuillez remplir le champ">
                        </div>
                    </div>

                    <br>
                    <br>
                    <input class='input' id="button" type="submit" value="Envoyer">

                </div>
            </form>
        </div>

    </div>

    </body>
    </html>

    <?php
} else {
    header('location: ../accueil');
}
?>