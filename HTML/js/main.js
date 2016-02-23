$(document).ready(function() {
    $('.scroll').click(function(e) {
        e.preventDefault;

        var page = $(this).attr('href');
        var speed = 750;
        
        $('html, body').animate({
            scrollTop: $(page).offset().top
        }, speed);
        
        return false;
    });

    $('.navbar-toggle').click(function() {
        if ($(this).hasClass('collapsed')) {
            console.log('Opened');
        }

        else {
            console.log('Closed');
        }
    });
});