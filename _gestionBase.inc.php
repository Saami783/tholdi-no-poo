<?php

function gestionnaireDeConnexion()
{

    try{
        $dsn = "mysql:host=127.0.0.1;dbname=";

        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];

        $pdo = new PDO($dsn, '', '', $options);
        return $pdo;
    }
    catch (PDOException $err)
    {
        var_dump($err);
        die;
    }
}

/**
 * @summary Ajoute un utilisateur en base de données
 * @param raisonSociale
 * @param adresse
 * @param cp
 * @param ville
 * @param adrMel
 * @param telephone
 * @param contact
 * @param codePays
 * @param login
 * @param mdpCourant
 * <returns> void </returns>
 */
function ajouterUtilisateur($raisonSociale, $adresse, $cp, $ville, $adrMel, $telephone, $contact, $codePays, $login, $mdpCourant)
{
    $pdo = gestionnaireDeConnexion();
    $mdpHash = password_hash($mdpCourant, PASSWORD_DEFAULT);
    $sql = "INSERT INTO utilisateur (raisonSociale, adresse, cp, ville, adrMel, telephone, contact, codePays, login, mdp)" .
        "VALUES ( :raisonSociale, :adresse, :cp, :ville, :adrMel, :telephone, :contact, :codePays, :login, :mdp)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'raisonSociale' => $raisonSociale,
        'adresse' => $adresse,
        'cp' => $cp,
        'ville' => $ville,
        'adrMel' => $adrMel,
        'telephone' => $telephone,
        'contact' => $contact,
        'codePays' => $codePays,
        'login' => $login,
        'mdp' => $mdpHash]);
}


/**
 * @summary Connecte un utilisateur de la base de données
 * <remarks> J'affecte le codeutilisateur et son identifiant en variable de session </remarks>
 * @param login
 * @param password
 * <returns> void </returns>
 */
function connexionUtilisateur($login, $password)
{
    $pdo = gestionnaireDeConnexion();
    $sql = "SELECT * FROM utilisateur WHERE login = :login";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'login' => $login
    ]);
    $tab = $stmt->fetch();

    if ($tab)
    {
        extract($tab);

        if (password_verify($password, $mdp)) {
            $_SESSION['login'] = $login;
            $_SESSION['codeUtilisateur'] = $codeUtilisateur;
            $authOK = true;
        } else {
            $authOK = false;
        }
    }
    if ($authOK)
    {
        header('location: accueil');
    }
    else {
        header('location: connexion?ConnexionMauvaise');
    }
}


/**
 * @summary Supprime un utilisateur en base de donneées
 * <remarks> La première requête vérifie si l'utilisateur passe bien en paramètre son login lié à son codeUtilisateur </remarks>
 * <remarks> Si c'est le cas je supprime cet utilisateur de la table utilisateur et reservation, reserver DELETE ON CASCADE </remarks>
 * @param login
 * @param id
 * <returns> void </returns>
 * <error>
 * La requête vérifie si un utilisateur a fait une résérvation, dans ce cas 1 ligne est affectée.
 * Mais si l'utilisateur n'en as pas fait mais veut quand même supprimer son compte, il ne peut pas car la requête renvoie 0
 * </error>
 * <todo> => Modifications à apporter dans cette méthode
 */
function supprimerUtilisateur($login, $id)
{
    $pdo = gestionnaireDeConnexion();

    $sql = "SELECT * FROM utilisateur WHERE login = :login AND codeUtilisateur = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'login' => $login,
        'id' => $_SESSION['codeUtilisateur']
    ]);

    if ($stmt->rowCount() != 0)
    {
        $sql2 = "DELETE utilisateur FROM utilisateur WHERE utilisateur.login = :login  AND utilisateur.codeUtilisateur = :id";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute(
            [
                "login" => $login,
                "id" => $id
            ]);
        session_destroy();
        header('location: ../accueil');
    }
    else {
        header('location: parametres?mauvaisIdentifiant');
    }
}


