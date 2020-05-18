<?php
require '../class/class.database.inc.php';
$db = Database::getInstance();
$sql = <<<EOD
        Select id, pseudo
        from comptes
        where pseudo is not null;
EOD;
$curseur = $db->query($sql);
$lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);
$curseur->closeCursor();
echo json_encode($lesLignes);