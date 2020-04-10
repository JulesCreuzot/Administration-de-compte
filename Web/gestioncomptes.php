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

    <script src="content/js/jquery.min.js"></script>
    <script src="content/js/bootstrap.min.js"></script>
    <script src="content/js/logo.js"></script>

</head>
<body>

<?php
require "content/nav/navbar.php";
?>

<div class="container-fluid" style="padding-top: 20px; padding-inline: 100px;">
    <div class="page-header">
        <h1>Votre Chat- Gestion de votre compte <?= $pseudo ?></h1>
    </div>
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
                                Dimension maximum : <br>
                                <strong>(150 * 150)</strong>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center"><p>Votre Logo</p></div>
                                <img src="<?= $image ?>">
                            </div>
                            <div class="col-md-4">
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
                                <div class="form-group col-md-6">
                                    <label for="pseudo">Grade </label>
                                    <input id="pseudo" class="form-control  text-center" autocomplete="off"  value="<?= $grade ?>" readonly>
                                    <span id='messagePseudo' class='text-danger'></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pseudo">Pseudo </label>
                                    <input id="pseudo" class="form-control" autocomplete="off" value="<?= $pseudo ?>">
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
                                    <label for="mdp">Confirmation du Mot de Passe</label>
                                    <input id="mdp" type="password" class="form-control" autocomplete="off">
                                    <span id='messageMdp' class='text-danger'></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="note">Note / Desription :</label>
                                <textarea class="form-control" rows="3" id="note"></textarea>
                                <span id='messageNote' class='text-danger'></span>
                            </div>


                            <div class="text-center">
                                <button id='btnModifier' class="btn btn-danger">Modifier</button>
                                <button id='btnSupprimer' class="btn btn-danger">Supprimer mon compte</button>
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