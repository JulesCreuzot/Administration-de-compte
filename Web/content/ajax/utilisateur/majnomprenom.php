<?php
require '../../class/class.database.inc.php';
$db = Database::getInstance();

// Récupération des variables

$email = $_POST['email'];
$nom = $_POST["inputNom"];
$prenom =  $_POST["inputPrenom"];

$sql = <<<EOD
   SELECT nom, prenom
   FROM comptes 
   WHERE email = :email;
EOD;

$curseur = $db->prepare($sql);
$curseur->bindParam('email', $email);
$curseur->execute();
$ligne = $curseur->fetch(PDO::FETCH_ASSOC);
$curseur->closeCursor();

if ($nom != $ligne['nom'] || $prenom != $ligne['prenom']) {
    $sql = <<<EOD
    UPDATE comptes
    SET nom = :nom, prenom = :prenom
    WHERE email = :email; 
EOD;

    $curseur = $db->prepare($sql);
    $curseur->bindParam('email', $email);
    $curseur->bindParam('nom', $nom);
    $curseur->bindParam('prenom', $prenom);
    $curseur->execute();
    $curseur->closeCursor();
    $ok = 1;

}else {
    $ok = 0;
}

echo $ok;

