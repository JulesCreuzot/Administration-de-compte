/* 
 * Définition de la classe Std : Ensemble des fonctions standards
 *
 * @Author : Guy Verghote
 * @Version : 2020.1
 * @date : 03/01/2020
 *
 */

// --------------------------------------------
// ajout de méthodes sur la classe String
// --------------------------------------------

/*
 retourne l'extension d'un fichier : les caractères situés derrière le dernier point
 retourne undefined si la chaîne ne contient pas de point
*/
String.prototype.getExtension = function () {
    return /[.]/.exec(this) ? /[^.]+$/.exec(this)[0] : undefined;
    // return /(?:\.([^.]+))?$/.exec(this)[1];
};

/*
 Retourne la valeur en ayant mis en majuscule la première lettre de chaque mot
 et les autres lettres de chaque mot en minuscule
 les mots doivent être séparés par un espace
*/
String.prototype.ucWord = function () {
    let lesMots = this.split(" ");
    let resultat = "";
    for (let i in lesMots) {
        let unMot = lesMots[i];
        resultat += unMot[0].toUpperCase() + unMot.substr(1).toLowerCase() + " ";
    }
    // il faut retirer le dernier espace ajouté
    resultat = resultat.substr(0, resultat.length - 1);
    return resultat;
};

/*
 * Contrôle si la valeur du champ respecte le motif accepté par ce champ
 * la fonction est bloquante : si le type n'existe pas la fonction retourne faux ce qui bloque la validation
 * le paramètre format définit le format à respecter
 *     email, entier, chiffre, reel, monetaire, tel, dateFr, dateMysql, temps, url, password
*/
String.prototype.respecterLeFormat = function (unFormat) {
    let tab = [];
    let correct = false;
    switch (unFormat) {
        case 'email':
            correct = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*[\.][a-zA-Z]{2,4}$/.test(this);
            break;
        case 'entier':
            correct = /^[-+]?[0-9]+$/.test(this);
            break;
        case 'chiffre':
            correct = /^[0-9]+$/.test(this);
            break;
        case 'reel':
            correct = /^[-+]?[0-9]+(\.[0-9]+)?$/.test(this);
            break;
        case 'monetaire':
            correct = /^[0-9]+(\.[0-9]{0,2})?$/.test(this);
            break;
        case 'tel':
            correct = /^([0][1-9]([\.\_\/\-\s]?[0-9]{2}){4})?$/.test(this);
            break;
        case 'dateFr':
            tab = /^(\d{1,2})[-/.](\d{1,2})[-/.](\d{4})$/.exec(this);
            correct = !(tab == null);
            if (correct) {
                correct = Std.dateValide(tab[1], tab[2], tab[3]);
            }
            break;
        case 'dateMysql':
            tab = /^(\d{4})[-/.](\d{1,2})[-/.](\d{1,2})$/.exec(this);
            correct = !(tab == null);
            if (correct) {
                correct = Std.dateValide(tab[3], tab[2], tab[1]);
            }
            break;
        case 'temps' : // [hh]:mm:ss autres séparateurs . ou ,
            correct = /^([0-9]{1,2}[.,:]?)?[0-5][0-9][.,:]?[0-5][0-9]$/.test(this);
            break;
        case 'url':
            // correct = /^http(s)?:\/\/[0-9a-zA-Z\-\_.]+([.0-9a-zA-Z\-\_])?[.][a-zA-Z]{2,4}/.test(this);
            correct = /^((http:\/\/|https:\/\/)?(www.)?(([a-zA-Z0-9-]){2,}\.){1,4}([a-zA-Z]){2,6}(\/([a-zA-Z-_\/\.0-9#:?=&;,]*)?)?)/.test(this);
            break;
        case 'password' :
            correct = /(?=.*[a-z]+)(?=.*[A-Z]+)(?=.*[0-9]+)(?=.*[()=+?!'$.%;:@&*#/\\-]+).{8,}$/.test(this);
            break;
        // ?= indique une recherche sans avancer dans la chaine  : on recommence toujours depuis le début
        default :
            correct = false;
        // attention si la valeur du paramètre unFormat n'existe pas la fonction retourne faux

    }
    return correct;
};

/*
  enlever les Accents
  en normalisant la chaine dans le jeu de caractère unicode, la lettre et son accent sont décomposés en deux codes
  tous les accents sont codés entre 0300 et 036f, il suffit donc de les remplacer par une chaîne vide
  https://stackoverflow.com/questions/990904/remove-accents-diacritics-in-a-string-in-javascript
*/
String.prototype.enleverAccent = function () {
    return this.normalize('NFD').replace(/[\u0300-\u036f]/g, "");
};

// Sous Windows les caractères suivants ne peuvent être utilisés dans le nom d'un fichier :  < > " / | ? * : \
String.prototype.remplacerCaractereDos = function () {
    return this.replace(/([<>"/|?*\\:]+)/g, ' ').trim();
};

// enlever les accents et remplacer tous les caractères non alphanumériques à l'exception du point
String.prototype.remplacerCaractereNonAlpha = function () {
    // les autres caractères non alphanumériques sont remplacés par un espace
    return this.enleverAccent().replace(/([^.a-z0-9 ]+)/ig, ' ').trim();
};

// ancienne version
String.prototype.remplacerCaractereNonAlpha2 = function () {
    let lesCaracteresAccentues = [
        /[\300-\306]/g, /[\340-\346]/g, // A, a
        /[\310-\313]/g, /[\350-\353]/g, // E, e
        /[\314-\317]/g, /[\354-\357]/g, // I, i
        /[\322-\330]/g, /[\362-\370]/g, // O, o
        /[\331-\334]/g, /[\371-\374]/g, // U, u
        /[\321]/g, /[\361]/g, // N, n
        /[\307]/g, /[\347]/g, // C, c
    ];
    let lesCaracteresNonAccentues = ['A', 'a', 'E', 'e', 'I', 'i', 'O', 'o', 'U', 'u', 'N', 'n', 'C', 'c'];

    let resultat = this;
    for (let i = 0; i < lesCaracteresAccentues.length; i++) {
        resultat = resultat.replace(lesCaracteresAccentues[i], lesCaracteresNonAccentues[i]);
    }

    // les autres caractères non alphanumériques sont remplacés par un espace
    resultat = resultat.replace(/([^.a-z0-9 ]+)/ig, ' ').trim();
    return resultat;
};

// --------------------------------------------
// ajout de méthodes sur la classe Date
// --------------------------------------------

// retourne l'objet date sous la forme jj/mm/aaaa
Date.prototype.getDateFr = function () {
    let jour = this.getDate();
    let mois = this.getMonth() + 1;
    return ("0" + jour).slice(-2) + "/" + ("0" + mois).slice(-2) + "/" + this.getFullYear();
};

// retourne l'objet date sous la forme aaaa-mm-jj
Date.prototype.getDateMysql = function () {
    let jour = this.getDate();
    let mois = this.getMonth() + 1;
    return this.getFullYear() + "-" + ("0" + mois).slice(-2) + "-" + ("0" + jour).slice(-2);
};


// retourne l'objet date sous la forme jjjj jj/mm/aaaa
Date.prototype.getDateLong = function () {
    // récupération du numéro de jour dans la semaine (0 à 6)
    let indiceJour = this.getDay();
    // récupération du jour
    let jour = this.getDate();
    // ajout éventuel du 0 non significatif 08
    jour = ("0" + jour).slice(-2);
    let mois = this.getMonth() + 1;
    let annee = this.getFullYear();
    let lesJours = ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];
    let lesMois = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "décembre"];
    return lesJours[indiceJour] + " " + jour + " " + lesMois[mois] + " " + annee;
};

// retourne le jour en lettre
Date.prototype.getJourEnLettre = function () {
    // récupération du numéro de jour dans la semaine (0 à 6)
    let indiceJour = this.getDay();
    let lesJours = ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];
    return lesJours[indiceJour];
};

//  retire la partie horaire de l'objet date
Date.prototype.delTime = function () {
    this.setHours(0);
    this.setMilliseconds(0);
    this.setMinutes(0);
    this.setSeconds(0);
};

// --------------------------------------------
// Définition de la classe Std
// --------------------------------------------

class Std {

    /*
      Afficher un message dans une zone définie de la page

      @param {string} id du conteneur dans lequel le message sera affiché
      @param {string}  message texte du message
      @param {string}  couleur de fond du message : rouge, vert, orange, gris
      @param {number}  duree : temps d'affichage en seconde
     */
    static afficherMessage(id, message, couleur = '', duree = 0) {
        let zone = $('#' + id);
        zone.empty();
        // détermination de la classe bootstrap à utiliser en fonction de la couleur choisie
        let classe = "";
        switch (couleur)   {
            case 'vert' :
                classe = 'alert-success';
                break;
            case 'rouge' :
                classe = 'alert-danger';
                break;
            case 'orange' :
                classe = 'alert-warning';
                break;
            default :
                classe = 'alert-info';
        }
        zone.hide();
        let conteneur = $('<div>', {id : 'leMessage', class : 'alert alert-dismissable ' + classe});
        let bouton = $('<button>', { type : 'button', class : 'close', 'data-dismiss' : 'alert', 'aria-hidden' : 'true'});
        bouton.text('x');
        conteneur.append(bouton);
        conteneur.append(message);
        zone.append(conteneur);
        zone.slideDown("slow");
        if (duree > 0 && duree < 10) {
            zone.delay(duree * 1000).slideUp("slow");
        }
    }

    /*
      Création d'un cookie servant de signature pour les appels de script php
      afin d'éviter un appel direct du fichier
     */
    static signerRequete() {
        let dtExpire = new Date();
        dtExpire.setTime(dtExpire.getTime() + 15 * 1000);
        document.cookie = 'ajax=1;expires=' + dtExpire.toUTCString();
    }

    /*
      conversion d'un nombre exprimé en octet en ko, Mo ou Go

      @param {number} nb nombre représentant un nombre d'octets
      @param {string} unite : unité souhaitée : Ko Mo ou Go
      @return {number}  nombre exprimé dans l'unité avec une mise en forme par groupe de 3
     */
    static conversionOctet(nb, unite = 'o') {
        let diviseur = 1;
        switch (unite) {
            case "Ko" :
                diviseur = 1024;
                break;
            case "Mo" :
                diviseur = 1024 * 1024;
                break;
            case "Go" :
                diviseur = 1024 * 1024 * 1024;
                break;
            default :
                diviseur = 1;
                break;
        }
        let str = Math.round(nb / diviseur).toString();
        let result = str.slice(-3);
        str = str.substring(0, str.length - 3);  // sans les trois derniers
        while (str.length > 3) {
            let elt = str.slice(-3);
            result = elt.concat(" ", result);
            str = str.substring(0, str.length - 3);
        }
        result = str.concat(" ", result, " ", unite);
        return result;
    }

    // encoder les apostrophes
    // https://stackoverflow.com/questions/18251399/why-doesnt-encodeuricomponent-encode-single-quotes-apostrophes
    static encoder(str) {
        return encodeURIComponent(str).replace(/[!'()*]/g, function (c) {
            return '%' + c.charCodeAt(0).toString(16);
        });
    }

     // récupération des paramètres GET de la page courante
    static getLesParametresUrl() {
        // Search retourne ?nom=valeur&nom=valeur...
        let lesCouplesNomValeur = location.search.substring(1).split('&');
        let lesParametres = [];
        for (const i in lesCouplesNomValeur) {
            let lesCouples = lesCouplesNomValeur[i].split('=');
            lesParametres[lesCouples[0]] = lesCouples[1];
        }
        return lesParametres;
    }

    // retourne vrai si année bissextile
    static estBissextile(annee) {
        return ((annee % 4 === 0) && ((annee % 100 !== 0) || (annee % 400 === 0)));
    }

    // retourne le nombre de jours d'un mois donné
    static nbjMois(mois, annee) {
        if (mois === 2) return Std.estBissextile(annee) ? 29 : 28;
        if (mois === 4 || mois === 6 || mois === 9 || mois === 11) return 30;
        return 31;
    }

    // vérifie si la date est valide
    static dateValide(unJour, unMois, uneAnnee) {
        let mois = parseInt(unMois, 10);
        let jour = parseInt(unJour, 10);
        let annee = parseInt(uneAnnee, 10);
        return mois >= 1 && mois <= 12 && jour >= 1 && jour <= Std.nbjMois(mois, annee) && annee >= 1900;
    }

    // encode une date au format jj/mm/aaaa dans le format MySQL
    static encoderDate(date) {
        return date.substr(6) + '-' + date.substr(3, 2) + '-' + date.substr(0, 2);
    }

    // Décode une date Mysql pour l'exprimer dans le format jj/mm/aaaa
    static decoderDate(date) {
        return date.substr(8) + '/' + date.substr(5, 2) + '/' + date.substr(0, 4);
    }
	
	/*
	 met en forme les données transmises dans une balise table
	       @param lesDonnees : tableau des données
	       @param lesEntetes : tableau des entêtes de colonne
	       @param lesTailles : tableau des tailles des colonnes
	       @param lesClasses : tableau des attributs class des colonnes
	*/

	static genererTableau(lesDonnees, lesEntetes, lesTailles, lesClasses) {
        let table = $('<table>', {class: 'table table-sm table-borderless'});
        let thead = $('<thead>');
        let tr = $('<tr>');
        for (const i in lesEntetes) {
            let td = $('<td>', {style: "width :" + lesTailles[i] + "px", class: lesClasses[i]}).text(lesEntetes[i]);
            tr.append(td);
        }
        thead.append(tr);
        table.append(thead);
        for (const ligne of lesDonnees) {
            let tr = $('<tr>');
            let i = 0;
            for (const cle in ligne) {
                let td = $('<td>', {class: lesClasses[i]}).text(ligne[cle]);
                tr.append(td);
                i++;
            }
            table.append(tr)
        }
        return table;
    }

}