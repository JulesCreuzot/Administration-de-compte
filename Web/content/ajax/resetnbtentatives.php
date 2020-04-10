<?php
require '../class/class.database.inc.php';
$db = Database::getInstance();


$identifiant = $_POST["identifiant"];

$sql = <<<EOD
    UPDATE comptes
    SET nbtentative = '0'
    WHERE email = :identifiant;
EOD;

$curseur = $db->prepare($sql);
$curseur->bindParam('identifiant', $identifiant);
$curseur->execute();
$curseur->closeCursor();






