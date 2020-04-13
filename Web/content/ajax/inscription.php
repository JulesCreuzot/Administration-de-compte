<?php
require '../class/class.database.inc.php';
$db = Database::getInstance();

$inscriptionMail = $_POST["inscriptionMail"];
$inscriptionConfirmerMail = $_POST["inscriptionConfirmerMail"];
$inscriptionPassword =  $_POST["inscriptionPassword"];
$inscriptionConfirmerPassword =  $_POST["inscriptionConfirmerPassword"];

$inscriptionMailOk = preg_match("#^[a-z0-9.-]+@[a-z0-9._-]{2,}.[a-z]{2,4}$#", $inscriptionMail);
$inscriptionPasswordOk = preg_match("#^[a-zA-Z0-9]{4,16}$#", $inscriptionPassword);

// vérification du l'existence du compte
$sql = <<<EOD
        SELECT email
        FROM comptes 
        WHERE email = :inscriptionMail;
EOD;

$curseur = $db->prepare($sql);
$curseur->bindParam('inscriptionMail', $inscriptionMail);
$curseur->execute();
$ligne = $curseur->fetch(PDO::FETCH_ASSOC);
$curseur->closeCursor();

if ($inscriptionMail != $inscriptionConfirmerMail) {
    //contrôle de la correspondance des emails
    $ok = 1;
}
elseif ($inscriptionPassword != $inscriptionConfirmerPassword) {
    //contrôle de la correspondance des mots de passe
    $ok = 2;
}
elseif (!$inscriptionMailOk) {
    //Si contrôle format mail n'est pas bon
    $ok = 3;
}
elseif (!$inscriptionPasswordOk) {
    //Si le mot de passe ne fait pas entre 4 et 16 caractères
    $ok = 4;
}
elseif ($ligne){
    $ok = 5;
}
else {
    // Si tout est bon
    $sql = <<<EOD
    INSERT INTO comptes (email, pswd)
    VALUES ( :inscriptionMail, :inscriptionPassword );
EOD;

    $curseur = $db->prepare($sql);
    $curseur->bindParam('inscriptionMail', $inscriptionMail);
    $curseur->bindParam('inscriptionPassword', $inscriptionPassword);
    $curseur->execute();
    $curseur->closeCursor();
    $ok = 6;
}

echo $ok;