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
    <link rel="stylesheet" href="content/css/administration.css">
    <link rel="stylesheet" href="content/css/jquery-confirm.min.css">
    <link rel="stylesheet" href="content/css/easy-autocomplete.min.css">


    <script src="content/js/jquery.min.js"></script>
    <script src="content/js/jquery-confirm.min.js"></script>
    <script src="content/js/jquery.easy-autocomplete.min.js"></script>
    <script src="content/js/bootstrap.min.js"></script>

</head>
<body>

<?php
require "content/nav/navbar.php";
?>

<div class="container-fluid" style="padding-top: 20px; padding-inline: 100px;">
    <div class="page-header">
        <h1>Votre Chat- Administration des comptes</h1>
    </div>
</div>

<div class="container" style="padding-top: 10px">
    <div class="col-sm-2">
    </div>
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
            <div class="panel-body">
                <div class="col-md-12 text-center">
                    <div class="card mx-auto">

                        <div id='compte' class="card-body" style="padding: 10px;">
                            <div class="form-row">
                                <div class="form-group col-md-12 ">
                                    <label for="email">Adresse mail </label>
                                    <input id="email" class="form-control" autocomplete="off">
                                    <span id='messageEmail' class='text-danger'></span>
                                </div>
                            </div>
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

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status">
                                        <option value="V">Valide</option>
                                        <option value="B">Bloquer</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="nbessaie">Nombre d'essaie </label>
                                    <input id="nbessaie" class="form-control" autocomplete="off" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pseudo">Pseudo </label>
                                    <input id="pseudo" class="form-control" autocomplete="off">
                                    <span id='messagePseudo' class='text-danger'></span>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 ">
                                    <label for="mdp">Mot de Passe</label>
                                    <input id="mdp" type="password" class="form-control" autocomplete="off">
                                    <span id='messageMdp' class='text-danger'></span>
                                </div>
                                <div class="form-group col-md-6 ">
                                    <label for="grade">Rangs </label>
                                    <select class="form-control" id="grade">
                                        <option value="Admin">Administrateur</option>
                                        <option value="User">Visiteur</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="note">Note / Desription :</label>
                                <textarea class="form-control" rows="3" id="note"></textarea>
                                <span id='messageNote' class='text-danger'></span>
                            </div>


                            <div class="text-center">
                                <button id='btnModifier' class="btn btn-danger">Modifier</button>
                                <button id='btnSupprimer' class="btn btn-danger">Supprimer</button>
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

</body>
</html>