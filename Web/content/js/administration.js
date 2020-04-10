// ----------------------------------------------------------------------------------//
//                             Déclaration des variables                             //
// ----------------------------------------------------------------------------------//

let diCompte;

let inputNomR;

let inputEmail;
let inputNom;
let inputPrenom;
let inputStatus;
let inputNbEssaie;
let inputPseudo;
let inputMdp;
let inputGrade;
let inputNote;

$(function () {
// ----------------------------------------------------------------------------------//
//                Récupération des variables dont nous avons besoins                 //
// ----------------------------------------------------------------------------------//

    diCompte = document.getElementById('compte');

    inputNomR = document.getElementById('nomR');

    inputEmail = document.getElementById('email');
    inputNom = document.getElementById('nom');
    inputPrenom = document.getElementById('prenom');
    inputStatus = document.getElementById('status');
    inputNbEssaie = document.getElementById('nbessaie');
    inputPseudo = document.getElementById('pseudo');
    inputMdp = document.getElementById('mdp');
    inputGrade = document.getElementById('grade');
    inputNote = document.getElementById('note');


// ----------------------------------------------------------------------------------//
//                            Alimentation du champs nonR                            //
// ----------------------------------------------------------------------------------//

    let nomR = $("#nomR");
    let option = {
        url: "content/ajax/getlesnoms.php",
        // valeur alimentant la zone d'auto-complétion
        getValue: "nomPrenom",
        list: {
            match: {
                enabled: true,
                // correspondance à partir du premier caractère
                method: function (element, phrase) {
                    return element.indexOf(phrase) === 0;
                }
            },
            onChooseEvent: function () {
                // récupération de l'email du nom sélectionné
                let id = nomR.getSelectedItemData().email;
                rechercher(id);
            },
            onLoadEvent: function () {  // lorsque la liste se charge (à chaque saisie d'un caractère)
                // récupération des valeurs correspondant à la saisie actuelle
                let lesValeurs = nomR.getItems();
                // Si la liste est vide on signale que ce nom n'existe pas
                if (lesValeurs.length === 0) {
                    nomR.addClass("border-danger");
                } else {
                    nomR.removeClass('border-danger');
                    // si il ne reste qu'une valeur on l'a valide automatiquement
                    if (lesValeurs.length === 1) {
                        let id = lesValeurs[0].email;
                        nomR.val(lesValeurs[0].nom);
                        nomR.setFocus();
                        rechercher(id);
                    }
                }
            }
        }
    };
    nomR.easyAutocomplete(option);
});

// récupération des coordonnées du coureur
function rechercher(id) {
    $.post('content/ajax/getcomptebyid.php', {id : id }, afficher, 'json');
}

function afficher(data) {
    if (data) {
        inputEmail.value = data.email;
        inputNom.value = data.nom;
        inputPrenom.value = data.prenom;
        inputStatus.value = data.typesstatus;
        inputNbEssaie.value = data.nbtentative;
        inputPseudo.value = data.pseudo;
        inputMdp.value = data.pswd;
        inputGrade.value  = data.libellecomptes;
        inputNote.value  = data.description;
        diCompte.style.visibility = 'visible';
        inputNom.focus();
    } else {
        diCompte.style.visibility = 'hidden';
    }
}

function erreurAjax(request, error) {
    $.dialog({title: '', content: request.responseText, type: 'red',});
}
