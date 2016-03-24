window.jQuery = window.$ = jQuery;

$(window).load(function() {
	homeHeight();
});

$(window).resize(function() {
	homeHeight();
});

function homeHeight() {
	$('#home-slider, #slider .slides li').css('height', $(window).height());
}

$(window).load(function() {
	$('#slider').flexslider({
		animation: "fade",
		slideshowSpeed: 3500,
		pauseOnAction: false,
		pauseOnHover: false,
		controlNav: false,
		directionNav: false,
		prevText: "",
		nextText: ""
	});
});

$(document).ready(function() {
	$('.scroll').click(function(e) {
		e.preventDefault();
		$('html, body').animate({scrollTop: $(this.hash).offset().top}, 1000);
		
		return false;
	});

	$('.navbar-toggle').click(function() {
		$('.overlay').toggleClass('show');
		$(this).toggleClass('open');
	});
});