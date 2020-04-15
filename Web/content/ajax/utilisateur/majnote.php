<?php
require '../../class/class.database.inc.php';
$db = Database::getInstance();

// Récupération des variables

$email = $_POST["email"];
$note =  $_POST["note"];

$sql = <<<EOD
   SELECT description
   FROM comptes 
   WHERE email = :email;
EOD;

$curseur = $db->prepare($sql);
$curseur->bindParam('email', $email);
$curseur->execute();
$ligne = $curseur->fetch(PDO::FETCH_ASSOC);
$curseur->closeCursor();

if ($note != $ligne['description']) {
    $ok = 1;
    $sql = <<<EOD
    UPDATE comptes
    SET description = :note
    WHERE email = :email; 
EOD;

    $curseur = $db->prepare($sql);
    $curseur->bindParam('email', $email);
    $curseur->bindParam('note', $note);
    $curseur->execute();
    $curseur->closeCursor();

}else {
    $ok = 0;
}

echo $ok;

