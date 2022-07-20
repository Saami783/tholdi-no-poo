<?php
    include_once "_head.inc.php";
    require_once '_gestionBase.inc.php';

    if (empty($_SESSION['login']) && empty($_SESSION['codeUtilisateur']) && isset($_POST['submit']))
    {
        header('location:connexion.php');
    }else
    {
    $id = $_GET['id'];
?>

<!DOCTYPE html> <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="NoS1gnal"/>
        <title>Reservation</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    </head>
    <body>
    <div class="container-fluid">
        <br> <br> <br> <br> <br>
        <div id="lignereservation-form">

            <form action="modifierMaCommande_traitement.php?id=<?= $id; ?>" method="post">
                <h2 class="text-center">Reservation</h2>
                <div class="form-group">

                    <!-- Permet de selectionner un type de container -->
                    Type Container
                    <?php
                    $collectionTypeContainer = obtenirTypeContainer(); ?>
                    <select name="numTypeContainer" class="form-control" placeholder="login" required="required"
                            autocomplete="off">

                        <?php foreach ($collectionTypeContainer as $typeContainer): ?>
                            <option value="<?= $typeContainer["numTypeContainer"]; ?>">

                                <?= $typeContainer["libelleTypeContainer"]; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <!-- Permet de selectionner la quantité du container -->
                    Quantite
                    <br>
                    <input type="number" min="0" max="10" name="quantite" class="form-control" placeholder="Quantite" required="required"
                           autocomplete="off">


                    <input type="submit" value="Modifier ma ligne de réservation" class="form-control"
                           placeholder="Volume estimé" required="required" autocomplete="off" name="ajouterUneLigne">
            </form>
        </div>

    </body>
    <style>

        #tr{
            border: 2.5px solid #e9ecef;
        }
        .img-cart {
            display: block;
            max-width: 50px;
            height: auto;
            margin-left: auto;
            margin-right: auto;
        }
        table tr td{
            border:1px solid #FFFFFF;
        }

        table tr th {
            background:#eee;
        }

        .panel-shadow {
            box-shadow: rgba(0, 0, 0, 0.3) 7px 7px 7px;
        }


        #reservationCourante{
            width: 130px;
            margin: -450px 700px;
            border: 10px;
        }

        #lignereservation-form {
            width: 340px;
            margin: 50px 600px;
        }

        #lignereservation-form form {
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .lignereservation-form h2 {
            margin: 0 0 15px;
        }

        .form-control, .btn {
            min-height: 38px;
            border-radius: 2px;
        }

        .btn {
            font-size: 15px;
            font-weight: bold;
        }

    </style>
    </html>

<?php } ?>

