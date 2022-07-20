<?php
    include_once "_head.inc.php";
    require_once '_gestionBase.inc.php';

    if (empty($_SESSION['login']) && empty($_SESSION['codeUtilisateur']))
    {
        header('location:connexion.php');
    }else
    {
?>

    <html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
    <br><br><br><br>

<div class="container-fluid">
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div id="collapse1" class="panel-collapse collapse in">
                <div class="panel-body">
                    <div id="pricing" class="container-fluid">
                        <div class="text-center">
                            <h2>Mes résérvations</h2>
                            <br>
                        </div>

                    <?php
                        $codeReservation = obtenirCodeReservation();

                        $collectionReservation = afficherReservation();
                        foreach ($collectionReservation as $lesReservation):
                    ?>

        <!-- Reservation non complète -->
            <div id="pricing" class="container-fluid">
                <div class="text-center">
                    <br>
                </div>

            <div class="row slideanim container-fluid">
                <div class="col-sm-4 col-xs-12">
                    <div class="panel panel-default text-center">
                        <div class="panel-heading">
                        </div>
                    <div class="panel-body">

                        <!-- Affiche la date de début de la réservation -->
                        <p>Date Debut Reservation : <?= $lesReservation["dateDebutReservation"]; ?> </p>

                         <!-- Affiche la date de fin de la réservation -->
                            <p> Date fin Reservation : <?= $lesReservation["dateFinReservation"]; ?> </p>

                        <!-- Affiche le volume estimé de la réservation -->
                            <p> Volume Estime : <?= $lesReservation["volumeEstime"]; ?> kg </p>

                        <?php
                        $villesDep = afficherVilleDepartEtArrivee($lesReservation['codeReservation']);
                        foreach ($villesDep as $lesVilles):
                            ?>
                            <p> Ville de départ : <?= $lesVilles['VilleD']; ?> </p>
                            <p> Ville d'arrivée : <?= $lesVilles['VilleA']; ?> </p>
                        <?php
                        endforeach;
                        ?>

                        <!-- Affiche le numéro réservation -->
                            <p> Numéro de Réservation : <?=  $lesReservation["codeReservation"]; ?> </p>
                    </div>

                    <div class="panel-footer">
                        <a href="mesReservations"> Voir ma commande en détail.</a>
                    </div>
                    </div>
                </div>
                <?php
                    endforeach;
                ?>
            </div>
            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container-fluid">
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div id="collapse1" class="panel-collapse collapse in">
                <div class="panel-body">
                    <div id="pricing" class="container-fluid">
                        <div class="text-center">
                            <h2>Mes réservations incomplète</h2>
                            <br>
                        </div>

                        <?php
                        $codeReservation = obtenirCodeReservation();

                        $collectionReservationNonComplete = afficherReservationNonComplete();
                        foreach ($collectionReservationNonComplete as $lesReservation):
                        ?>

                        <!-- Reservation non complète -->
                        <div id="pricing" class="container-fluid">
                            <div class="text-center">
                                <br>
                            </div>

                            <div class="row slideanim container-fluid">
                                <div class="col-sm-4 col-xs-12">
                                    <div class="panel panel-default text-center">
                                        <div class="panel-heading">
                                        </div>
                                        <div class="panel-body">

                                            <!-- Affiche la date de début de la réservation -->
                                            <p>Date Debut Reservation : <?= $lesReservation["dateDebutReservation"]; ?></p>

                                                <!-- Affiche la date de fin de la réservation -->
                                            <p> Date fin Reservation :<?= $lesReservation["dateFinReservation"]; ?> </p>

                                            <!-- Affiche le volume estimé de la réservation -->
                                            <p> Volume Estime : <?= $lesReservation["volumeEstime"]; ?> kg </p>

                                            <?php
                                            $villesDep = afficherVilleDepartEtArrivee($lesReservation['codeReservation']);
                                            foreach ($villesDep as $lesVilles)
                                            {
                                                ?>
                                                <p> Ville de départ : <?= $lesVilles['VilleD']; ?> </p>
                                                <p> Ville d'arrivée : <?= $lesVilles['VilleA']; ?> </p>
                                                <?php
                                            }
                                            ?>

                                            <!-- Affiche le numéro réservation -->
                                            <p> Numéro de Réservation : <?=  $lesReservation["codeReservation"]; ?> </p>

                                        </div>

                                        <div class="panel-footer">
                                            <a href="mesReservations"> Completer ma commande.</a>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                endforeach;
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    </body>
    </html>

    <?php
        }
    ?>