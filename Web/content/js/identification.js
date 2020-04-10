let identifiant;
let messageConnexion;
let psswd;
let messagePsswd;
// ----------------------------------------------------------------------------------//
//              Récupération des information donc nous avons besoins                 //
// ----------------------------------------------------------------------------------//

$(function () {
    identifiant = document.getElementById('identifiant');
    messageConnexion = document.getElementById('messageConnexion');
    psswd = document.getElementById('psswd');
    messagePsswd = document.getElementById('messageMotDePasse');
    document.getElementById('btnConnexion').onclick = connexion;
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
                //Laisser un delaie pour l'execution avant la redirection du reset du compteur nbtentative
                Std.afficherMessage("msgConnexion", "Connexion Réussi", "vert", 0);
                setTimeout(function () {
                    location.assign('index.php');
                }, 2000)
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
        data: {identifiant: identifiant.value}
    })
}

// ------------------------------------------------------//
//     Annimation lors du clique bonnexion ou insrire    //
// ------------------------------------------------------//

document.querySelector('.img__btn').addEventListener('click', function() {
    document.querySelector('.cont').classList.toggle('s--signup');
});


