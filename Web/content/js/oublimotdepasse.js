"use strict";

window.onload = function () {
    $('[data-toggle="popover"]').popover({trigger: 'hover'});
    //Lancement des procédure au clique des boutons
    btnOublieMdp.onclick = envoi;
    btnChangerMdp.onclick = initialisation;
    code.onkeypress = accepterChiffre;
    zone1.style.display="block";
    zone2.style.display="none";
    envoiMail.focus();
};

function accepterChiffre(e) {
    if (!/^[0-9]$/.test(e.key)) {
        return false;
    }
}

function envoi() {
    let mailOk = controler(envoiMail, messageEnvoiMail);
    if (mailOk) {
        envoyer()
    }
}

// le champ est obligatoire
function controler(champ, message) {
    if (champ.value.length === 0) {
        message.innerText = "Champ requis ";
        return false;
    }
    message.innerText = '';
    return true;
}

function envoyer() {
    $.ajax({
        url: 'content/ajax/envoyercode.php',
        type: 'POST',
        data: {envoiMail: envoiMail.value},
        dataType: "json",
        error: erreurAjax,
        success: function () {
            message.innerHTML = "Code de vérification envoyé";
            zone2.style.display="block";
            zone1.style.display="none";
        }
    })
}



// phase 2

function initialisation() {
    let passwordOk = controlerPassword(inputNewMdp, messageInputNewMdp);
    let codeOk = controlerCode(code, messageCode);
    if (passwordOk && codeOk) {
        initialiser()
    }
}

function controlerCode(champ, message) {
    let valeur = champ.value;
    // le champ doit être renseigné
    if (valeur.length === 0) {
        message.innerText = 'Champ requis';
        return false;
    }

    // contrôle du format attendu : 6 chiffres
    if (!/^[0-9]{6}$/.test(valeur)) {
        message.innerText = "Code numérique à 6 chiffres attendu";
        return false;
    }
    message.innerText = '';
    return true;
}

function controlerPassword(champ, message) {
    let valeur = champ.value;

    // le champ est obligatoire
    if (valeur.length === 0) {
        message.innerText = "Champ requis ";
        return false;
    }

    // entre 4 et 16 caractères
    if (! /^[a-zA-Z0-9]{4,16}$/.test(valeur)) {
        message.innerText = "Le mot de passe doit comporter entre 4 et 16  caractères.";
        return false;
    }

    // Sa valeur doit être la même que le champ confirmation
    if (valeur !== inputCfrmNewMdp.value) {
        messageInputCfrmNewMdp.innerText = "Les mot des passses ne sont pas identique ";
        return false;
    }

    message.innerText = '';
    messageInputCfrmNewMdp.innerText = '';
    return true;
}

function initialiser() {
    $.ajax({
        url: "content/ajax/initialiserpassword.php",
        data: {email : envoiMail.value, password: inputNewMdp.value, code: code.value},
        type: 'post',
        dataType: "json",
        error: erreurAjax,
        success: function () {

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

            //Reset des champs
            zone1.style.display="block";
            zone2.style.display="none";
            envoiMail.value = "";
            code.value = "";
            inputNewMdp.value = "";
            inputCfrmNewMdp.value = "";
            message.innerText = "";
        }
    });
}

function erreurAjax(request) {
    message.innerHTML = request.responseText;
}
