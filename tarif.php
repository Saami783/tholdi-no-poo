<?php
include_once "_head.inc.php";


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="tarifs.css">
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

<br><br>
<br><br>
<div class="container">
    | <a href="#">Nombre de containers Dry Freigh <span class="badge">3</span> </a> <br>
    | <a href="#">Nombre de containers taille Flat Rack <span class="badge">3</span></a> <br>
    | <a href="#">Nombre de containers taille Reefer <span class="badge">3</span></a>
</div>
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--   Debut tableau  -->

<br>
<div class="container">
    <table width=100% border="2" align="center" cellpadding="1">
        <tr>
            <td rowspan=3><center>TYPE CONTAINER</center></td>
            <td rowspan=2><center>TAILLE</center></td>
            <td  width=56% colspan=3><center>TARIF</center></td>
        <tr>
            <td width=11%><center>JOUR</center></td>
            <td><center>TRIMESTRE</center></td>
            <td width=23%><center>ANNUEL</center></td>
        </tr>
    </table>
</div>



<div class="container">
    <table width=100% border="2" align="center" cellpadding="1">
        <tr>
            <td width=29% >Classique</td>
            <td width=15% rowspan=5><center>20’ x 8’ x 8’6’’ </center></td>
            <td width=11%>8 €</td>
            <td>585 €  (6.50 €/J)</td>
            <td>1260 €  (3.50 €/J)</td>

        </tr>
        <tr>
            <td>Reefer</td>
            <td>11 €</td>
            <td>765 €  (8.50 €/J)</td>
            <td>2190 €  (6 €/J)</td>

        </tr>
        <tr>
            <td >Tank</td>
            <td>9.50 €</td>
            <td>630 €  (7 €/J)</td>
            <td>2160 €  (5 €/J)</td>

        </tr>
        <tr>
            <td>Open Top</td>
            <td>9 €</td>
            <td>585 €  (6.50 €/J)</td>
            <td>1620 €  (4.50 €/J)</td>
        </tr>

        <tr>
            <td>Flat-Rack</td>
            <td>9 €</td>
            <td>585 €  (6.50 €/J)</td>
            <td>1620 €  (4.50 €/J)</td>

        </tr>
    </table>
</div>


<div class="container">
    <table width=100% border="2" align="center" cellpadding="1">
        <tr>
            <td width=29% >Classique</td>
            <td width=15% rowspan=5><center>40’ x 8’ x 8’6’’</center></td>
            <td>9.25 €</td>
            <td>623.70 € (6.93 €/J)</td>
            <td>1663.20 € (4.62 €/J)</td>

        </tr>
        <tr>
            <td>Reefer</td>
            <td>14 €</td>
            <td>990 € (11 €/J)</td>
            <td>3510 € (9.75 €/J)</td>

        </tr>
        <tr>
            <td>Tank</td>
            <td>11 €</td>
            <td>810 € (9 €/J)</td>
            <td>2520 € (7 €/J)</td>

        </tr>

        <tr>
            <td>Open Top</td>
            <td>10 €</td>
            <td>765 € (8.50 €/J)</td>
            <td>2700 € (7.50 €/J)</td>
        </tr>

        <tr>
            <td>Flat-Rack</td>
            <td>10 €</td>
            <td>765 € (8.50 €/J)</td>
            <td>2700 € (7.50 €/J)</td>

        </tr>

    </table>
</div>

<div class="container">
    <table width=100% border="2" align="center" cellpadding="1" >

        <tr>
            <td width=29% >Classique</td>
            <td width=15% rowspan=3><center>40’ x 8’ x 9’6’’</center></td>
            <td>10 €</td>
            <td>765 € (8.50 €/J)</td>
            <td>2700 € (7.50 €/J)</td>

        </tr>
        <tr>
            <td>Reefer</td>
            <td>15 €</td>
            <td>1080 € (12 €/J)</td>
            <td>3600 € (10 €/J)</td>

        </tr>
        <tr>
            <td>Tank</td>
            <td>12 €</td>
            <td>900 € (10 €/J)</td>
            <td>2880 € (8 €/J)</td>
        </tr>

    </table>
