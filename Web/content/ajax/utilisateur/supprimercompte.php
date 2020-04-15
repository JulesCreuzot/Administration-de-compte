<?php
session_start();
// supprimer le contenu du tableau $_SESSION
session_unset();
// supprimer le tableau $_SESSION
session_destroy();
require '../../class/class.database.inc.php';
$db = Database::getInstance();

$email = $_POST["email"];

$sql = <<<EOD
    DELETE
    from comptes
    where email = :email
EOD;

$curseur = $db->prepare($sql);
$curseur->bindParam('email', $email);
$curseur->execute();
$curseur->closeCursor();
$ok = 1;

echo $ok;

