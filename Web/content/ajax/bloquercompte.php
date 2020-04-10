<?php
session_start();
require '../class/class.database.inc.php';
$db = Database::getInstance();


$identifiant = $_POST["identifiant"];


$sql = <<<EOD
    UPDATE comptes
    SET typesstatus = 'Bloquer'
    WHERE comptes.email = :identifiant;
EOD;

$curseur = $db->prepare($sql);
$curseur->bindParam('identifiant', $identifiant);
$curseur->execute();
$curseur->closeCursor();






