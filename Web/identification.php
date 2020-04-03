<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Votre Chat  | Connexion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="icon" type="image/png" href="#">

    <link rel="stylesheet" href="content/css/bootstrap.min.css">
    <link rel="stylesheet" href="content/css/identification.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>


    <script src="content/js/identification.js"></script>
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
        <div class="cont">
            <div class="form sign-in">
                <h2>Connexion</h2>
                <label>
                    <span>Adresse e-mail</span>
                    <input type="email" />
                </label>
                <label>
                    <span>Mot de passe</span>
                    <input type="password" />
                    <button class="unmask" type="button" title="Masquer/Demasquer le mot de passe">Démasquer</button>
                </label>
                <p class="forgot-pass">Mot de passe oublié ?</p>
                <button type="button" class="submit">Se connecter</button>
            </div>
            <div class="sub-cont">
                <div class="img">
                    <div class="img__text m--up">
                        <h2>Vous n'avez pas encore de compte?</h2>
                        <p>Inscrivez-vous dès maintenant <b>sans aucunes informations personnelles</b> pour accéder à nos services</p>
                    </div>
                    <div class="img__text m--in">
                        <h2>Déjà inscrit ?</h2>
                        <p>Vous avez déjà un compte ? Connectez-vous en cliquant sur ce bouton ! </p>
                    </div>
                    <div class="img__btn">
                        <span class="m--up">S'inscrire</span>
                        <span class="m--in">Connexion</span>
                    </div>
                </div>
                <div class="form sign-up">
                    <h2>Inscription</h2>
                    <label>
                        <span>Pseudo</span>
                        <input type="text" id="pseudo"/>
                    </label>
                    <label>
                        <span>Adresse e-mail</span>
                        <input type="email" id="email" />
                    </label>
                    <label>
                        <span>Mot de passe</span>
                        <input type="password" value="" id="password"/>
                    </label>
                    <label>
                        <span>Répetez le mot de passe</span>
                        <input type="password" value="" id="passwordcheck"/>
                    </label>
                    <button type="button" class="submit">S'inscrire</button>

                </div>
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