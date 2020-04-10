<?php
//Le session Start doit être sur toute les pages
session_start();
if(isset($_SESSION['compte'])) {
    header("Location:index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Votre Chat  | Identification</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="icon" type="image/png" href="#">

    <link rel="stylesheet" href="content/css/bootstrap.min.css">
    <link rel="stylesheet" href="content/css/identification.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>

    <script src="content/js/class.std.js"></script>
    <script src="content/js/jquery.min.js"></script>
    <script src="content/js/bootstrap.min.js"></script>




</head>
<body>

<?php
require "content/nav/navbar.php";
?>

<div class="container" style="padding-top: 50px">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="cont">
            <div class="form sign-in">
                <h2>Connexion</h2>
                <label for="email" class="text-info">
                    <span>Adresse e-mail</span>
                    <input id="identifiant" type="email" />
                    <span id='messageConnexion' class='text-danger'></span>
                </label>
                <label for="mdp" class="text-info">
                    <span>Mot de passe</span>
                    <input id="psswd" type="password" />
                    <span id='messageMotDePasse' class='text-danger'></span>
                    <div id="msgConnexion"></div>
                    <button id="mdp" class="unmask" type="button" title="Masquer/Demasquer le mot de passe">Démasquer</button>
                </label>
                <p class="forgot-pass">Mot de passe oublié ?</p>
                <button id='btnConnexion' type="button" class="submit">Se connecter</button>
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
                        <span>Adresse e-mail</span>
                        <input type="text" id="email"/>
                    </label>
                    <label>
                        <span>Confirmation d'adresse e-mail</span>
                        <input type="email" id="emailverif" />
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
    <div class="col-sm-2"></div>
</div>


<?php
require "content/nav/piedpage.php";
?>

<script src="content/js/identification.js?ver=2"></script>
</body>
</html>
