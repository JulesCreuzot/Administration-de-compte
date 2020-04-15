<?php
session_start();
require '../../class/class.database.inc.php';
$db = Database::getInstance();

// Récupération des variables

$email = $_POST["email"];
$inputEmail =  $_POST["inputEmail"];
$formatMailOk = preg_match("#^[a-z0-9.-]+@[a-z0-9._-]{2,}.[a-z]{2,4}$#", $inputEmail);

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

if ($email != $inputEmail && $inputEmail != $ligne['email'] && $formatMailOk) {
    $_SESSION['compte']['mail'] = $inputEmail;
    $sql = <<<EOD
    UPDATE comptes
    SET email = :inputEmail
    WHERE email = :email; 
EOD;

    $curseur = $db->prepare($sql);
    $curseur->bindParam('inputEmail', $inputEmail);
    $curseur->bindParam('email', $email);
    $curseur->execute();
    $curseur->closeCursor();
    $ok = 1;

}
elseif (!$formatMailOk){
    $ok = 2;
}
else {
    $ok = 0;
}

echo $ok;

