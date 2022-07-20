<?php
    include_once "_head.inc.php";
    require_once '_gestionBase.inc.php';

    if(!empty($_SESSION['login']) && !empty($_SESSION['codeUtilisateur'])){
        header('location:accueil');
    }
    else
    {
?>

<!DOCTYPE html>
    <html lang="fr">
<head>
        <meta charset="UTF-8">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"> </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"> </script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <title>Inscription</title>
</head>

  <body>
<section class="pt-5 pb-5 mt-0 align-items-center d-flex bg-dark" style="min-height: 100vh; background-size: cover; background-image: url(images/index/pex.jpg);">
        <div class="container-fluid">
          <div class="row  justify-content-center align-items-center d-flex-row text-center h-100">
            <div class="col-12 col-md-4 col-lg-3   h-50 ">
              <div class="card shadow">
                <div class="card-body mx-auto">
                  <h4 class="card-title mt-3 text-center">Inscription</h4>
                  <p class="text-center"><span id="erreur" style="color: rgb(255, 0, 0)">  </span></p>
                  <p class="text-muted font-weight-bold ">  </p>

        <form action="inscription_traitement.php" method="post" id="inscription">
            <div class="form-group">

            <!-- Saisir la raison sociale -->
            <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> <i style="font-size:13px" class="fa">&#xf1ad;</i> </span>
                  </div>

                  <input name="raisonSociale" class="form-control" placeholder="Raison Sociale" type="text" required="requirer">
                </div>

            <!-- Saisir l'adresse -->
            <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> <i style="font-size:16px" class="fa">&#xf015;</i> </span>
                  </div>

                  <input name="adresse" class="form-control" placeholder="Adresse" type="text" required="requirer">
                </div>

            <!-- Saisir le code postale -->
            <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> <i style="font-size:20px" class="fa">&#xf041;</i> </span>
                  </div>

                  <input name="cp" id="cp" class="form-control" placeholder="Code postal" type="text" required="requirer">
                </div>

             <!-- Saisir la ville -->
            <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> <i style="font-size:20px" class="fa">&#xf276;</i> </span>
                  </div>

                  <input name="ville" class="form-control" placeholder="Ville" type="text" required="requirer">
                </div>

             <!-- Saisir l'adresse mail -->
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> <i style="font-size:13px" class="fa">&#xf0e0;</i></span>
                  </div>
                  <input name="adrMel" id="mail" class="form-control" placeholder="Adresse mail" type="email" required="requirer">
                </div>


             <!-- Saisir le numéro de téléphone -->
              <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> <i style="font-size:18px" class="fa">&#xf095;</i> </span>
                  </div>

                  <input name="telephone" id="tel" class="form-control" placeholder="Téléphone" type="tel" required="requirer">
                </div>



             <!-- Saisir le contact -->
             <div class="form-group">
                <input type="contact" id="contact" name="contact" class="form-control" placeholder="contact" required="required" autocomplete="off">
            </div>


            <!-- Permet d'afficher la liste des codes de Pays et d'en selection un -->
            <?php $collectionPays = obtenirPays(); ?>
            <select name="codePaysDisposition" class="form-control"  required="required" autocomplete="off">
        <?php
             foreach($collectionPays as $pays)
             {
        ?>
            <option>
        <?= $pays['codePays'];
             }
        ?>
            </option>
            </select>
            <br/>

         <!-- Saisit du login -->
            <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                  </div>

                  <input name="login" id="login" class="form-control" placeholder="Identifiant" type="text" required="requirer">
                </div>

             <!-- Saisit du mot de passe -->
            <div class="form-group input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                  </div>
                  <input name="mdp" id="mdp" class="form-control" placeholder="Mot de passe" type="password" required="requirer">
            </div>

             <!-- Bouton valider -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Inscription</button>
            </div>

            <!-- Avoir le petit carre gris :
                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>-->

                <p class="text-center">Vous avez déjà un compte?
                  <a href="connexion">Connexion</a>
                </p>
            </div>
            </div>
              </form>
              </div>
            </div>
          </div>
        </div>
     </section>

<script src="js/inscription.js"></script>

  </body>
</html>
<?php
    }
?>