/**
 * @summary Change le mot de passe de l'utilisateur
 * <remarks> mdpCourant est son mot de passe saisit dans le formulaire  </remarks>
 * <remarks> nouveauMdp est son nouveau mot de passe saisit dans le formulaire </remarks>
 * <remarks> le nouveauMdp est directement hashé prêt à être mit en bdd  </remarks>
 * <remarks> si le mdpCourant correspond avec celui en bdd alors j'insère mdpCourant en bdd  </remarks>
 * @param user
 * @param mdpCourant
 * @param nouveauMdp
 * @param $odeUtilisateur
 * <returns> void </returns>
 */
function changerMdp($user, $mdpCourant, $nouveauMdp, $codeUtilisateur)
{
    $auth = false;
    $pdo = gestionnaireDeConnexion();
    $mdpHash = password_hash($nouveauMdp, PASSWORD_DEFAULT);

    $sql = "SELECT mdp FROM utilisateur WHERE login = :login AND codeUtilisateur = :codeUtilisateur";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'login' => $user,
        'codeUtilisateur' => $codeUtilisateur
    ]);
    if ($stmt->rowCount() != 0)
    {
        $tab = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($mdpCourant, $tab['mdp'])) {
            $sql2 = "UPDATE utilisateur SET mdp = :hashed";
            $stmt2 = $pdo->prepare($sql2);
            $stmt2->execute(['hashed' => $mdpHash]);
            $auth = true;
        }
        else
        {
            $auth = false;
        }
    }
    if ($auth)
    {
        header('location: parametres?MotDePasseChangeAvecSucces');
    }
    else {
        header('location: parametres?VeuillezSaisirLeBonMotDePasseOuIdentifiant');
    }
}


/**
 * @summary Change l'identifiant de l'utilisateur
 * <remarks> identifiantCourant est son login saisit dans le formulaire  </remarks>
 * <remarks> newIdentifiant est son nouveau login saisit dans le formulaire </remarks>
 * <remarks> Une 1ere requête est effectuée pour s'assurer que l'utilisateur entre un login qui correspond à son codeUtilisateur </remarks>
 * <remarks> Si  identifiantCourant correspond avec codeUtilisateur en bdd alors j'insère identifiantCourant en bdd  </remarks>
 * @param identifiantCourant
 * @param newIdentifiant
 * @param codeUser
 * <returns> void </returns>
 */
function changerPseudo($identifiantCourant, $newIdentifiant, $codeUser)
{
    $pdo = gestionnaireDeConnexion();

    $sql = "SELECT * FROM utilisateur WHERE login = :login AND codeUtilisateur = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'login' => $identifiantCourant,
        'id' => $codeUser
    ]);

    if ($stmt->rowCount() != 0)
    {
        $sql2 = "UPDATE utilisateur SET login = :newLogin WHERE login = :login";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute([
            'newLogin' => $newIdentifiant,
            'login' => $identifiantCourant
        ]);
        $_SESSION['login'] = $newIdentifiant;
        $auth = true;
        header('location: parametres?IdentifiantChangee');
    }
    else {
        $auth = false;
        header('location: parametres?LePseudoNeCorrespondPasAvecVotreSession');
    }
}


/**
 * @summary Ajoute une résérvation
 * <remarks> Je passe les dates en format date adapté pour MySQL </remarks>
 * @param dateDebutReservation
 * @param dateFinReservation
 * @param dateReservation
 * @param volumeEstime
 * @param codeVilleMiseDisposition
 * @param codeVilleRendre
 * @param etat
 * <returns> pdo </returns>
 * <remarks> Retourne le code de réservation </remarks>
 */