</div>

<!--   Fin tableau -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--   Debut accordion 1 -->



<!--   Debut accordion container classique-->

<div class="container-fluid">
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">

            <div id="collapse1" class="panel-collapse collapse in">
                <div class="panel-body">
                    <div id="pricing" class="container-fluid">
                        <div class="text-center">
                            <h2>Choisissez le container qui vous convient !</h2>
                            <br>
                        </div>
                        <!--- heeeeeeeeeeeeeeeeeeee!-->

                        <?php
                        $collectionTypeContainers = obtenirTypeContainer();
                        foreach($collectionTypeContainers as $unContainer):
                        ?>
                        <div class="row slideanim container-fluid">
                            <div class="col-sm-4 col-xs-12">
                                <div class="panel panel-default text-center">
                                    <div class="panel-heading">
                                        <h1><?= $unContainer['libelleTypeContainer']; ?></h1>
                                    </div>
                                    <div class="panel-body">
                                        <p>
                                        </p>
                                        <p>
                                            <strong>TARIF :</strong>
                                        </p>
                                        <p>
                                            <?php
                                            $prices = obtenirPrixContainer($unContainer['numTypeContainer']);
                                            foreach ($prices as $price)
                                            {
                                                ?>
                                                Par <?= $price['codeDuree']; ?> : <strong> <?= $price['tarif'] . " € <br>"; ?> </strong>
                                                <?php
                                            }
                                            ?>
                                        </p>
                                        <p>

                                        <p>
                                        <h3><strong> TAILLE : </strong> </h3>
                                        <p>
                                        <h5> Longueur : <?= $unContainer['longueurCont']; ?> <br>
                                            Largeur : <?= $unContainer['largeurCont']; ?> <br>
                                            Hauteur : <?= $unContainer['hauteurCont']; ?> </h5>
                                        </h5>
                                    </div>
                                    <div class="panel-footer">
                                        <br>
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
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--   Debut des images -->

<!--   Debut image 1 -->

<br> <br><br> <br><br> <br>
<div class="col-sm-4 container-fluid text-center">
    <div class="row text-center slideanim">
        <div class="thumbnail">
            <img src="images/Tarifs/Bulk.PNG" alt="html" width="400" height="300">
            <h2>Bulkliners/Linerbags</h2>
            <p>Installation et mise à disposition de conteneurs maritimes sur les aires de stockage</p>
        </div>
    </div>
</div>

<!-- Fin image 1 -->

<!--   Debut image 2 -->

<div class="col-sm-4 container-fluid text-center">
    <div class="row text-center slideanim">
        <div class="thumbnail">
            <img src="images/Tarifs/Flexitank.PNG" alt="html" width="400" height="300">
            <h2>Flexitank</h2>
            <p>Transport de liquides en vrac non dangereux. Le Flexitank est une poche en plastique flexible qui
                s'installe dans un container.</p>

        </div>
    </div>
</div>

<!-- Fin image 2 -->

<!--   Debut image 3 -->

<div class="col-sm-4 container-fluid text-center">
    <div class="row text-center slideanim">
        <div class="thumbnail">
            <img src="images/Tarifs/Reefer.PNG" alt="html" width="400" height="300">
            <h2>Reefer</h2>
            <p>Les conteneurs réfrigérés, également appelés conteneurs frigorifiques, sont utilisés pour les
                marchandises qui doivent être contrôlées en température pendant l’expédition.
                Les conteneurs frigorifiques sont équipés d’une unité de réfrigération connectée à l’alimentation
                électrique à bord du navire.
                Stocker et réparation de conteneurs frigorifiques</p>
        </div>
    </div>
</div>

<!-- Fin image 3 -->

<!--   Debut image 4 -->

<div class="col-sm-4 container-fluid text-center">
    <div class="row text-center slideanim">
        <div class="thumbnail">
            <img src="images/Tarifs/SPDA.PNG" alt="html" width="400" height="300">
            <h2>Services pièces détachées et accessoires</h2>
        </div>
    </div>
</div>
</div>

</body>
</html>