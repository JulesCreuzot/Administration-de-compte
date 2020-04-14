<?php
session_start();
require '../class/class.database.inc.php';
$db = Database::getInstance();

$identifiant = $_SESSION['compte']['mail'];

$sql = <<<EOD
   SELECT email, nom, prenom, libelleComptes, pseudo, description
   FROM comptes 
   WHERE email = :identifiant;
EOD;

$curseur = $db->prepare($sql);
$curseur->bindParam('identifiant', $identifiant);
$curseur->execute();
$ligne = $curseur->fetch(PDO::FETCH_ASSOC);
$curseur->closeCursor();
echo json_encode($ligne);