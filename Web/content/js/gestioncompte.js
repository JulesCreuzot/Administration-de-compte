// ----------------------------------------------------------------------------------//
//                Déclaration des variables dont nous avons besoins                  //
//           Les variable avec input correspondent au champs dans le modal           //
//            Les varablies sanns input correspondent à l'affichage direct           //
// ----------------------------------------------------------------------------------//

let email;
let nom;
let prenom;
let grade;
let pseudo;
let note;
let messageNote;

let inputEmail;
let messageInputEmail;
let inputNom;
let inputPrenom;
let inputPseudo;
let messageInputPseudo;

let ancienMdp;
let messageAcienMdp;
let nouveauMdp;
let messageNouveauMdp;
let cfmNouveauMdp;
let messageCfmNouveauMdp;
let confirmersupprimer;

$(function (){

// ----------------------------------------------------------------------------------//
//                Récupération des variables dont nous avons besoins                 //
// ----------------------------------------------------------------------------------//

    email = document.getElementById('email');
    nom = document.getElementById('nom');
    prenom = document.getElementById('prenom');
    grade = document.getElementById('grade');
    pseudo = document.getElementById('pseudo');
    note = document.getElementById('note');
    messageNote = document.getElementById('messageNote');

    inputEmail = document.getElementById('inputEmail');
    messageInputEmail = document.getElementById('messageInputEmail');
    inputNom = document.getElementById('inputNom');
    inputPrenom = document.getElementById('inputPrenom');
    inputPseudo = document.getElementById('inputPseudo');
    messageInputPseudo = document.getElementById('messageInputPseudo');

    ancienMdp = document.getElementById('ancienMdp');
    messageAcienMdp = document.getElementById('messageAcienMdp');
    nouveauMdp =document.getElementById('nouveauMdp');
    messageNouveauMdp = document.getElementById("messageNouveauMdp");
    cfmNouveauMdp = document.getElementById('cfmNouveauMdp');
    messageCfmNouveauMdp = document.getElementById('messageCfmNouveauMdp');
    confirmersupprimer = document.getElementById('confirmersupprimer');

// ----------------------------------------------------------------------------------//
//            Récupération des informations de l'utilisateur dans notre DB           //
// ----------------------------------------------------------------------------------//
    $.getJSON("content/ajax/informationcompte.php", remplirLesDonnees);

// ----------------------------------------------------------------------------------//
//                        Lancemant des MAJ au clique des bontons                    //
// ----------------------------------------------------------------------------------//

    document.getElementById('btnVEmail').onclick = majemail;
    document.getElementById('btnVNomPrenom').onclick = majnomprenom;
    document.getElementById('btnVPseudo').onclick = majpseudo;
    document.getElementById('btnVMdp').onclick = controlermajmdp;
    document.getElementById('btnVNote').onclick = majnote;
    document.getElementById('btnSupprimerCompte').onclick = supprimercompte;

});

// ----------------------------------------------------------------------------------//
//                        Remplisage des données de la pages                         //
// ----------------------------------------------------------------------------------//

function remplirLesDonnees(data) {
    if(data){
        email.value = data.email;
        nom.value = data.nom;
        prenom.value = data.prenom;
        grade.value = data.libelleComptes;
        pseudo.value = data.pseudo;
        note.value = data.description;

        inputEmail.value = data.email;
        inputNom.value = data.nom;
        inputPrenom.value = data.prenom;
        inputPseudo.value = data.pseudo;
    }
}

// ----------------------------------------------------------------------------------//
//                               Gestion des MAJ                                     //
// ----------------------------------------------------------------------------------//

function majemail() {
    $.ajax({
        url: "content/ajax/utilisateur/majemail.php",
        type: 'post',
        data: {
            email: email.value,
            inputEmail: inputEmail.value
        },
        dataType: "json",
        success : function(data) {
            if (data == 0){
                // Si le champ n'as pas été modifier
                messageInputEmail.innerText = "Tu n'as rien changer...";
            }
            else if (data == 2){
                messageInputEmail.innerText = "Le format mail n'est pas valide";
            }
            else {
                // Si la modification à été faite correctement
                messageInputEmail.innerText = "";
                majok();
            }
        },
        error: function (request) {
            $.dialog({title: '', content: request.responseText, type: 'red'});
        }
    });
}

function majnomprenom() {
    $.ajax({
        url: "content/ajax/utilisateur/majnomprenom.php",
        type: 'post',
        data: {
            email: email.value,
            inputNom: inputNom.value,
            inputPrenom: inputPrenom.value
        },
        dataType: "json",
        success : function(data) {
            if (data == 0){
                // Si le champ n'as pas été modifier
                Std.afficherMessage("msgModalNomPrenom", "Tu n'as rien changer", "rouge", 5)
            }
            else {
                // Si la modification à été faite correctement
                majok();
            }
        },
        error: function (request) {
            $.dialog({title: '', content: request.responseText, type: 'red'});
        }
    });
}

function majpseudo() {
    $.ajax({
        url: "content/ajax/utilisateur/majpseudo.php",
        type: 'post',
        data: {
            email: email.value,
            pseudo: pseudo.value,
            inputPseudo: inputPseudo.value
        },
        dataType: "json",
        success : function(data) {
            if (data == 0){
                // Si le champ n'as pas été modifier
                messageInputPseudo.innerText = "Tu n'as rien changer...";
            }
            else {
                // Si la modification à été faite correctement
                messageInputPseudo.innerText = "";
                majok();
            }
        },
        error: function (request) {
            $.dialog({title: '', content: request.responseText, type: 'red'});
        }
    });
}

