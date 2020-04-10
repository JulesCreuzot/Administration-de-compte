<?php
//Le session Start doit être sur toute les pages
session_start();
if(!isset($_SESSION['compte'])) {
    header("Location:index.php");
}else
    $mail = $_SESSION['compte']['mail'];
$pseudo = $_SESSION['compte']['pseudo'];
$grade = $_SESSION['compte']['libellecomptes'];
$image = "https://secure.gravatar.com/avatar/".md5($mail)."?s=150&";
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


</head>
<body>

<?php
require "content/nav/navbar.php";
?>

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
                                    Pour avoir un logo sur notre site, il vous suffit de crée un compte sur
                                    <a href="https://fr.gravatar.com/" target="_blank">Gravatar</a> .<br>
                                    Vous aurrez juste à y mettre votre logo et patienter 5 à 10 minutes
                                    le temps que notre serveur trouve votre logo chez eux.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-12 text-center">
                    <div class="card mx-auto">
                        <div id='compte' class="card-body" style="padding: 10px;">
                            <div class="form-row">
                                <div class="form-group col-md-12 text-center ">
                                    <label>Adresse mail </label>
                                </div>
                                <div class="form-group col-md-2 "></div>
                                <div class="form-group col-md-6 ">
                                    <input id="email" class="form-control text-center" autocomplete="off" value="<?= $mail ?>" readonly>
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
                                    <input id="nom" class="form-control" autocomplete="off" readonly>
                                </div>
                                <div class="form-group col-md-4 ">
                                    <input id="prenom" class="form-control" autocomplete="off" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <button data-modal-trigger="modalnomprenom" class="modif__btn modif__btn_">Modifier</button>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4 text-center">
                                    <label>Grade </label>
                                    <input class="form-control " autocomplete="off"  value="<?= $grade ?>" readonly>
                                </div>
                                <div class="form-group col-md-4 text-center">
                                    <label for="pseudo">Pseudo </label>
                                    <input id="pseudo" class="form-control" autocomplete="off" value="<?= $pseudo ?>" readonly>
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
                                <label for="note">Note / Desription :</label>
                                <textarea id="note" class="form-control" rows="2"></textarea>
                                <span id='messageNote' class='text-danger'></span>
                            </div>

                            <div class="text-center">
                                <button id='annuler' class="btn btn-danger">Modifier la note</button>
                                <button id='btnSupprimer' class="btn btn-danger">Supprimer mon compte</button>
                            </div>

                            <div class="modal" data-modal-name="modalemail">
                                <div class="modal__dialog">
                                    <header class="modal__header">
                                        <h3 class="modal__title"><label for="email">Modification de votre Email</label></h3>
                                    </header>
                                    <div class="modal__content">
                                        <div class="form-group col-md-12 ">
                                            <input id="email" class="form-control" value="<?= $mail ?>" autocomplete="off">
                                            <span id='messageEmail' class='text-danger'></span>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="annuler" data-modal-dismiss>Annuler</button>
                                        <button id='btnSupprimer' class="valider">Modifier</button>
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
                                                <label for="nom">Nom </label>
                                                <input id="nom" class="form-control" autocomplete="off">
                                                <span id='messageNom' class='text-danger'></span>
                                            </div>
                                            <div class="form-group col-md-6 ">
                                                <label for="prenom">Prénom </label>
                                                <input id="prenom" class="form-control" autocomplete="off">
                                                <span id='messagePrenom' class='text-danger'></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="annuler" data-modal-dismiss>Annuler</button>
                                        <button id='valider' class="valider">Modifier</button>
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
                                                <input id="pseudo" class="form-control" autocomplete="off" value="<?= $pseudo ?>">
                                                <span id='messagePseudo' class='text-danger'></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="annuler" data-modal-dismiss>Annuler</button>
                                        <button id='btnSupprimer' class="valider">Modifier</button>
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
                                                <span id='messageAncienMdp' class='text-danger'></span>
                                            </div>
                                            <div class="form-group col-md-12 ">
                                                <label for="nouveauMdp">Nouveau mot de passe</label>
                                                <input id="nouveauMdp" type="password" class="form-control" autocomplete="off">
                                                <span id='messageNouveauMdp' class='text-danger'></span>
                                            </div>
                                            <div class="form-group col-md-12 ">
                                                <label for="CfmNouveauMdp">Confirmation du nouveau mot de Passe</label>
                                                <input id="CfmNouveauMdp" type="password" class="form-control" autocomplete="off">
                                                <span id='messageCfmNouveauMdp' class='text-danger'></span>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="annuler" data-modal-dismiss>Annuler</button>
                                            <button id='btnSupprimer' class="valider">Modifier</button>
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
</div>



    <?php
    require "content/nav/piedpage.php";
    ?>

    <script src="content/js/modal.js"></script>

</body>
</html>