function ajouterUneReservation($dateDebutReservation, $dateFinReservation, $dateReservation, $volumeEstime, $codeVilleMiseDisposition, $codeVilleRendre, $codeUtilisateur, $etat, $nbJourReserve)
{
    $pdo = gestionnaireDeConnexion();
    $sql = "INSERT INTO reservation (dateDebutReservation,dateFinReservation,dateReservation,
            volumeEstime,codeVilleMiseDisposition, codeVilleRendre,codeUtilisateur,etat, nbJourReserse)
       VALUES 
            (:dateDebutReservation,:dateFinReservation,:dateReservation,
            :volumeEstime, :codeVilleMiseDisposition, :codeVilleRendre, :codeUtilisateur, :etat, :nbJourReserve)";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        "dateDebutReservation" => $dateDebutReservation,
        "dateFinReservation" => $dateFinReservation,
        "dateReservation" => $dateReservation,
        "volumeEstime" => $volumeEstime,
        "codeVilleMiseDisposition" => $codeVilleMiseDisposition,
        "codeVilleRendre" => $codeVilleRendre,
        "codeUtilisateur" => $codeUtilisateur,
        "etat" => $etat,
        'nbJourReserve' => $nbJourReserve
    ]);
    return $pdo->lastInsertId();
}


/**
 * @summary Ajoute une ligne de réservation dans la table Reserver
 * <remarks> je passe en paramètre le dernier codeReservation </remarks>
 * @param codeReservation
 * @param numTypeContainer
 * @param quantite
 * <returns> void </returns>
 */
function ajouterLigneDeReservation($codeReservation, $numTypeContainer, $quantite)
{
    $pdo = gestionnaireDeConnexion();
    $sql = "INSERT INTO reserver (codeReservation, numTypeContainer,qteReserver) 
    VALUES (:codeReservation, :numTypeContainer, :quantite)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'numTypeContainer' => $numTypeContainer,
        'quantite' => $quantite,
        'codeReservation' => $codeReservation
    ]);


}


/**
 * @summary Modifie une ligne de réservation dans la table Reserver
 * <remarks> je passe en paramètre le dernier codeReservation </remarks>
 * @param codeReservation
 * @param numTypeContainer
 * @param quantite
 * <returns> void </returns>
 */
function modifierLigneDeReservation($codeReservation, $numTypeContainer, $quantite, $idReserver)
{
    $pdo = gestionnaireDeConnexion();

    $sql = "UPDATE reserver 
            SET numTypeContainer = :numTypeContainer, qteReserver = :quantite
            WHERE idReserver = :idReserver AND codeReservation = :codeReservation";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        'numTypeContainer' => $numTypeContainer,
        'quantite' => $quantite,
        'idReserver' => $idReserver,
        'codeReservation' => $codeReservation
    ]);
}


/**
 * @summary Ajoute la date courante de la ligne de reservation ainis que le motant total dans la table devis
 * <remarks> je passe en paramètre le montant total de la reservation </remarks>
 * @param montantDevis
 * <returns> void </returns>
 */
function ajouterUnDevis($montantDevis)
{
    $dateDevis = date("Y-m-d", time());
    $pdo = gestionnaireDeConnexion();
    $sql = "INSERT INTO devis (dateDevis, montantDevis) VALUES (:dateDevis, :montantDevis)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'dateDevis' => $dateDevis,
        'montantDevis' => $montantDevis
    ]);
}


/**
 * @summary Retourne sous forme de tableau le dernier codeDevis de la table devis
 * <returns> monCodeDevis </returns>
 */
function obtenirCodeDevis(){
    $pdo = gestionnaireDeConnexion();
    $sql = "SELECT codeDevis FROM devis ORDER BY codeDevis DESC LIMIT 1";
    $stmt = $pdo->query($sql);
    $monCodeDevis = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $monCodeDevis;
}


/**
 * @summary Ajoute le codeDevis courant dans la table reservation
 * <remarks> je passe en paramètre le montant total de la reservation </remarks>
 * @param codeDevis,codeReservation
 * <returns> void </returns>
 */
function ajouterCodeDevisInReservation($codeDevis, $codeReservation)
{
    $pdo = gestionnaireDeConnexion();

    $sql = "UPDATE reservation 
            SET codeDevis = :codeDevis 
            WHERE codeReservation = :codeReservation";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'codeDevis' => $codeDevis,
        'codeReservation' => $codeReservation
    ]);
}


