<?php
require '../class/class.database.inc.php';
$db = Database::getInstance();

// récupération du paramètre
$id = $_POST['id'];

$sql = <<<EOD
        SELECT email, nom, prenom, typesstatus, nbtentative, pseudo, pswd, libellecomptes, description
        FROM comptes
        where id = :id;
EOD;
$curseur = $db->prepare($sql);
$curseur->bindParam('id', $id);
$curseur->execute();
$ligne = $curseur->fetch(PDO::FETCH_ASSOC);
$curseur->closeCursor();
echo json_encode($ligne);


