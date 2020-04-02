<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Votre Chat  | Récupération du mot de passe</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="icon" type="image/png" href="#">

    <link rel="stylesheet" href="content/css/bootstrap.min.css">
    <link rel="stylesheet" href="content/css/identification.css">


    <script src="content/js/bootstrap.min.js"></script>
    <script src="content/js/jquery.min.js"></script>
    <script src="content/js/navbar.js"></script>

</head>
<body>

<?php
require "content/nav/navbar.php";
?>

<div class="container" style="padding-top: 100px">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
                <img class="profile-img" src="content/img/perso.png"
                     alt="logo par défaut utilisateur">
                <form class="form-signin">
                    <input type="text" class="form-control" placeholder="Votre adresse mail" required autofocus>
                    <div style="padding: 5px"></div>
                    <input type="text" class="form-control" placeholder="Confirmer votre adresse mail" required autofocus>
                    <div style="padding: 5px"></div>
                    <input type="password" class="form-control" placeholder="Mot de passe" required>
                    <input type="password" class="form-control" placeholder="Confirmer votre mot de passe" required>

                    <button class="btn btn-lg btn-primary btn-block" type="submit"> Crée</button>

                    <a href="recup.php" class="pull-right need-help">Mot de passe oublé ? </a><span class="clearfix"></span>
                </form>
                <a href="connexion.php" class="text-center new-account">Vous avez un compte ? Connectez vous ! </a>
            </div>
        </div>
    </div>
</div>
</div>
<?php
require "content/nav/piedpage.php";
?>

</body>
</html>