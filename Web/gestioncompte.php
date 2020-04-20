<?php
//Le session Start doit être sur toute les pages
session_start();
if(!isset($_SESSION['compte'])) {
    header("Location:index.php");
}else
    $pseudo = $_SESSION['compte']['pseudo'];
    $image = "https://secure.gravatar.com/avatar/".md5($_SESSION['compte']['mail'])."?s=150&d=mp&r=g";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Gestion du compte | Votre Chat </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="icon" type="image/png" href="#">

    <link rel="stylesheet" href="content/css/bootstrap.min.css">
    <link rel="stylesheet" href="content/css/modal.css">

    <script src="content/js/jquery.min.js"></script>
    <script src="content/js/bootstrap.min.js"></script>
    <script src="content/js/gestioncompte.js?ver=2"></script>
    <script src="content/js/class.std.js"></script>

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
<div class="container-fluid hautpage">
    <h1>Votre Chat- Gestion de votre compte <?= $pseudo ?></h1>
</div>
<div class="container" style="padding-top: 10px">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading" style="padding-bottom: 190px">
                <div class="col-md-12 text-center">
                    <div class="card mx-auto">
                        <div class="card-header bg-light">
                            <div class="col-md-4">
                                <div class="text-center"><p>Votre Logo</p></div>
                                <img src="<?= $image ?>">
                            </div>
                            <div class="col-md-8">
                                <p style="padding: 30px">
                                    Dimension : <strong>(150 * 150)</strong>,<br>
                                    Pour avoir un logo sur notre site, créez-vous un compte sur
                                    <a href="https://fr.gravatar.com/" target="_blank">Gravatar</a> .<br>
                                    Vous aurez juste à y mettre votre logo et patienter 5 à 10 minutes
                                    le temps que notre serveur se mette à jour.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-12 text-center">
                    <div class="card mx-auto">

<!-- les informations utilisateurs -->
                        <div id='compte' class="card-body" style="padding: 10px;">
                            <div class="form-row">
                                <div class="form-group col-md-12 text-center ">
                                    <label>Adresse mail </label>
                                </div>
                                <div class="form-group col-md-2 "></div>
                                <div class="form-group col-md-6 ">
                                    <input id="email" class="form-control text-center" autocomplete="off" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <button data-modal-trigger="modalemail" class="modif__btn modif__btn_">Modifier</button>
                                </div>
                                <div class="form-group col-md-2"></div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12 text-center ">
                                    <label>Nom et Prénom </label>
                                </div>
                                <div class="form-group col-md-4 ">
                                    <input id="nom" class="form-control text-center" autocomplete="off" readonly>
                                </div>
                                <div class="form-group col-md-4 ">
                                    <input id="prenom" class="form-control text-center" autocomplete="off" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <button data-modal-trigger="modalnomprenom" class="modif__btn modif__btn_">Modifier</button>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4 text-center">
                                    <label>Grade </label>
                                    <input id="grade" class="form-control text-center" autocomplete="off" readonly>
                                </div>
                                <div class="form-group col-md-4 text-center">
                                    <label for="pseudo">Pseudo </label>
                                    <input id="pseudo" class="form-control text-center" autocomplete="off" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label></label>
                                    <button data-modal-trigger="modalpseudo" class="modif__btn modif__btn_">Modifier</button>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-10">
                                    <label>Mot de Passe</label>
                                    <input class="form-control text-center" value="Petit curieux ! Il doit déjà être dans ta tête..." readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label></label>
                                    <button data-modal-trigger="modalmdp" class="modif__btn modif__btn_">Modifier</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="note">Note / Description :</label>
                                <textarea id="note" class="form-control" rows="2"></textarea>
                                <span id='messageNote' class='text-danger'></span>
                            </div>


                            <div class="form-group col-md-6">
                                <button id='btnVNote' class="modif__btn modif__btn_">Modifier la Note / Desription</button>
                            </div>
                            <div class="form-group col-md-6">
                                <button  data-modal-trigger="modalSupprimerCompte" class="valider">Supprimer mon compte</button>
                            </div>





