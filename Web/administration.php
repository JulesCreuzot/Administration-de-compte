<?php
//Le session Start doit être sur toute les pages
session_start();
if(!isset($_SESSION['compte']) || !($_SESSION['compte']['libellecomptes'] === "Administrateur") ) {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Administration | Votre Chat </title>
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
    <div class="page-header">
        <h1>Votre Chat- Administration des comptes</h1>
    </div>
</div>

<div class="container" style="padding-top: 10px">
    <div class="col-sm-2">
    </div>
    <!-- La recherhe -->
    <div class="col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading" style="padding-bottom: 150px">
                <div class="col-md-12 text-center">
                    <div class="card mx-auto">
                        <div class="card-header bg-light">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nomR">Rechercher avec le nom </label>
                                    <input id="nomR" class="form-control" autocomplete="off">
                                    <span id='messageNomR' class='text-danger'></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pseudoR">Rechercher avec le pseudo </label>
                                    <input id="pseudoR" class="form-control" autocomplete="off">
                                    <span id='messagePseudoR' class='text-danger'></span>
                                </div>
                            </div>
                        </div>

                        <div class="card-header bg-light">
                            <div class="form-row">
                                <div class="form-group col-md-12 ">
                                    <label for="emailR">Rechercher avec l'adresse mail </label>
                                    <input id="emailR" class="form-control" autocomplete="off">
                                    <span id='messageEmailR' class='text-danger'></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- L'affichage des informations de l'utilisateurs -->
            <div class="panel-body">
                <div class="col-md-12 text-center">
                    <div class="card mx-auto">
                        <div id='compte' class="card-body" style="padding: 10px;">
                            <div class="card-header col-md-12">
                                    <div class="text-center"><p>Sons Logo</p></div>
                                    <img src="content/img/logodefaut.png">
                                    <p style="padding: 30px">
                                        Dimension : <strong>(150 * 150)</strong>,<br>
                                        Il à été crée sur le site <a href="https://fr.gravatar.com/" target="_blank">Gravatar</a> .<br>
                                    </p>
                            </div>
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
                                    <label> Pseudo </label>
                                </div>
                                <div class="form-group col-md-4 "></div>
                                <div class="form-group col-md-4 ">
                                    <input id="pseudo" class="form-control text-center" autocomplete="off" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <button data-modal-trigger="modalpseudo" class="modif__btn modif__btn_">Modifier</button>
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
                                    <label for="status"> Status </label>
                                    <input id="status" class="form-control text-center" autocomplete="off" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label></label>
                                    <button data-modal-trigger="modalgradestatus" class="modif__btn modif__btn_">Modifier</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="note">Note / Desription :</label>
                                <textarea class="form-control" rows="3" id="note"></textarea>
                                <span id='messageNote' class='text-danger'></span>
                            </div>

                            <!-- Les modaux -->
                            <div class="modal" data-modal-name="modalemail">
                                <div class="modal__dialog">
                                    <header class="modal__header">
                                        <h3 class="modal__title"><label for="email">Modification l'Email</label></h3>
                                    </header>
                                    <div class="modal__content">
                                        <div class="form-group col-md-12 ">
                                            <input id="inputEmail" class="form-control" autocomplete="off">
                                            <span id='messageInputEmail' class='text-danger'></span>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="annuler" data-modal-dismiss>Annuler</button>
                                        <button id='btnSupprimer' class="valider">Modifier</button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal" data-modal-name="modalpseudo">
                                <div class="modal__dialog">
                                    <header class="modal__header">
                                        <h3 class="modal__title"><label for="Pseudo">Modification du Pseudo</label></h3>
                                    </header>
                                    <div class="modal__content">
                                        <div class="form-group col-md-12 ">
                                            <input id="inputPseudo" class="form-control" autocomplete="off">
                                            <span id='messageInputEmail' class='text-danger'></span>
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
                                        <h3 class="modal__title"><label>Modification due nom et du prénom</label></h3>
                                    </header>
                                    <div class="modal__content">
                                        <div class="form-row">
                                            <div class="form-group col-md-6 ">
                                                <label for="inputNom">Nom </label>
                                                <input id="inputNom" class="form-control" autocomplete="off">
                                                <span id='messageInputNom' class='text-danger'></span>
                                            </div>
                                            <div class="form-group col-md-6 ">
                                                <label for="inputPrenom">Prénom </label>
                                                <input id="inputPrenom" class="form-control" autocomplete="off">
                                                <span id='messageInputPrenom' class='text-danger'></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="annuler" data-modal-dismiss>Annuler</button>
                                        <button id='valider' class="valider">Modifier</button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal" data-modal-name="modalgradestatus">
                                <div class="modal__dialog">
                                    <header class="modal__header">
                                        <h3 class="modal__title"><label>Modification du status et du grade</label></h3>
                                    </header>
                                    <div class="modal__content">
                                        <div class="form-row">
                                            <div class="form-group col-md-6 ">
                                                <label for="grade">Rangs </label>
                                                <select class="form-control text-center" id="grade">
                                                    <option value="Administrateur">Administrateur</option>
                                                    <option value="Visiteur">Visiteur</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="status">Status</label>
                                                <select class="form-control text-center" id="status">
                                                    <option value="Valide">Valide</option>
                                                    <option value="Bloquer">Bloquer</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="annuler" data-modal-dismiss>Annuler</button>
                                        <button id='valider' class="valider">Modifier</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Les Boutons -->
                            <div class="text-center">
                                <button id='btnModifier' class="btn btn-danger">Modifier la note</button>
                                <button data-modal-trigger="modalmdp" class="btn btn-danger">Modifier le mot de passe</button>
                                <button id='btnSupprimer' class="btn btn-danger">Supprimer le compte</button>
                            </div>

                            <!-- Le modal du mot de passe -->
                            <div class="modal" data-modal-name="modalmdp">
                                <div class="modal__dialog">
                                    <header class="modal__header">
                                        <h3 class="modal__title"><label for="nom">Modification du Mot de Passe</label></h3>
                                    </header>
                                    <div class="modal__content">
                                        <div class="form-row">
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

                            <div id="msg"></div>
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