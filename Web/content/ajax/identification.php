<?php
session_start();
require '../class/class.database.inc.php';
$db = Database::getInstance();


$identifiant = $_POST["identifiant"];
$MotDePasse =  $_POST["psswd"];

// vérification du l'existence du compte

$sql = <<<EOD
   SELECT email, pswd, pseudo, libellecomptes, nbtentative
   FROM comptes 
   WHERE email = :identifiant;
EOD;

$curseur = $db->prepare($sql);
$curseur->bindParam('identifiant', $identifiant);
$curseur->execute();
$ligne = $curseur->fetch(PDO::FETCH_ASSOC);
$curseur->closeCursor();

//Si rien n'est bon, ok = 0
// Si l'identification est bonne, ok = 1
//Si mdp pas bon et nb tentative < 4, ok = 0
//si mdp bon et nbtentative >= 4, ok = 2
//si mdp pas bon est nbtentative >= 4, ok = 3
//si mdp pas bon et nbtentative > 4, ok = 4

if (!$ligne) {
    $ok = 0;
} elseif ($ligne['pswd'] != $MotDePasse && $ligne['nbtentative'] < 3) {
    $ok = 0;
}elseif ($ligne['pswd'] != $MotDePasse && $ligne['nbtentative'] >= 3 ) {
    $ok = 3;
}elseif ($ligne['nbtentative'] >= 3) {
    $ok = 2;
}else {
    $_SESSION['compte']['mail'] = $identifiant;
    $_SESSION['compte']['libellecomptes'] = $ligne['libellecomptes'];
    $_SESSION['compte']['pseudo'] = $ligne['pseudo'];
    $ok = 1;
}

if ($ok === 0) {
    $sql = <<<EOD
    UPDATE comptes
    SET nbtentative = nbtentative + 1
    WHERE email = :identifiant;
EOD;
    $curseur = $db->prepare($sql);
    $curseur->bindParam('identifiant', $identifiant);
    $curseur->execute();
    $curseur->closeCursor();
}

echo $ok;





