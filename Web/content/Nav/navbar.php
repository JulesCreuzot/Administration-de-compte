<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css'>
<link rel='stylesheet' href='https://s3-us-west-2.amazonaws.com/s.cdpn.io/4579/bootstrap-table.css'>
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
                <li class='toggle-nav visible-lg visible-md visible-sm' hidden><a><i class='fa fa-lg fa-arrow-left'></i>Réduire</a></li>
                <li class='dashboard'><a href='index.php'><i class="fa fa-lg fa-home"></i>Accueil</a></li>
                <li class='dashboard'><a href='#chat'><i class="fa fa-lg fa-comments"></i>Chat</a></li>
                <li class='divider'><hr></li>
                <li class='dashboard'><a href='connexion.php'><i class='fa fa-lg fa-user'></i>S'identifier</a></li>
                <li class='dropdown user-dropdown'>
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown'><span class="js-user-name"><i class='fa fa-lg fa-user'></i>Nom Compte</span><b class='caret'></b></a>
                    <ul class='dropdown-menu'>
                        <li class='settings'><a href='#'><i class="fa fa-lg fa-lock"></i>Administration</a></li>
                        <li class='settings'><a href='#'><i class='fa fa-lg fa-gear'></i>Paramètres</a></li>
                    </ul>
                </li>
                <li class='divider'><hr></li>
                <li class='active docs'><a href='#cgu'><i class='fa fa-lg fa-folder-open'></i>Mention Légale</a></li>
            </ul>
            <ul class='nav navbar-nav navbar-right navbar-user'>
            </ul>
        </div>

    </nav>