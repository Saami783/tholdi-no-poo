<?php
    require_once '_gestionBase.inc.php';
    include_once "_head.inc.php";
    if (!empty($_SESSION['login']) && !empty($_SESSION['codeUtilisateur']))
    {
        header('location:accueil');
    }
    else{
?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="NoS1gnal"/>

        <link rel="stylesheet" href="css/connexion_bootstrap.css" media="screen">
        <link rel="stylesheet" href="css/connexion.css" media="screen">

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet"
              type="text/css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet"
              type="text/css">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

        <title>Connexion</title>
    </head>
    <body>

    <section class="pt-5 pb-5 mt-0 align-items-center d-flex bg-dark"
             style="min-height: 100vh; background-size: cover; background-image: url(images/index/ville-port.jpg);">
        <div class="container-fluid">
            <div class="row  justify-content-center align-items-center d-flex-row text-center h-100">
                <br/> <br/> <br/> <br/> <br/> <br/> <br/>
                <div class="login-form">

            <?php
                if (isset($_GET['ConnexionMauvaise']))
                {
                echo "<center><p style=\"color:red; background-color: black;\"> Mot de passe incorrect. </p></center>";
            }?>

                    <form method="post" action="connexion_traitement.php">

                        <!-- Saisit du login -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="login" class="form-control" placeholder="Identifiant" type="text">
                        </div>

                        <!-- Saisit du mot de passe -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input name="mdp" class="form-control" placeholder="Mot de passe" type="password">
                        </div>

                        <!-- Bouton valider -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
                        </div>
                        <p class="text-center" style='color:white'>Vous n'avez pas encore de compte ?
                            <a href="inscription">Inscription</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    </body>
    </html>

<?php
    }
?>