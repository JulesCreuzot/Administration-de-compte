function activateNav() {
    $('ul.nav > li').on('click', function (evt) {
        if ($(evt.currentTarget).hasClass('toggle-nav')) return;
        $(evt.currentTarget).addClass('active').siblings().removeClass('active');
    });
}

function addToggle() {
    $('li.toggle-nav').on('click', function () {
        $(this).find('i').toggleClass('rotate-180-deg');
        $('.navbar-nav.side-nav').toggleClass('hide-link-text');
        $('#wrapper').toggleClass('expanded');
    });
}

function fixHamburgerUl() {
    $('.navbar-toggle').on('click', function () {
        $('.navbar-nav.side-nav').removeClass('hide-link-text');
        $("#wrapper").removeClass('expanded');
        $('i.fa-arrow-left').removeClass('rotate-180-deg');
    });
}

function init() {
    activateNav();
    addToggle();
    fixHamburgerUl();
}

init();