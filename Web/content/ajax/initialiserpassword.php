<?php
session_start();
require '../class/class.database.inc.php';
$db = Database::getInstance();

// contrôle des données attendues
if (!isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['code'])) {
    echo "Accès interdit";
    exit;
}

// vérification de la robustesse du mot de passe
$password = $_POST['password'];
if (!preg_match('#^[a-zA-Z0-9]{4,16}$#', $password)) {
    echo "Accès interdit";
    exit;
}

// Vérifier si la durée de validité du code n'est pas dépassée
if (!isset($_COOKIE['code'])) {
    echo "Ce code n'est plus valide";
    unset($_SESSION['code']);
    exit;
}

// Vérifier l'exactitude du code
$code = $_POST['code'];
if ($code !== $_SESSION['code']) {
    echo  "code incorrect";
    exit;
}

// Mise à jour du mot de passe
$password = hash('sha256', $password);
$email = $_POST['email'];
$sql = <<<EOD
    update comptes
    set pswd = :password
    where email = :email
EOD;
$curseur = $db->prepare($sql);
$curseur->BindParam('email', $email);
$curseur-> bindParam('password', $password);
$curseur->execute();
unset($_SESSION['code']);
echo 1;


echo 0;
