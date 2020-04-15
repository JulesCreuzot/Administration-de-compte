<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css'>
<link rel="stylesheet" href="content/css/navbar.css">
<div id='wrapper'>
    <nav class='navbar navbar-inverse navbar-fixed-top' role='navigation'>
        <div class='navbar-header'>
            <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-hamburger-delicious'>
                <span class='sr-only'>Développer</span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
            </button>
            <a class='navbar-brand' >Chat</a>
        </div>

        <div class='collapse navbar-collapse navbar-hamburger-delicious'>
            <ul class='nav navbar-nav side-nav fadeInLeft'>
                <li class='toggle-nav visible-lg visible-md visible-sm'><a><i class='fa fa-lg fa-arrow-left'></i>Réduire</a></li>
                <li class='dashboard'><a href='index.php'><i class="fa fa-lg fa-home"></i>Accueil</a></li>
                <?php
                if (isset($_SESSION['compte'])) {
                ?>
                <li class='print'><a href='chat.php'><i class="fa fa-lg fa-comments"></i>Chat</a></li>
                <?php } ?>
                <li class='divider'><hr></li>
                <?php
                if (isset($_SESSION['compte']['mail'])) {
                    ?>
                    <li class='dropdown user-dropdown'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown'><span class="js-user-name"><i class='fa fa-lg fa-user'></i>Mom Compte</span><b class='caret'></b></a>
                        <ul class='dropdown-menu'>
                            <?php
                            if ($_SESSION['compte']['libellecomptes'] === "Administrateur") {
                            ?>
                            <li class='settings'><a href='administration.php'><i class="fa fa-lg fa-lock"></i>Administration</a></li>
                            <?php } ?>
                            <li class='settings'><a href='gestioncompte.php'><i class='fa fa-lg fa-gear'></i>Paramètres</a></li>
                        </ul>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class='dashboard'><a href='identification.php'><i class='fa fa-lg fa-user'></i>S'identifier</a></li>
                    <?php
                }
                ?>
                <li class='divider'><hr></li>
                <li class='active docs'><a href='mentionslegales.php'><i class='fa fa-lg fa-folder-open'></i>Mentions Légales</a></li>
                <?php
                if (isset($_SESSION['compte'])) {
                ?>
                    <li class='divider'><hr></li>
                    <li class='person-lookup'><a href='deconnexion.php'><i class='fa fa-lg fa-sign-out'></i>Déconnexion</a></li>
                <?php } ?>

        </div>
    </nav>
</div>