/**
 * @summary Retourne une ou plusieurs réservations
 * <remarks> je passe en paramètre le dernier codeReservation ainsi que l'identifiant </remarks>
 * <remarks> La fonction créer un tableau avec le codeUtilisateur & login d'un utilisateur liées aux tables </remarks>
 * <remarks> reservation, reserver, utilisateur, typeContainer, ville </remarks>
 * @param codeReservation
 * @param login
 * <returns> maReservation </returns>
 * <remarks> Retourne une collection de réservations liée à un seul codeReservation </remarks>
 */
function fetchReservation($codeReservation, $login){
    $pdo = gestionnaireDeConnexion();
    $sql = "SELECT * 
                FROM reservation,reserver,utilisateur,typecontainer,ville
                WHERE reservation.codeReservation = reserver.codeReservation 
                and reservation.codeUtilisateur = utilisateur.codeUtilisateur
                and reserver.numTypeContainer = typecontainer.numTypeContainer 
                and reservation.codeVilleRendre = ville.codeVille 
                and reservation.codeReservation = :codeReservation
                and utilisateur.login = :login";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'codeReservation' => $codeReservation,
        'login' => $login
    ]);
    $maReservation = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $maReservation;
}


/**
 * @summary Retourne le codeDuree de la table tarificationContainer
 * @param
 * <returns> lesCodesDuree </returns>
 * <remarks> Retourne ANNEE JOUR TRIMESTRE de la table tarificationcontainer </remarks>
 */
function obtenirCodeDuree(){
    $pdo = gestionnaireDeConnexion();
    $sql = "SELECT DISTINCT codeDuree FROM tarificationcontainer";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $lesCodesDuree = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $lesCodesDuree;
}


/**
 * @summary Retourne le nom de la ville et le code de la ville de la table ville
 * @param
 * <returns> lesVillesMisesADisposition </returns>
 * <remarks> Retourne une collection de ville avec codeVille et nomVille </remarks>
 */
function obtenirVilleDisposition()
{
    $pdo = gestionnaireDeConnexion();
    $sql = "SELECT codeVille, nomVille FROM ville";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $lesVillesMisesADisposition = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $lesVillesMisesADisposition;
}


/**
 * @summary Retourne toutes les informations de la table typeContainer et tarificationcontainer
 * @param
 * <returns> lesTypesDeContainer </returns>
 * <remarks> Retourne une collection de la table typeContainer
 * numTypeContainer, codeTypeContainer, libelleTypeContainer, longueurCont,
 * largeurCont ,hauteurCont, poidsCont, tare ,capaciteDeCharge
 * </remarks>
 */
function obtenirTypeContainer()
{
    $pdo = gestionnaireDeConnexion();
    $sql = "SELECT DISTINCT * 
            FROM typecontainer
            JOIN tarificationcontainer on tarificationcontainer.numTypeContainer = typecontainer.numTypeContainer
            GROUP BY tarificationcontainer.numTypeContainer";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $lesTypesDeContainer = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $lesTypesDeContainer;
}


/**
 * @summary Retourne toutes les informations de la table tarificationcontainer lié à un container
 * @param numType
 * <returns> lePrixPourLeTypeDeContainer </returns>
 * <remarks> Retourne une collection de la table tarificationcontainer
 * </remarks>
 */
function obtenirPrixContainer($numType)
{
    $pdo = gestionnaireDeConnexion();
    $sql = "SELECT DISTINCT *
          FROM tarificationcontainer WHERE numTypeContainer = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$numType]);
    $lePrixPourLeTypeDeContainer = $stmt->fetchAll();
    return $lePrixPourLeTypeDeContainer;
}


/**
 * @summary Retourne le codePays de la pays
 * @param
 * <returns> lesCodesPays </returns>
 * <remarks> Retourne un tableau de pays avec codePays</remarks>
 */
function obtenirPays()
{
    $pdo = gestionnaireDeConnexion();
    $sql = "SELECT codePays FROM pays";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $lesCodesPays = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $lesCodesPays;
}


/**
 * @summary Retourne le codeReservation de la reservation
 * <remarks> Je recupère le dernier codeReservation à partir de la session codeUtilisateur </remarks>
 * @param
 * <returns> monCodeReservation </returns>
 * <remarks> Retourne un tableau avec le dernier codeReservation d'un utilisateur</remarks>
 */
