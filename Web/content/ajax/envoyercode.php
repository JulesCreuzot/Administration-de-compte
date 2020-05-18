<?php
session_start();
require '../class/class.database.inc.php';
require '../class/class.mail.inc.php';

$db = Database::getInstance();

// contrôle des données attendues
if (!isset($_POST['envoiMail'])) {
    echo "Accès interdit";
    exit;
}

// vérification du l'existence du compte
$email = $_POST["envoiMail"];
$sql = <<<EOD
   SELECT email
   FROM comptes 
   WHERE email = :email;
EOD;
$curseur = $db->prepare($sql);
$curseur->bindParam('email', $email);
$curseur->execute();
$ligne = $curseur->fetch(PDO::FETCH_ASSOC);
$curseur->closeCursor();
if (!$ligne) {
    echo "Désolé, il n'existe pas de compte associé à ce login";
    exit;
};


// génération et sauvegarde du code de réinitialisation dans une variable de session
$code = "";
for($i = 1; $i <= 6; $i++) {
    $code .= rand(0,9);
}

//$_SESSION['code'] = "000000";
$_SESSION['code'] = $code;

// associer à un cookie afin de limiter la durée de vie
setcookie("code", hash('MD5', "VotreCHat"), time() + 300, "/");

// définition de l'adresse du serveur smtp utilisé et de l'adresse de l'expéditeur
Mail::setServeur('smtp.free.fr');
// définition de l'adresse de l'expéditeur
Mail::setExpediteur("projet@familycr.fr");

$destinataire = $ligne['email'];
$objet = "Demande de réinitialisation du mot de passe";
$contenu = <<<EOD
            Bonjour, 
            <br> Nous avons reçu une demande de modification du mot de passe associé à cette adresse électronique ($destinataire).
            <br> Si vous souhaitez vraiment modifier votre mot de passe, saisissez le code ci-dessous. 
            <br>Si vous n'avez pas fait cette demande, vous pouvez ignorer cet e-mail.
            <br>
             <strong>$code</strong>
             <br>
            <br>Nous espérons que vous appréciez notre service.
EOD;


// Envoi d'un mail à l'adresse mail2sms@envoyersmspro.com pour générer un SMS
$unMail =  new Mail($objet, $contenu, $destinataire);
$unMail->envoyer();
echo 1;