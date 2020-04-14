
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

let inputEmail;
let inputNom;
let inputPrenom;
let inputPseudo;

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

    inputEmail = document.getElementById('inputEmail');
    inputNom = document.getElementById('inputNom');
    inputPrenom = document.getElementById('inputPrenom');
    inputPseudo = document.getElementById('inputPseudo');


// ----------------------------------------------------------------------------------//
//            Récupération des informations de l'utilisateur dans notre DB           //
// ----------------------------------------------------------------------------------//
    $.getJSON("content/ajax/informationcompte.php", remplirLesDonnees)

});

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