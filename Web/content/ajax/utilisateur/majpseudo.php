<?php
require '../../class/class.database.inc.php';
$db = Database::getInstance();

// Récupération des variables

$email = $_POST['email'];
$pseudo = $_POST["pseudo"];
$inputPseudo =  $_POST["inputPseudo"];

$sql = <<<EOD
   SELECT pseudo
   FROM comptes 
   WHERE email = :email;
EOD;

$curseur = $db->prepare($sql);
$curseur->bindParam('email', $email);
$curseur->execute();
$ligne = $curseur->fetch(PDO::FETCH_ASSOC);
$curseur->closeCursor();

if ($pseudo != $inputPseudo && $inputPseudo != $ligne['pseudo'] ) {
    $sql = <<<EOD
    UPDATE comptes
    SET pseudo = :pseudo
    WHERE email = :email; 
EOD;

    $curseur = $db->prepare($sql);
    $curseur->bindParam('email', $email);
    $curseur->bindParam('pseudo', $inputPseudo);
    $curseur->execute();
    $curseur->closeCursor();
    $ok = 1;

}else {
    $ok = 0;
}

echo $ok;