function obtenirCodeReservation()
{
    $pdo = gestionnaireDeConnexion();
    $sql = "SELECT codeReservation 
            FROM reservation 
            JOIN utilisateur 
            ON utilisateur.codeUtilisateur = reservation.codeUtilisateur 
            WHERE utilisateur.codeUtilisateur = " . $_SESSION['codeUtilisateur'] . "
            ORDER BY codeReservation DESC LIMIT 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $monCodeReservation = $stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount()>0)
    {
        return $monCodeReservation["codeReservation"];
    }

}


/**
 * @summary Retourne la ville de départ ainsi que la ville d'arrivée lié à une réservation
 * @param codeReservation
 * <returns> mesVilles </returns>
 * <remarks> Retourne un tableau avec la ville de départ et la ville d'arrivée </remarks>
 */
function afficherVilleDepartEtArrivee($codeReservation)
{
    $pdo = gestionnaireDeConnexion();
    $sql = "SELECT v1.nomville as 'VilleD', v2.nomVille as 'VilleA'
            From ville v1
            JOIN reservation r ON r.codeVilleMiseDisposition = v1.codeVille
            JOIN ville v2 ON r.codeVilleRendre = v2.codeVille
            AND r.codeReservation = :codeReservation";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['codeReservation' => $codeReservation]);
    $mesVilles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $mesVilles;
}


/**
 * @summary Permet de determiner le type d'abonnement
 * @param codeDuree
 * @param codeDuree
 * <returns> maLigneDeReservation </returns>
 * <remarks> La fonction prend en paramètre le codeDuree, soit ANNEE, JOUR ou TRIMESTRE </remarks>
 * <remarks> avec le codeReservation et retourne une collection de réservations </remarks>
 */
function afficherLigneDeReservation($codeReservation)
{
    $pdo = gestionnaireDeConnexion();
    $sql = "Select * 
            from reservation r 
            Join reserver on r.codeReservation = reserver.codeReservation 
            Join duree d on d.nbJours < r.nbJourReserse 
            Join ville v on v.codeVille = r.codeVilleMiseDisposition
            Left join duree tmp on tmp.nbJours < r.nbJourReserse 
            and tmp.nbJours > d.nbJours 
            Join tarificationcontainer on reserver.numTypeContainer = tarificationcontainer.numTypeContainer 
            and tarificationcontainer.codeDuree = d.codeDuree
            Join typecontainer t on t.numTypeContainer = tarificationcontainer.numTypeContainer
            Where tmp.nbJours is null 
            and r.codeReservation = :codeReservation;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'codeReservation' => $codeReservation
    ]);
    $maLigneDeReservation = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $maLigneDeReservation;
}


/**
 * @summary Retourne une ou plusieurs réservations liées à un utilisateur
 * @param
 * <returns> lesReservations </returns>
 * <remarks> Retourne une collection de réservations de la table reservation</remarks>
 */
function afficherReservation()
{
    $pdo = gestionnaireDeConnexion();
    $sql = "SELECT * 
         FROM reservation
         JOIN reserver r ON r.codeReservation = reservation.codeReservation
         JOIN utilisateur ON utilisateur.codeUtilisateur = reservation.codeUtilisateur
         WHERE reservation.codeUtilisateur = " . $_SESSION['codeUtilisateur'] . "
         ORDER BY reservation.codeReservation ASC";
    $pdoStatement = $pdo->query($sql);

    $lesReservations = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $lesReservations;
}

/**
 * @summary Retourne une ou plusieurs réservations liées à un utilisateur qui ne sont pas finies
 * @param
 * <returns> lesReservations </returns>
 * <remarks> Retourne une collection de réservations de la table reservation</remarks>
 */
function afficherReservationNonComplete()
{
    $pdo = gestionnaireDeConnexion();
    $sql = "SELECT reservation.codeReservation, dateDebutReservation, dateFinReservation, volumeEstime
         FROM reservation
          LEFT JOIN reserver rs on rs.codeReservation = reservation.codeReservation
         JOIN utilisateur ON utilisateur.codeUtilisateur = reservation.codeUtilisateur
          WHERE rs.codeReservation is null
          AND reservation.codeUtilisateur =  " . $_SESSION['codeUtilisateur'] . "
          ORDER BY reservation.codeReservation ASC;";
    $pdoStatement = $pdo->query($sql);

    $lesReservations = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $lesReservations;
}

