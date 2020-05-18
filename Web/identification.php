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
    <link rel="icon" type="image/ico" href="content/img/logo60x60.ico">

    <link rel="stylesheet" href="content/css/bootstrap.min.css">
    <link rel="stylesheet" href="content/css/identification.css">
    <link rel="stylesheet" href="content/css/modal.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>

    <script src="content/js/class.std.js"></script>
    <script src="content/js/jquery.min.js"></script>
    <script src="content/js/bootstrap.min.js"></script>
    <script src="content/js/oublimotdepasse.js"></script>

</head>
<body>

<?php
require "content/nav/navbar.php";
?>

<div class='popup' style="padding-top: 100px">
    <div class='text__popup'>
        <h1>Modification éffectué</h1>
        <p><a href="" class='fermer'>Fermer</a></p>
    </div>
</div>

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
                    <!-- <button class="unmask" type="button" title="Masquer/Demasquer le mot de passe">Démasquer</button> -->
                </label>
                <div class="forgot-pass">
                    <p data-modal-trigger="modalOublieMdp" >Mot de passe oublié ?</p>
                </div>
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
                        <input id="inscriptionMail" type="email" />
                        <span id='msgInscriptionMail' class='text-danger'></span>
                    </label>
                    <label>
                        <span>Confirmation d'adresse e-mail</span>
                        <input id="inscriptionMsgConfirmMail" type="email" />
                        <span id='msgInscriptionConfirmMail' class='text-danger'></span>
                    </label>
                    <label>
                        <span>Mot de passe</span>
                        <input id="inscriptionPassword" type="password" />
                        <span id='msgInscriptionPswd' class='text-danger'></span>
                    </label>
                    <label>
                        <span>Répetez le mot de passe</span>
                        <input id="inscriptionConfirmerPassword" type="password"/>
                        <span id='inscriptionMsgConfirmPassword' class='text-danger'></span>
                        <div id="msgInscription"></div>
                    </label>
                    <button id="btnInscription" type="button" class="submit">S'inscrire</button>
                </div>
            </div>
        </div>
        <div class="modal" data-modal-name="modalOublieMdp">
            <div class="modal__dialog">
                <header class="modal__header">
                    <h3 class="modal__title"><label for="email">Mot de passe oublié ?</label></h3>
                </header>
                <div class="modal__content">
                    <div id="message" class="text-center"></div>
                    <div id="msgEnvoieMail"></div>
                    <div id="zone1">
                        <div class="form-group col-md-12 ">
                            <label for="envoiMail">Entrer votre Email</label>
                            <input id="envoiMail" class="form-control" >
                            <span id="messageEnvoiMail" class='text-danger' style="text-align: center"></span>
                        </div>

                        <div style="padding-top: 10px"></div>
                        <div class="col-md-5">
                            <button class="btn btn-info" data-modal-dismiss >Annuler</button>
                        </div>
                        <div class="col-md-5">
                            <button id='btnOublieMdp' class="btn btn-danger">Envoyer</button>
                        </div>
                        <div style="padding-top: 10px"></div>
                    </div>

                    <div id="zone2">
                        <div class="form-group col-md-12">
                            <label for="code">Code reçu par mail</label>
                            <input id="code" class="form-control" >
                            <span id="messageCode" class='text-danger'></span>
                            <label for="inputNewMdp">Nouveau Mot de passe</label>
                            <input id="inputNewMdp" class="form-control" type="password">
                            <span id="messageInputNewMdp" class='text-danger'></span>
                            <label for="inputCfrmNewMdp">Confirmation du nouveau Mot de passe</label>
                            <input id="inputCfrmNewMdp" class="form-control" type="password">
                            <span id="messageInputCfrmNewMdp" class='text-danger'></span>
                        </div>
                        <div style="padding-top: 10px"></div>
                        <div class="col-md-5">
                            <button class="btn btn-info" data-modal-dismiss >Annuler</button>
                        </div>
                        <div class="col-md-5">
                            <button id='btnChangerMdp' class="btn btn-danger">Modifier</button>
                        </div>
                        <div style="padding-top: 10px"></div>

                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>
    <div class="col-sm-2"></div>
</div>

<?php
require "content/nav/piedpage.php";
?>

<script src="content/js/identification.js?ver=6"></script>
<script src="content/js/modal.js"></script>

</body>
</html>
