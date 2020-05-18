<?php
//Le session Start doit être sur toute les pages
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Votre Chat | Accueil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="icon" type="image/ico" href="content/img/logo60x60.ico">

    <link rel="stylesheet" href="content/css/bootstrap.min.css">

    <script src="content/js/jquery.min.js"></script>
    <script src="content/js/bootstrap.min.js"></script>


</head>
<body>

<?php
require "content/nav/navbar.php";
?>

<div class="container-fluid hautpage" style="padding-top: 20px; padding-inline: 100px;">
    <div class="page-header">
        <h1>Projet SI6 - Gestion d'un compte</h1>
    </div>
    <p class="lead">C'est une page d'exemple</p>
    <p>Seulement le style général du site a été réalisé ; Des modifications auront lieu prochainement.</p>
</div>

<?php
require "content/nav/piedpage.php";
?>

</body>
</html>