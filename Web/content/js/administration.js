// ----------------------------------------------------------------------------------//
//                             Déclaration des variables                             //
// ----------------------------------------------------------------------------------//

let divCompte;

let inputNomR;

let inputEmail;
let inputNom;
let inputPrenom;
let inputStatus;
let inputPseudo;
let inputGrade;
let inputNote;

let modalEmail;
let modalPseudo;
let modalNom;
let modalPrenom;
let modalGrade;
let modalStatus;

let messageModifStatusGrades;

$(function () {
// ----------------------------------------------------------------------------------//
//                Récupération des variables dont nous avons besoins                 //
// ----------------------------------------------------------------------------------//

    divCompte = document.getElementById('compte');

    inputNomR = document.getElementById('nomR');

    inputEmail = document.getElementById('email');
    inputNom = document.getElementById('nom');
    inputPrenom = document.getElementById('prenom');
    inputStatus = document.getElementById('status');
    inputPseudo = document.getElementById('pseudo');
    inputGrade = document.getElementById('grade');
    inputNote = document.getElementById('note');

    //La div contenant les infos sur l'utilisateur est par défaut masqué
    divCompte.style.display = 'none';

// ----------------------------------------------------------------------------------//
//                            Alimentation du champs nonR                            //
// ----------------------------------------------------------------------------------//

    let nomR = $("#nomR");
    let autoCompNom = {
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
                let id = nomR.getSelectedItemData().id;
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
                        let id = lesValeurs[0].id;
                        nomR.val(lesValeurs[0].nomPrenom);
                        nomR.focus();
                        rechercher(id);
                    }
                }
            }
        }
    };

// ----------------------------------------------------------------------------------//
//                            Alimentation du champs PseudoR                         //
// ----------------------------------------------------------------------------------//

    let pseudoR = $("#pseudoR");
    let autoCompPseudo = {
        url: "content/ajax/getlespseudos.php",
        // valeur alimentant la zone d'auto-complétion
        getValue: "pseudo",
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
                let id = pseudoR.getSelectedItemData().id;
                rechercher(id);
            },
            onLoadEvent: function () {  // lorsque la liste se charge (à chaque saisie d'un caractère)
                // récupération des valeurs correspondant à la saisie actuelle
                let lesValeurs = pseudoR.getItems();
                // Si la liste est vide on signale que ce nom n'existe pas
                if (lesValeurs.length === 0) {
                    pseudoR.addClass("border-danger");
                } else {
                    pseudoR.removeClass('border-danger');
                    // si il ne reste qu'une valeur on l'a valide automatiquement
                    if (lesValeurs.length === 1) {
                        let id = lesValeurs[0].id;
                        pseudoR.val(lesValeurs[0].pseudo);
                        pseudoR.focus();
                        rechercher(id);
                    }
                }
            }
        }
    };

// ----------------------------------------------------------------------------------//
//                            Alimentation du champs emailR                          //
// ----------------------------------------------------------------------------------//

    let emailR = $("#emailR");
    let autoCompEmail = {
        url: "content/ajax/getlesemails.php",
        // valeur alimentant la zone d'auto-complétion
        getValue: "email",
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
                let id = emailR.getSelectedItemData().id;
                rechercher(id);
            },
            onLoadEvent: function () {  // lorsque la liste se charge (à chaque saisie d'un caractère)
                // récupération des valeurs correspondant à la saisie actuelle
                let lesValeurs = emailR.getItems();
                // Si la liste est vide on signale que ce nom n'existe pas
                if (lesValeurs.length === 0) {
                    emailR.addClass("border-danger");
                } else {
                    pseudoR.removeClass('border-danger');
                    // si il ne reste qu'une valeur on l'a valide automatiquement
                    if (lesValeurs.length === 1) {
                        let id = lesValeurs[0].id;
                        emailR.val(lesValeurs[0].email);
                        emailR.focus();
                        rechercher(id);
                    }
                }
            }
        }
    };
    nomR.easyAutocomplete(autoCompNom);
    pseudoR.easyAutocomplete(autoCompPseudo);
    emailR.easyAutocomplete(autoCompEmail);

// ----------------------------------------------------------------------------------//
//       Récupération des variables dont nous avons besoins pour les MAJ             //
// ----------------------------------------------------------------------------------//

    modalEmail = document.getElementById('modalEmail');
    modalPseudo = document.getElementById('modalPseudo');
    modalNom = document.getElementById('modalNom');
    modalPrenom = document.getElementById('modalPrenom');
    modalGrade = document.getElementById('modalGrade');
    modalStatus = document.getElementById('modalStatus');

    messageModifStatusGrades = document.getElementById('messageModifStatusGrades');

// ----------------------------------------------------------------------------------//
//                        Lancemant des MAJ au clique des bontons                    //
// ----------------------------------------------------------------------------------//

    document.getElementById('modifStatusGrades').onclick = majStatusGrades;

});

// récupération des informations sur le compte de l'utilisateur
function rechercher(id) {
    $.post('content/ajax/getcomptebyid.php', {id : id }, afficher, 'json');
}

// Affichage des informations de l'utilisateur
function afficher(data) {
    if (data) {
        inputEmail.value = data.email;
        inputNom.value = data.nom;
        inputPrenom.value = data.prenom;
        inputStatus.value = data.typesstatus;
        inputPseudo.value = data.pseudo;
        inputGrade.value  = data.libellecomptes;
        inputNote.value  = data.description;

        modalEmail.value = data.email;
        modalPseudo.value = data.pseudo;
        modalNom.value = data.nom;
        modalPrenom.value = data.prenom;
        modalGrade.value = data.libellecomptes;
        modalStatus.value = data.typesstatus;

        divCompte.style.display= 'unset';
        inputNom.focus();

    }
}

// ----------------------------------------------------------------------------------//
//                 Gestion des MAJ des informations de l'utilisateur                 //
// ----------------------------------------------------------------------------------//

function majStatusGrades(data) {
    $.ajax({
        url: "content/ajax/administrateur/majstatusgrades.php",
        type: 'post',
        data: {
            inputEmail: inputEmail.value,
            modalGrade: modalGrade.value,
            status: modalStatus.value
        },
        dataType: "json",
        success : function(data) {
            if (data == 0){
                // Si le champ n'as pas été modifier
                messageModifStatusGrades.innerText = "Tu n'as rien changer...";
            } else {
                // Si la modification à été faite correctement
                messageModifStatusGrades.innerText = "";

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
                inputGrade.value = modalGrade.value;
                inputStatus.value = modalStatus.value;
            }
        },
        error: function (request) {
            $.dialog({title: '', content: request.responseText, type: 'red'});
        }
    });
}

function erreurAjax(request, error) {
    $.dialog({title: '', content: request.responseText, type: 'red',});
}
