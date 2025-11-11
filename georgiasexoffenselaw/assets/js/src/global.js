// @codekit-prepend "jquery.fitvids.js"
// @codekit-prepend "jquery.sidr.min.js"
// @codekit-prepend "slick.min.js"
// @codekit-prepend "jquery.infinitescroll.min.js"
// @codekit-prepend "manual-trigger.js"
// @codekit-prepend "jquery.matchHeight-min.js"

jQuery(function($){

    // FitVids
	$('.entry-content').fitVids();

    // Match Height
    $('.post-blocks .post-block').matchHeight();


    // Desktop submenu
    $('.site-header .menu-item-has-children').hover(
        function() {
        	console.log('hover');
            var padding = $(this).find('.sub-menu').outerHeight();
            $('.site-header .wrap').css({
                'padding-bottom' : padding + 'px'
            });
            $('.site-header').addClass('desktop-dropdown-active');
        }, function() {
            console.log('unhover');

            $('.site-header .wrap').css({
                'padding-bottom' : '0px'
            });
            $('.site-header').removeClass('desktop-dropdown-active');

        }
    );



    // Header Search : =search
    // Search Toggle
    // **********************************************************************************
    $('.header-search-toggle').click(function(e){
        e.preventDefault();
        $(this).toggleClass('active');
        $('.header-search').toggleClass('active').find('.search-field').focus();
    });

	// Mobile Menu : =mobile
	$('.mobile-menu-toggle').sidr({
		name: 'sidr-mobile-menu',
		side: 'right',
		renaming: false,
		displace: false,
	});
	$('.menu-item-has-children').prepend('<span class="submenu-toggle">' );
	$('.menu-item-has-children.sidr-class-current-menu-item').addClass('submenu-active');
	$('.menu-item-has-children > .submenu-toggle').click(function(e){
		$(this).parent().toggleClass('submenu-active');
		e.preventDefault();
	});
	$('.sidr a').click(function(){
		$.sidr('close', 'sidr-mobile-menu');
	});
	$('.sidr-menu-close').click(function(e){
		e.preventDefault();
	});
	$(document).on( 'mouseup touchend', (function (e){
		var container = $("#sidr-mobile-menu");
		if (!container.is(e.target) && container.has(e.target).length === 0) {
			$.sidr('close', 'sidr-mobile-menu');
		}
	}));

	// Smooth scrolling anchor links
	function ea_scroll( hash ) {
		var target = $( hash );
		target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		if (target.length) {
			var top_offset = 0;
			if ( $('.site-header').css('position') == 'fixed' ) {
				top_offset = $('.site-header').height();
			}
			if( $('body').hasClass('admin-bar') ) {
				top_offset = top_offset + $('#wpadminbar').height();
			}
			 $('html,body').animate({
				 scrollTop: target.offset().top - top_offset
			}, 1000);
			return false;
		}
	}
	// -- Smooth scroll on pageload
	if( window.location.hash ) {
		ea_scroll( window.location.hash );
	}
	// -- Smooth scroll on click
	$('a[href*="#"]:not([href="#"]):not(.no-scroll)').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') || location.hostname == this.hostname) {
			ea_scroll( this.hash );
		}
	});



    // Topic selection on cat archives : =topics =categories
    // **********************************************************************************
	$topic_toggle = $( '.topic-selection .topic-toggle' );
    $topic_toggle.on( 'click', function(e){
		// DEBUG
		// console.log( 'clicked' );
		e.preventDefault();
		$(this).toggleClass('active');

		$( '.topics' ).slideToggle();

        var width = $topic_toggle.outerWidth();
        $( '.topics' ).css('width', width );

	});


    // Home page : =home
    // **********************************************************************************
	// slider
    $('body.home .home-slider').slick({
        arrows: false,
        dots: true,
        autoplay: true,
        autoplaySpeed: 55500,
        prevArrow: '<a class="slick-prev"><i class="icon-angle-left"></i></a>',
        nextArrow: '<a class="slick-next"><i class="icon-angle-right"></i></a>',
    });



	// Archive, load more
	$('.archive .nav-links').hide();
	$('.archive .post-blocks').infinitescroll({
	    loading: {
	    	finished: function() { $('.post-blocks .post-block').matchHeight(); },
	        finishedMsg: 'Everything has loaded.',
	        img: '',
	        msgText: ' ',
	        behavior: 'twitter'
	    },
	    nextSelector: '.nav-links .nav-previous a',
	    navSelector: '.nav-links',
	    itemSelector: '.site-main .post-block'
	});
	$('.archive .post-blocks').infinitescroll('unbind');

	$('body').on('click', '.load-more .button', function() {
	    $('.post-blocks').infinitescroll('retrieve');
		$(this).remove();
	    return false;
	});

});
