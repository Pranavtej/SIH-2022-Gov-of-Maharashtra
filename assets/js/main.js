(function($) {
    "use strict";
		
	/* Header scroll on fixed */
	
	var NavBar = $('nav.navbar');
    var didScroll;
    var lastScrollTop = 0;
    var navbarHeight = NavBar.outerHeight();
    $(document).ready(function(event) {
        didScroll = true;
    });
    $(window).scroll(function(event) {
        didScroll = true;
    });
    setInterval(function() {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 100);

    function hasScrolled() {
        var st = $(document).scrollTop();
        if (st + $(window).height() < $(document).height()) {
            NavBar.addClass('fixed-header');
            if (st == 0) {
                NavBar.removeClass('fixed-header');
            }
        }
        lastScrollTop = st;
    }


        /* ==================================================
            # Smooth Scroll
         ===============================================*/
        $("body").scrollspy({
            target: ".navbar-collapse",
            offset: 200
        });
        $('a.smooth-menu').on('click', function(event) {
            var $anchor = $(this);
            var headerH = '75';
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top - headerH + "px"
            }, 1500, 'easeInOutExpo');
            event.preventDefault();
        });
		
    $(window).on ('load', function (){ // makes sure the whole site is loaded
		
		$('#loader').delay(100).fadeOut('slow');
		$('#loader-wrapper').delay(500).fadeOut('slow');
		$('body').delay(500).css({'overflow':'visible'});

    });
		
		
        $('body').scrollspy({
            target: ".header-area",
            offset: 50
        });

        $(".toggle").on('click', function() {
            $(this).toggleClass("active");
        });

        new WOW().init({
            mobile: false,
        });

        var scroll = new SmoothScroll('a[href*="#"]', {
            speed: 1000
        });

})(jQuery);