<!-- les modaux -->
                            <div class="modal" data-modal-name="modalemail">
                                <div class="modal__dialog">
                                    <header class="modal__header">
                                        <h3 class="modal__title"><label for="email">Modification de votre Email</label></h3>
                                    </header>
                                    <div class="modal__content">
                                        <div class="form-group col-md-12 ">
                                            <input id="inputEmail" class="form-control" autocomplete="off">
                                            <span id="messageInputEmail" class='text-danger'></span>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="annuler" data-modal-dismiss>Annuler</button>
                                        <button id='btnVEmail' class="valider">Modifier</button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal" data-modal-name="modalnomprenom">
                                <div class="modal__dialog">
                                    <header class="modal__header">
                                        <h3 class="modal__title"><label>Modification de votre nom et prénom</label></h3>
                                    </header>
                                    <div class="modal__content">
                                        <div class="form-row">
                                            <div class="form-group col-md-6 ">
                                                <label for="inputNom">Nom </label>
                                                <input id="inputNom" class="form-control" autocomplete="off">
                                            </div>
                                            <div class="form-group col-md-6 ">
                                                <label for="inputPrenom">Prénom </label>
                                                <input id="inputPrenom" class="form-control" autocomplete="off">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <div id="msgModalNomPrenom"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="annuler" data-modal-dismiss>Annuler</button>
                                        <button id='btnVNomPrenom' class="valider">Modifier</button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal" data-modal-name="modalpseudo">
                                <div class="modal__dialog">
                                    <header class="modal__header">
                                        <h3 class="modal__title"><label for="nom">Modification de votre Pseudo</label></h3>
                                    </header>
                                    <div class="modal__content">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <input id="inputPseudo" class="form-control" autocomplete="off">
                                                <span id='messageInputPseudo' class='text-danger'></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="annuler" data-modal-dismiss>Annuler</button>
                                        <button id='btnVPseudo' class="valider">Modifier</button>
                                    </div>
                                </div>
                            </div>

                            <div class="modal" data-modal-name="modalmdp">
                                <div class="modal__dialog">
                                    <header class="modal__header">
                                        <h3 class="modal__title"><label for="nom">Modification de votre Mot de Passe</label></h3>
                                    </header>
                                    <div class="modal__content">
                                        <div class="form-row">
                                            <div class="form-group col-md-12 ">
                                                <label for="ancienMdp">Ancien mot de passe</label>
                                                <input id="ancienMdp" type="password" class="form-control" autocomplete="off">
                                                <span id='messageAcienMdp' class='text-danger'></span>
                                            </div>
                                            <div class="form-group col-md-12 ">
                                                <label for="nouveauMdp">Nouveau mot de passe</label>
                                                <input id="nouveauMdp" type="password" class="form-control" autocomplete="off">
                                                <span id='messageNouveauMdp' class='text-danger'></span>
                                            </div>
                                            <div class="form-group col-md-12 ">
                                                <label for="cfmNouveauMdp">Confirmation du nouveau mot de Passe</label>
                                                <input id="cfmNouveauMdp" type="password" class="form-control" autocomplete="off">
                                                <span id='messageCfmNouveauMdp' class='text-danger'></span>
                                            </div>
                                            <div class="form-group col-md-12 ">
                                                <div id="msgModalMdp"></div>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="annuler" data-modal-dismiss>Annuler</button>
                                            <button id='btnVMdp' class="valider">Modifier</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal" data-modal-name="modalSupprimerCompte">
                                <div class="modal__dialog">
                                    <header class="modal__header">
                                        <h3 class="modal__title"><h3>Et tu sur de vouloir supprimer ton compte ?</h3>
                                    </header>
                                    <div class="modal__content">
                                        <div class="form-group col-md-12 ">
                                            <h2><strong>Cela seras irréversible</strong></h2>
                                        </div>
                                        <div class="form-group col-md-12 ">
                                            <div id="confirmersupprimer"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="annuler" data-modal-dismiss>Non</button>
                                        <button id='btnSupprimerCompte' class="valider">Oui</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require "content/nav/piedpage.php";
?>

<script src="content/js/modal.js"></script>

</body>
</html>