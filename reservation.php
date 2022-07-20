<?php
    require_once '_gestionBase.inc.php';
    include_once "_head.inc.php";

    if (empty($_SESSION['login']) && empty($_SESSION['codeUtilisateur']))
    {
        header('location:connexion');
    }
    else
    {
?>

<!DOCTYPE html><html lang="fr">
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

        <title>Reservation</title>
    </head>
    <body>
<br><br><br><br>

    <div class="login-form">
        <center><p><span id="erreur" style="color: red;"> </span></p></center>
        <form action="reservation_traitement.php" method="post" id="reservation">

            Date de début reservation
            <!-- Date de début -->
            <div class="form-group input-group">
                <input name="dateDebutReservation" required="required" type="date" min="<?= date('Y-m-d', strtotime('0 day')); ?>" max="2023-12-31" class="form-control">
            </div>

            <!-- Date de fin  -->
            Date de fin reservation
            <div class="form-group input-group">
                <input name="dateFinReservation" required="required" type="date" min="<?= date('Y-m-d', strtotime('+7 day')); ?>" max="2023-12-31" class="form-control">
            </div>

            <!-- Volume estimé  -->
            <div class="form-group input-group">
                <input name="volumeEstime" required="required" type="number" min="1" max="900" placeholder="volume estimé" class="form-control">
            </div>

            <!-- Ville de départ  -->
            <?php $collectionVille = obtenirVilleDisposition(); ?>
            Ville de départ
            <select id="first" required="required" name="codeVilleMiseDisposition" class="form-control" required="required" autocomplete="off">
                <?php foreach ($collectionVille as $ville): ?>
                    <option value="<?= $ville["codeVille"]; ?>">

                        <?php echo $ville["nomVille"]; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <br>

            <!-- Ville d'arrivée  -->
            Ville d'arrivée
            <select id="second" required="required" name="codeVilleRendre" class="form-control" required="required" autocomplete="off">
                <?php foreach ($collectionVille as $ville): ?>
                    <option value="<?= $ville["codeVille"]; ?>">

                        <?php echo $ville["nomVille"]; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <br>
            <!-- Bouton valider -->
            <div class="form-group">
                <button name="submit" type="submit" class="btn btn-primary btn-block">Valider ma réservation</button>
            </div>
        </form>
    </div>

<script src="js/reservation.js"> </script>

    </body>
    </html>
<?php } ?>