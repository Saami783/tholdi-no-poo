
document.getElementById('inscription').addEventListener("submit", function(e){

    // La regex permet d'accepter l'alphabet en minuscule et majuscule et chiffre
    let myRegexLogin = /^[a-zA-Z].{4,20}$/;

    // Regex mdp Au moins 1 chiffre, au moins 1 caractère spécial, au moins 1 caractère alphabétique, aucun espace vide
    let myRegexMdp = /^(?=.*\d)(?=(.*\W){1})(?=.*[a-zA-Z])(?!.*\s).{8,20}$/;

    // Regex numéro de téléphone français
    let myRegexTel = /^((\+|00)33\s?|0)[67](\s?\d{2}){4}$/;

    // Regex code postal
    var regexCp = /^(([0-8][0-9])|(9[0-5]))[0-9]{3}$/;

    // Regex email
    var regexMail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    var erreur;

    var cp = document.getElementById('cp');
    var mail = document.getElementById('mail');
    var tel = document.getElementById('tel');
    var contact = document.getElementById('contact');
    var login = document.getElementById('login');
    var mdp = document.getElementById('mdp');

    //Vérifie la regex de l'identifiant
    if(myRegexLogin.test(login.value) == false ){
        e.preventDefault();
        erreur = "L'identifiant doit être comprit entre 5 à 20 caractères et ne doit pas avoir de caractères spéciaux.";
    }

    //Vérifie la regex du mot de passe
    if(myRegexMdp.test(mdp.value) ==  false){
        e.preventDefault();
        erreur = "Le mot de passe doit être comprit entre 8 à 20 caractères et doit comporter au moins un chiffre et un caractère spéciale.";
    }

    if(myRegexTel.test(tel.value) == false){
        e.preventDefault();
        erreur = "Merci d'entrer un numéro de téléphone français valide.";
    }

    if(regexCp.test(cp.value) ==  false){
        e.preventDefault();
        erreur = "Merci d'entrer un code postal français valide.";
    }

    if(regexMail.test(mail.value) ==  false){
        e.preventDefault();
        erreur = "Merci d'entrer une adresse mail valide.";
    }

    if(erreur){
        e.preventDefault();
        document.getElementById('erreur').innerHTML = erreur;
        return false;
    }else{
        return true;
    }


})