/**
 * @summary Retourne une ou plusieurs lignes de réservations des tables reservation, reserver, tarificationContainer, typeContainer, ville liées à un utilisateur
 * <returns> maLigneDeReservation </returns>
 * <remarks> La fonction prend en paramètre le codeDuree, soit ANNEE, JOUR ou TRIMESTRE </remarks>
 * <remarks> avec le codeReservation et retourne une collection de réservations </remarks>
 */
function afficherToutesLesReservations()
{
    $pdo = gestionnaireDeConnexion();

    $sql = "SELECT * 
                FROM reservation,reserver,utilisateur,typecontainer,ville
                WHERE reservation.codeReservation = reserver.codeReservation 
                and reservation.codeUtilisateur = utilisateur.codeUtilisateur
                and reserver.numTypeContainer = typecontainer.numTypeContainer 
                and reservation.codeVilleRendre = ville.codeVille 
                and utilisateur.codeUtilisateur = :codeUtilisateur";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'codeUtilisateur' => $_SESSION['codeUtilisateur']
    ]);
    $maReservation = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $maReservation;
}


/**
 * @summar La fonction vérifie si dans la table reserver il n'y a qu'une seule ligne de reservation lié à un codeReservation
 * @param idReserver
 * <returns> boolean dernierLigne </returns>
 * <remarks> La fonction prend en paramètre le codeDuree, soit ANNEE, JOUR ou TRIMESTRE </remarks>
 */
function estLaDerniereLigneDeReservation($idReserver)
{
    $derniereLigne = false;
    $pdo = gestionnaireDeConnexion();
    $sql = "SELECT * FROM reserver WHERE codeReservation = :idReserver";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['idReserver' => $idReserver]);

    if($stmt->rowCount() == 0) {
    return $derniereLigne = false;
    }
    else if ($stmt->rowCount() >= 2) {
        return $derniereLigne = false;
    }
    else{
        return $derniereLigne = true;
    }
}


/**
 * @summary Retourne toutes les données d'un utilisateur avec sa session codeUtilisateur
 * @param
 * <returns> lesUtilisateurs </returns>
 */
function afficherUtilisateur()
{
    $pdo = gestionnaireDeConnexion();
    $sql = "SELECT * 
          FROM utilisateur 
          WHERE utilisateur.codeUtilisateur = " . $_SESSION['codeUtilisateur'] . " 
          ORDER BY codeUtilisateur ASC";

    $pdoStatement = $pdo->query($sql);
    $lesUtilisateurs = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $lesUtilisateurs;
}


/**
 * @summary Supprime les données des tables reservation et reserver liè à un codeReservation
 * @param codeReservationASupprimer
 * @param codeUtilisateur
 * <returns>  </returns>
 */
function supprimerUneReservation($codeReservationASupprimer, $codeUtilisateur)
{
    $pdo = gestionnaireDeConnexion();
    $sql = "DELETE FROM reservation WHERE codeReservation = :codeReservationASupprimer AND codeUtilisateur = :codeUtilisateur";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        [
        'codeReservationASupprimer' => $codeReservationASupprimer,
        'codeUtilisateur' => $codeUtilisateur
        ]);
    if($stmt->rowCount() != 0){
        header('location: mesReservations?SuppressionEffectue');
    }else{
        header('location: mesReservations?AucuneReservationLieeACeCompte');
    }
}

/**
 * @summary Supprime les données des tables reservation et reserver liè à une ligne de reservation
 * @param codeLigneDeReservation
 * <returns>  </returns>
 */
function supprimerUneLigneDeReservation($codeLigneDeReservation)
{
    $pdo = gestionnaireDeConnexion();
    $sql = "DELETE from reserver WHERE idReserver = :idReserver";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['idReserver' => $codeLigneDeReservation]);
}