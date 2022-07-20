<?php
    include_once "_head.inc.php";
    require_once '_gestionBase.inc.php';

    if (empty($_SESSION['login']) && empty($_SESSION['codeUtilisateur']) && isset($_POST['submit']))
    {
        header('location:connexion.php');
    }else{
?>
<!DOCTYPE html><html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="NoS1gnal"/>
        <title>Reservation</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/saisirLigneDeReservation.css">
        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    </head>
    <body>
    <div class="container-fluid">
    <br> <br> <br> <br> <br>
    <div id="lignereservation-form">

        <form action="saisirLigneDeReservation_traitement.php" method="post">
            <h2 class="text-center">Reservation</h2>
            <div class="form-group">

                <!-- Permet de selectionner un type de container -->
                Type Container
                <?php
                    $collectionTypeContainer = obtenirTypeContainer(); ?>
                    <select name="numTypeContainer" class="form-control" placeholder="login" required="required" autocomplete="off">
                        <?php
                            foreach ($collectionTypeContainer as $typeContainer): ?>
                                <option value="<?= $typeContainer["numTypeContainer"]; ?>">
                                    <?= $typeContainer["libelleTypeContainer"]; ?>
                                </option>
                        <?php
                            endforeach;
                        ?>
                    </select>

                <!-- Permet de selectionner la quantité du container -->
                Quantite
                <br>
                <input type="number" min="0" max="10" name="quantite" class="form-control" placeholder="Quantite" required="required"
                       autocomplete="off">
                <input type="submit" value="Ajouter une ligne de réservation" class="form-control"
                       placeholder="Volume estimé" required="required" autocomplete="off" name="ajouterUneLigne">
        </form>
    <br>

        <form action="finaliserReservation_traitement.php" method="post">
            <input type="submit" value="Finaliser la réservation" class="form-control" placeholder="Volume estimé"
               required="required" autocomplete="off">
        </form>
    </div>

        <div id="reservationCourante">
            <a href="">Mes réservations</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ville</th>
                            <th>Container</th>
                            <th>Durée</th>
                            <th>Quantité </th>
                            <th>Prix</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                    $codeReservation = obtenirCodeReservation();
                    $total = null;
                    $collectionLigneDeReservation = afficherLigneDeReservation($codeReservation);
                    foreach ($collectionLigneDeReservation as $lesLignesDeReservation): ?>
                    <tr id="tr">
                        <td> <?= $lesLignesDeReservation['nomVille'] ?> </td>
                        <td> <?= $lesLignesDeReservation['libelleTypeContainer'] ?> </td>
                        <td><strong><center> <?= $lesLignesDeReservation['nbJourReserse']; ?></center></strong><p></p></td>
                        <td>
                            <form class="form-inline">
                                <a> <?= $lesLignesDeReservation['qteReserver'] ?> </a>
                            </form>
                        </td>
                        <?php
                        $prixContainer = $lesLignesDeReservation['tarif'] * $lesLignesDeReservation['nbJourReserse'] * $lesLignesDeReservation['qteReserver'];

                        ?>
                        <td><center><?= $prixContainer; ?>€</center></td>
                    </tr>
                    <?php
                        $total += $prixContainer;

                    endforeach;
                    $_SESSION['total'] = $total;
                    ?>

                    <tr>
                        <td colspan="4" class="text-right"><strong>Total</strong></td>
                        <td><center><?= $total; ?>€</center></td>
                    </tr>
                    </tbody>
                </table>
            <?php if(isset($lesLignesDeReservation)){
                echo "<a href=\"fpdf.php\"> Télécharger le devis </a>";
            }else{

            }?>

        </div>



    </body>
</html>

<?php } ?>

