document.getElementById('reservation').addEventListener("submit", function(e){

    var erreur;

    var villeDisposition = document.getElementById('first');
    var villeRendre = document.getElementById('second');

    // Je vérifie si l'utilisateur a saisi 2 fois la même ville
    if(villeDisposition.value == villeRendre.value){
        e.preventDefault();
        erreur = "Vous ne pouvez pas choisir la même ville de départ et d'arrivée.";
    }

    if(erreur)
    {
        e.preventDefault();
        document.getElementById('erreur').innerHTML = erreur;
        return false;
    }else{
        return true;
    }

})





