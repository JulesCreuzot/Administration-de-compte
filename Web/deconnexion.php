<?php
//Le session Start doit être sur toute les pages
session_start();
if(!isset($_SESSION['compte'])) {
    header("Location:index.php");
}
else {
    // supprimer le contenu du tableau $_SESSION
    session_unset();
    // supprimer le tableau $_SESSION
    session_destroy();
    // redirection vers l'index.php
    //header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Votre Chat | Déconnexion </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="icon" type="image/png" href="#">

    <link rel="stylesheet" href="content/css/bootstrap.min.css">

    <script src="content/js/jquery.min.js"></script>
    <script src="content/js/bootstrap.min.js"></script>


</head>
<body>

<?php
require "content/nav/navbar.php";
?>

<div class="container-fluid" style="padding-top: 100px">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="alert alert-danger text-center">
                Vous allez être rediriger vers l'accueil dans quelque instant<br>
                et <strong>déconnecter</strong>.<br>
                Il est conseillé de fermer toutes les fenêtres de navigation.
            </div>
            <meta http-equiv="Refresh" content="5; url=index.php" />
        </div>
        <div class="col-md-4"></div>
    </div>
</div>

<?php
require "content/nav/piedpage.php";
?>

</body>
</html>
<?php
exit;
?>