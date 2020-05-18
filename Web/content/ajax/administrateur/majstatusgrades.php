<?php
require '../../class/class.database.inc.php';
$db = Database::getInstance();

// Récupération des variables

$email = $_POST["inputEmail"];
$grade = $_POST["modalGrade"];
$status = $_POST["status"];

$sql = <<<EOD
   SELECT libelleComptes, typesstatus
   FROM comptes 
   WHERE email = :email;
EOD;

$curseur = $db->prepare($sql);
$curseur->bindParam('email', $email);
$curseur->execute();
$ligne = $curseur->fetch(PDO::FETCH_ASSOC);
$curseur->closeCursor();

if ($status != $ligne['typesstatus'] && $grade != $ligne['libelleComptes'] && $status == 'Valide') {
    $ok = 1;
    $sql = <<<EOD
    UPDATE comptes
    SET libelleComptes = :grade,
        typesstatus = :status,
        nbtentative = '0'
    WHERE email = :email;
    
EOD;
    $curseur = $db->prepare($sql);
    $curseur->bindParam('email', $email);
    $curseur->bindParam('grade', $grade);
    $curseur->bindParam('status', $status);
    $curseur->execute();
    $curseur->closeCursor();
} else if ($status != $ligne['typesstatus'] && $grade != $ligne['libelleComptes'] && $status == 'Bloquer') {
    $ok = 1;
    $sql = <<<EOD
    UPDATE comptes
    SET libelleComptes = :grade,
        typesstatus = :status,
        nbtentative = '3'
    WHERE email = :email;
EOD;
    $curseur = $db->prepare($sql);
    $curseur->bindParam('email', $email);
    $curseur->bindParam('grade', $grade);
    $curseur->bindParam('status', $status);
    $curseur->execute();
    $curseur->closeCursor();
} else if ($grade != $ligne['libelleComptes'] && $status == $ligne['typesstatus']) {
    $ok = 1;
    $sql = <<<EOD
    UPDATE comptes
    SET libelleComptes = :grade
    WHERE email = :email; 
EOD;
    $curseur = $db->prepare($sql);
    $curseur->bindParam('email', $email);
    $curseur->bindParam('grade', $grade);
    $curseur->execute();
    $curseur->closeCursor();
} else if ($status != $ligne['typesstatus'] && $grade == $ligne['libelleComptes'] && $status == 'Valide') {
    $ok = 2;
    $sql = <<<EOD
    UPDATE comptes
    SET typesstatus = :status,
        nbtentative = '0'
    WHERE email = :email; 
EOD;

    $curseur = $db->prepare($sql);
    $curseur->bindParam('email', $email);
    $curseur->bindParam('status', $status);
    $curseur->execute();
    $curseur->closeCursor();
} else if ($status != $ligne['typesstatus'] && $grade == $ligne['libelleComptes'] && $status == 'Bloquer') {
    $ok = 1;
    $sql = <<<EOD
    UPDATE comptes
    SET typesstatus = :status,
        nbtentative = '3'
    WHERE email = :email; 
EOD;
    $curseur = $db->prepare($sql);
    $curseur->bindParam('email', $email);
    $curseur->bindParam('status', $status);
    $curseur->execute();
    $curseur->closeCursor();
} else {
    $ok = 0;
}

echo $ok;

