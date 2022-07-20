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
        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" integrity="sha384-ejwKkLla8gPP8t2u0eQyL0Q/4ItcnyveF505U0NIobD/SMsNyXrLti6CWaD0L52l" crossorigin="anonymous">

        <title>Mes Reservations</title>
    </head>
<body>

<br><br><br><br>

<form action="supprimerReservation.php" method="POST" id="supprimerReservation">
    <p> Supprimer une réservation complète :
        <input name="codeReservationASupprimer" id="supprimerMaLigneDeReservation" placeholder="numéro de reservation" type="number">
        <button class="btn btn-primary" rel="tooltip">
          <i class="fa fa-trash-o" style="font-size:12px"></i>
        </button>
    </p>
    <span id=""></span>
</form>

<br>

<?php
    if (isset($_GET['SuppressionEffectue']))
    {
        echo "<center><p style=\"color:red;\"> Suppression effectuée </p></center>";
    }
    if(isset($_GET['AucuneReservationLieeACeCompte']))
    {
        echo "<center><p style=\"color:red;\"> Aucune reservation avec ce numéro n'est liée à ce compte </p></center>";
    }
?>

<form action="" method="POST">
    <p> Chercher une réservation :
        <input name="codeReservation" placeholder="numéro de reservation" type="number">
        <button class="btn btn-primary" type="submit">
            <i class="fa fa-search fa-fw" style="font-size:12px"></i>
        </button>
    </p>
</form>

<?php

    // Permet de chercher une réservation en particulier
    if(isset($_POST['codeReservation']))
    {
        $codeReservation = $_POST['codeReservation'];
        $fetchReservation = fetchReservation($codeReservation, $_SESSION['login']);
    }

    if(empty($codeReservation))
    {
        echo "<center><h4 style='color: red;'>Tableau de vos réservations<h4></center>";
    }
    else
    {
?>

<div id="reservationCourante">
    <table class="table">
        <thead>
            <tr>
                <th>Numéro de réservation</th>
                <th>dateDebutReservation</th>
                <th>dateFinReservation</th>
                <th>dateReservation</th>
                <th>Volume estimé</th>
                <th>Numéro devis</th>
                <th>État </th>
                <th>Quantité</th>
                <th>Nom du container</th>
                <th>Longueur container</th>
                <th>Largeur container</th>
                <th>Hauteur container</th>
                <th>nomVille</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $estPaire = 1;
                foreach ($fetchReservation as $maRechercheDeReservation):
            $estPaire ++;
            if($estPaire % 2){
            $maCouleur = "background-color: white;";
            }else{
            $maCouleur = "background-color: #E0E0E0;";
            }
            ?>
            <tr style="<?= $maCouleur;?>">
                        <td><center> <?= $maRechercheDeReservation['codeReservation']; ?> </center></td>
                        <td><center> <?= $maRechercheDeReservation['dateDebutReservation']; ?> </center></td>
                        <td><center> <?= $maRechercheDeReservation['dateFinReservation']; ?> </center></td>
                        <td><center> <?= $maRechercheDeReservation['dateReservation']; ?> </center></td>
                        <td><center> <?= $maRechercheDeReservation['volumeEstime']; ?> </center></td>
                        <td><center> <?= $maRechercheDeReservation['codeDevis']; ?> </center></td>
                        <td><center> <?= $maRechercheDeReservation['etat']; ?> </center></td>
                        <td><center> <?= $maRechercheDeReservation['qteReserver']; ?> </center></td>
                        <td><center> <?= $maRechercheDeReservation['libelleTypeContainer']; ?> </center></td>
                        <td><center> <?= $maRechercheDeReservation['longueurCont']; ?> </center></td>
                        <td><center> <?= $maRechercheDeReservation['largeurCont']; ?> </center></td>
                        <td><center> <?= $maRechercheDeReservation['hauteurCont']; ?> </center></td>
                        <td><center> <?= $maRechercheDeReservation['nomVille']; ?> </center></td>
                        <td><center> <?= $maRechercheDeReservation['tare']; ?> </center></td>
                    </tr>
        </tbody>
            <?php
                endforeach;
            ?>
    </table>
</div>

<?php }
    $codeReservation = obtenirCodeReservation();
?>

    <!-- Tableau de toutes les réservations d'un utilisateur -->
<div id="reservationCourante">
    <br> <br>
    <a href="">Mes réservations</a>
    <table class="table">
        <thead>
            <tr>
                <th>Numéro de réservation</th>
                <th>dateDebutReservation</th>
                <th>dateFinReservation</th>
                <th>dateReservation</th>
                <th>Volume estimé</th>
                <th>Numéro devis</th>
                <th>État </th>
                <th>Quantité</th>
                <th>Nom du container</th>
                <th>Longueur container</th>
                <th>Largeur container</th>
                <th>Hauteur container</th>
                <th>Ville départ</th>
                <th>Ville d'arrivée</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $estPaire = 1;
            $collectionReservation = afficherToutesLesReservations();
            foreach ($collectionReservation as $lesLignesDeReservation):
        $estPaire ++;
        if($estPaire % 2){
            $maCouleur = "background-color: white;";
        }else{
            $maCouleur = "background-color: #E0E0E0;";
        }
        ?>
                <tr style="<?= $maCouleur;?>">
                    <td><center> <?= $lesLignesDeReservation['codeReservation']; ?> </center></td>
                    <td><center> <?= $lesLignesDeReservation['dateDebutReservation']; ?> </center></td>
                    <td><center> <?= $lesLignesDeReservation['dateFinReservation']; ?> </center></td>
                    <td><center> <?= $lesLignesDeReservation['dateReservation']; ?> </center></td>
                    <td><center> <?= $lesLignesDeReservation['volumeEstime']; ?> </center></td>
                    <td><center> <?= $lesLignesDeReservation['codeDevis']; ?> </center></td>
                    <td><center> <?= $lesLignesDeReservation['etat']; ?> </center></td>
                    <td><center> <?= $lesLignesDeReservation['qteReserver']; ?> </center></td>
                    <td><center> <?= $lesLignesDeReservation['libelleTypeContainer']; ?> </center></td>
                    <td><center> <?= $lesLignesDeReservation['longueurCont']; ?> </center></td>
                    <td><center> <?= $lesLignesDeReservation['largeurCont']; ?> </center></td>
                    <td><center> <?= $lesLignesDeReservation['hauteurCont']; ?> </center></td>
                    <?php
                    $mesVilles = afficherVilleDepartEtArrivee($lesLignesDeReservation['codeReservation']);
                    foreach ($mesVilles as $villes): ?>
                    <td><center> <?= $villes['VilleD']; ?> </center></td>
                    <td><center> <?= $villes['VilleA']; ?> </center></td>
                   <?php endforeach; ?>
                    <td><a href="modifierMaCommande.php?id=<?= $lesLignesDeReservation['idReserver'];?>">
                        <button class="btn btn-primary" rel="tooltip">
                            <span class="glyphicon">&#x270f; </span>
                        </button>
                     </td></a>
                     <td><a href="supprimerLigneDeReservation.php?id=<?= $lesLignesDeReservation['idReserver'];?>">
                         <button class="btn btn-primary" rel="tooltip">
                             <i class="fa fa-trash-o" style="font-size:12px"></i>
                        </button>
                     </td></a>
                </tr>
        </tbody>
        <?php endforeach; ?>
    </table>
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
            margin: 60px 0px;
            border: 10px;
        }

        #lignereservation-form {
            width: 340px;
            margin: 50px 50px;
        }

        #lignereservation-form form {
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }
    </style
    </html>
<?php
    }
?>