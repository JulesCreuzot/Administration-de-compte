<?php
//Le session Start doit être sur toute les pages
session_start();
if($_SESSION['compte']) {
    $pseudo = $_SESSION['compte']['pseudo'];
}
else {
    header("Location:index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Votre Chat | Chat</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="icon" type="image/png" href="#">

    <link rel="stylesheet" href="content/css/bootstrap.min.css">
    <link rel='stylesheet' href='content/css/chatfontawesome.min.css'>
    <link rel="stylesheet" href="content/css/chat.css">
    <link rel="stylesheet" href="content/css/chatpolice.css">

    <script src="content/js/jquery.min.js"></script>
    <script src="content/js/bootstrap.min.js"></script>

</head>
<body>

<?php
require "content/nav/navbar.php";
?>

<div class="container-fluid" style="padding-top: 20px; padding-inline: 40px;">
    <ol class="chat">
        <div class="day">Hier</div>
        <li class="self">
            <div class="msg">
                <p>Piuff...</p>
                <p>Ce que ça donne quand tu écrit... </p>
                <time>10:18</time>
            </div>
        </li>

        <div class="day">Ajourd'hui</div>

        <li class="self">
            <div class="msg">
                <p>C'est fait en 5 minutes<emoji class="moai"></emoji></p>
                <time>23:10</time>
            </div>
        </li>
        <p class="notification">Dimitri à rejoint le Chat <time>00:11</time></p>
        <li class="other">
            <div class="msg">
                <div class="user">Dimitri</div>
                <p>C'est quoi ça ?<emoji class="funny"></emoji></p>
                <time>00:26</time>
            </div>
        </li>
        <li class="other">
            <div class="msg">
                <div class="user">DownJR<span class="range admin">Administrateur</span></div>
                <p>Demande à Jules, Je ne suis que le designer</p>
                <time>02:10</time>
            </div>
        </li>
        <li class="other">
            <div class="msg">
                <div class="user">Luzko<span class="range admin">Administrateur</span></div>
                <p>Je Travail encore sur le chat... <emoji class="books"></emoji><emoji class="books"></emoji></p>
                <time>02:10</time>
            </div>
        </li>
    </ol>
        <form>
            <textarea type="text" placeholder="Dit Quelque Chose..."></textarea>
            <input type="submit" class="send" value=""/>
        </form>
</div>
<div style="padding: 15px"></div>

<script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/4579/bootstrap-table.js'></script>
<script src="content/js/navbar.js?ver=7""></script>
</body>
</html>