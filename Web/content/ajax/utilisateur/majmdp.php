<?php
require '../../class/class.database.inc.php';
$db = Database::getInstance();

// Récupération des variables

$email = $_POST['email'];
$ancienMdp = $_POST["ancienMdp"];
$nouveauMdp =  $_POST["nouveauMdp"];
$cfmNouveauMdp =  $_POST["cfmNouveauMdp"];

$nouveauMdpOk = preg_match("#^[a-zA-Z0-9]{4,16}$#", $nouveauMdp);

$ancienMdpHash = hash('sha256', $ancienMdp);
$nouveauMdpHash = hash('sha256', $nouveauMdp);

$sql = <<<EOD
   SELECT pswd
   FROM comptes 
   WHERE email = :email;
EOD;

$curseur = $db->prepare($sql);
$curseur->bindParam('email', $email);
$curseur->execute();
$ligne = $curseur->fetch(PDO::FETCH_ASSOC);
$curseur->closeCursor();


// Si l'ancien mot de passe n'est pas bon -> ok = 1
// Si les nouveaux mdp ne correspondent pas -> ok = 2
// Si tout est pareil, -> ok = 3
// Si le nouveau mdp n'est aps compris entre 4 est 16 caractères
// Si tout est bon -> ok = 5
if ($ligne['pswd'] != $ancienMdpHash){
    $ok = 1;
}elseif ($nouveauMdp != $cfmNouveauMdp) {
    $ok = 2;
}elseif ($nouveauMdp == $cfmNouveauMdp && $nouveauMdp == $ancienMdp) {
    $ok = 3;
}elseif (!$nouveauMdpOk){
    $ok = 4;
}
else {
    $sql = <<<EOD
    UPDATE comptes
    SET pswd = :nouveauMdpHash
    WHERE email = :email; 
EOD;

    $curseur = $db->prepare($sql);
    $curseur->bindParam('email', $email);
    $curseur->bindParam('nouveauMdpHash', $nouveauMdpHash);
    $curseur->execute();
    $curseur->closeCursor();
    $ok = 5;
}

echo $ok;