function controlermajmdp() {
    let ancienMdpPasVide = pasvide(ancienMdp, messageAcienMdp);
    let nouveauMdpPasVide = pasvide(nouveauMdp, messageNouveauMdp);
    let cfmNouveauMdpPasVide = pasvide(cfmNouveauMdp, messageCfmNouveauMdp)
    if (ancienMdpPasVide || nouveauMdpPasVide || cfmNouveauMdpPasVide)
    {
        majmdp();
    }
}

function majmdp() {
    $.ajax({
        url: "content/ajax/utilisateur/majmdp.php",
        type: 'post',
        data: {
            email: email.value,
            ancienMdp: ancienMdp.value,
            nouveauMdp: nouveauMdp.value,
            cfmNouveauMdp: cfmNouveauMdp.value
        },
        dataType: "json",
        success : function(data) {
            if (data == 1){
                // Si l'ancien mdp n'est pas bon
                Std.afficherMessage("msgModalMdp", "L'ancien mot de passe n'est pas bon", "rouge", 7)
            }
            else if (data == 2){
                // Si le nouveau mdp ne correpond pas à la confirmation du nouveau mdp
                messageCfmNouveauMdp.innerText = "Les mot de passe ne correspondent pas";
            }
            else if (data == 3){
                // Si m'ancien mdp correspond au nouveau
                Std.afficherMessage("msgModalMdp", "L'ancien mot de passe ne peut pas être le nouveau", "rouge", 5);
            }
            else if (data == 4){
                // Si le mot de passe n'est pas compris entre 4 et 16 caractères
                Std.afficherMessage("msgModalMdp", "Le mot de passe doit contenir entre 4 et 16 caractères", "rouge", 5);
            }
            else{
                // Si la modification à été faite correctement
                majok();
            }
        },
        error: function (request) {
            $.dialog({title: '', content: request.responseText, type: 'red'});
        }
    });
}

function majnote() {
    $.ajax({
        url: "content/ajax/utilisateur/majnote.php",
        type: 'post',
        data: {
            email: email.value,
            note: note.value
        },
        dataType: "json",
        success : function(data) {
            if (data == 0){
                // Si le champ n'as pas été modifier
                messageNote.innerText = "Tu n'as rien changer...";
            }
            else{
                // Si la modification à été faite correctement
                messageNote.innerText = "";

                $(function(){
                    var fenetre = $('<div id="fenetre"></div>');
                    fenetre.show();
                    fenetre.appendTo(document.body);
                    $('.popup').show();
                    $('.fermer').click(function(){
                        $('.popup').hide();
                        fenetre.appendTo(document.body).remove();
                        return false;
                    });

                    $('.x').click(function(){
                        $('.popup').hide();
                        fenetre.appendTo(document.body).remove();
                        return false;
                    });
                });
            }
        },
        error: function (request) {
            $.dialog({title: '', content: request.responseText, type: 'red'});
        }
    });
}

// ----------------------------------------------------------------------------------//
//                      Ce que l'on fait si les MAJ ce passe bien                    //
// ----------------------------------------------------------------------------------//

function majok() {
    //On ferme le modal en question
    _targettedModal.classList.remove(modalActiveClass);

    //On affiche un message disant que la modif est ok
    $(function(){
        var fenetre = $('<div id="fenetre"></div>');
        fenetre.show();
        fenetre.appendTo(document.body);
        $('.popup').show();
        $('.fermer').click(function(){
            $('.popup').hide();
            fenetre.appendTo(document.body).remove();
            return false;
        });

        $('.x').click(function(){
            $('.popup').hide();
            fenetre.appendTo(document.body).remove();
            return false;
        });
    });

    //on remet les valeurs visuel
    email.value = inputEmail.value;
    nom.value = inputNom.value;
    prenom.value = inputPrenom.value;
    pseudo.value = inputPseudo.value;
}

// ----------------------------------------------------------------------------------//
//                         Contrôle d'un champs non vide                             //
// ----------------------------------------------------------------------------------//

function pasvide(input, message) {
    input.value = input.value.trim();
    let valeur = input.value;
    if (valeur.length === 0) {
        message.innerText = "Champ requis";
        return false;
    }
    message.innerText = '';
    return true;
}

// ----------------------------------------------------------------------------------//
//                               Supression du compte                                //
// ----------------------------------------------------------------------------------//

function supprimercompte() {
    $.ajax({
        url: "content/ajax/utilisateur/supprimercompte.php",
        type: 'post',
        data: {
            email: email.value,
        },
        dataType: "json",
        success : function(data) {
            if (data === 1) {
                // Si la modification à été faite correctement
                Std.afficherMessage("confirmersupprimer", '<strong>Votre compte vient d\'être supprimer.</strong><br>\n' +
                                    'Vous allez être rediriger vers l\'accueil dans quelque instant.<br>\n' +
                                    'Il est conseillé de fermer toutes les fenêtres de navigation.', "vert", 3);
                setTimeout(function () {
                    _targettedModal.classList.remove(modalActiveClass);
                    location.assign('index.php');
                }, 5000);

            }
        },
        error: function (request) {
            $.dialog({title: '', content: request.responseText, type: 'red'});
        }
    });
}