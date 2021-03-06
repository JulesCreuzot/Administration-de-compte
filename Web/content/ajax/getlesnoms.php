<?php
require '../class/class.database.inc.php';
$db = Database::getInstance();
$sql = <<<EOD
        Select id, concat(nom, ' ', prenom) as nomPrenom 
        from comptes
        where nom is not null
        order by nom, prenom;
EOD;
$curseur = $db->query($sql);
$lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);
$curseur->closeCursor();
echo json_encode($lesLignes);