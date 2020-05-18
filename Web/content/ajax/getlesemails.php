<?php
require '../class/class.database.inc.php';
$db = Database::getInstance();
$sql = <<<EOD
        Select id, email
        from comptes
        where email is not null;
EOD;
$curseur = $db->query($sql);
$lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);
$curseur->closeCursor();
echo json_encode($lesLignes);