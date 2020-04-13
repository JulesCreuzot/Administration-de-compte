let identifiant;
let messageConnexion;
let psswd;
let messagePsswd;

let inscriptionMail;
let inscriptionMsgMail;
let inscriptionConfirmerMail;
let inscriptionMsgConfirmMail;
let inscriptionPassword;
let inscriptionMsgPassword;
let inscriptionConfirmerPassword;
let inscriptionMsgConfirmPassword;
let msgInscription;


// ----------------------------------------------------------------------------------//
//              Récupération des information donc nous avons besoins                 //
// ----------------------------------------------------------------------------------//

$(function () {
    identifiant = document.getElementById('identifiant');
    messageConnexion = document.getElementById('messageConnexion');
    psswd = document.getElementById('psswd');
    messagePsswd = document.getElementById('messageMotDePasse');

    inscriptionMail = document.getElementById('inscriptionMail');
    inscriptionMsgMail = document.getElementById('msgInscriptionMail');
    inscriptionConfirmerMail = document.getElementById('inscriptionMsgConfirmMail');
    inscriptionMsgConfirmMail = document.getElementById('msgInscriptionConfirmMail');
    inscriptionPassword = document.getElementById('inscriptionPassword');
    inscriptionMsgPassword = document.getElementById('msgInscriptionPswd');
    inscriptionConfirmerPassword = document.getElementById('inscriptionConfirmerPassword');
    inscriptionMsgConfirmPassword = document.getElementById('inscriptionMsgConfirmPassword');
    msgInscription = document.getElementById('msgInscription');

    document.getElementById('btnConnexion').onclick = connexion;
    document.getElementById('btnInscription').onclick = inscription;
});

// ----------------------------------------------------------------------------------//
//                         Gestion de la connexion                                   //
// ----------------------------------------------------------------------------------//

function connexion() {
    let mailOk = controler(identifiant, messageConnexion);
    let mdpOk = controler(psswd, messagePsswd);
    if (mailOk && mdpOk) {
        connecter();
    }
}

function connecter() {
    $.ajax({
        url: "content/ajax/identification.php",
        type: 'post',
        data: {identifiant: identifiant.value, psswd: psswd.value},
        dataType: "json",
        success : function(data) {
            if (data == 1){
                //Connexion réussi, lancement, reset du compteur de tentatives
                resetnbtentatives();
            }
            else if (data == 2) {
                //Connexion bonne mais, compte bloqué
                Std.afficherMessage("msgConnexion", "Votre compte est bloquer, merci de contacter un Administrateur", "rouge", 0)
            }
            else if (data == 3) {
                //Toute les tentatives on été faite, lancement de la MAJ du status à bloquer
                bloquercompte();
                Std.afficherMessage("msgConnexion", "Votre compte est bloquer, merci de contacter un Administrateur", "rouge", 0)
            }
            else
                //Rien ne va
                Std.afficherMessage("msgConnexion", "Email ou mot de passe incorrect", "rouge", 0)
        },
        error: function (request) {
            $.dialog({title: '', content: request.responseText, type: 'red'});
        }
    });
}
function bloquercompte() {
    $.ajax({
        url: "content/ajax/bloquercompte.php",
        type: 'post',
        data: {identifiant: identifiant.value}
    })
}
function resetnbtentatives() {
    $.ajax({
        url: "content/ajax/resetnbtentatives.php",
        type: 'post',
        data: {identifiant: identifiant.value},
        dataType: "json",
        success : function (data) {
            if (data === 1) {
                //Std.afficherMessage("msgConnexion", "Connexion Réussi", "vert", 0);
                location.assign('index.php');
            }
        }
    })
}

// ----------------------------------------------------------------------------------//
//                         Gestion de l'inscription                                  //
// ----------------------------------------------------------------------------------//

function inscription() {
    let mailPasVide = controler(inscriptionMail, inscriptionMsgMail);
    let mailConfirmPasVide = controler(inscriptionConfirmerMail, inscriptionMsgConfirmMail);
    let mdpPasVide = controler(inscriptionPassword, inscriptionMsgPassword);
    let mdpConfirmPasVide = controler(inscriptionPassword, inscriptionMsgConfirmPassword);
    if (mailPasVide || mailConfirmPasVide || mdpPasVide || mdpConfirmPasVide)
    {
        creercompte();
    }
}

function creercompte() {
    $.ajax({
        url: "content/ajax/inscription.php",
        type: 'post',
        data: {
            inscriptionMail: inscriptionMail.value,
            inscriptionConfirmerMail: inscriptionConfirmerMail.value,
            inscriptionPassword : inscriptionPassword.value,
            inscriptionConfirmerPassword: inscriptionConfirmerPassword.value
        },
        dataType: "json",
        success : function(data) {
            if (data == 1){
                // Si les mails ne correspondent pas
                inscriptionMsgConfirmMail.innerText = "Les Email ne correspondent pas";
            }
            else if (data == 2){
                //Si les mots de passe ne correspondent pas
                inscriptionMsgConfirmPassword.innerText = "Les mots de passe ne correspondent pas";
            }
            else if (data == 3){
                //Le format de mail n'est pas bon
                Std.afficherMessage("msgInscription", "Le format de mail n'est pas bon", "rouge", 0);
            }
            else if (data == 4){
                //Le mot de passe doit être entre 4 et 16 caractères
                Std.afficherMessage("msgInscription", "Le mot de passe doit contenir entre 4 et 16 caractères", "rouge", 0);
            }
            else if (data == 5){
                Std.afficherMessage("msgInscription", "Compte déjà existant", "rouge", 0);
            }
            else if (data == 6) {
                Std.afficherMessage("msgInscription", "Inscription réussi, vous pouvez vous connectez", "vert", 0);
            }
        },
        error: function (request) {
            $.dialog({title: '', content: request.responseText, type: 'red'});
        }
    });
}

// ----------------------------------------------------------------------------------//
//                         Contrôle d'un champs non vide                             //
// ----------------------------------------------------------------------------------//

function controler(input, message) {
    input.value = input.value.trim();
    let valeur = input.value;
    if (valeur.length === 0) {
        message.innerText = "Champ requis";
        return false;
    }
    message.innerText = '';
    return true;
}

// ------------------------------------------------------//
//     Annimation lors du clique connexion ou insrire    //
// ------------------------------------------------------//

document.querySelector('.img__btn').addEventListener('click', function() {
    document.querySelector('.cont').classList.toggle('s--signup');
});




