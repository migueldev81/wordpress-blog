jQuery(document).ready(function($) {

/*------------------------------------------------
            DECLARATIONS
------------------------------------------------*/

    var loader = $('#loader');
    var loader_container = $('#preloader');
    var scroll = $(window).scrollTop();  
    var scrollup = $('.backtotop');
    var menu_toggle = $('.menu-toggle');
    var dropdown_toggle = $('.main-navigation button.dropdown-toggle');
    var nav_menu = $('.main-navigation ul.nav-menu');
    var banner_slider = $('.banner-slider');
    var related_gallery_slider = $('.related-gallery-slider');
    var masonry_gallery = $('.grid');

/*------------------------------------------------
            PRELOADER
------------------------------------------------*/

    loader_container.delay(1000).fadeOut();
    loader.delay(1000).fadeOut("slow");

/*------------------------------------------------
                BACK TO TOP
------------------------------------------------*/

    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 1) {
            scrollup.css({bottom:"25px"});
        } 
        else {
            scrollup.css({bottom:"-100px"});
        }
    });

    scrollup.on('click', function() {
        $('html, body').animate({scrollTop: '0px'}, 800);
        return false;
    });

/*------------------------------------------------
                MENU, STICKY MENU AND SEARCH
------------------------------------------------*/

    $('#top-menu .dropdown-icon').on('click', function(){
        $('#top-menu .wrapper').slideToggle();
        $('#top-menu').toggleClass('top-menu-active');
    });

    menu_toggle.on('click', function(){
        nav_menu.slideToggle();
       $('.main-navigation').toggleClass('menu-open');
    });

    dropdown_toggle.on('click', function() {
        $(this).toggleClass('active');
       $(this).parent().find('.sub-menu').first().slideToggle();
    });

    $(window).scroll(function() {
        if ($(this).scrollTop() > 290) {
            $('.site-header.sticky-header').fadeIn();
            if ($('.site-header').hasClass('sticky-header')) {
                $('.site-header.sticky-header').addClass('nav-shrink');
                $('.site-header.sticky-header').fadeIn();
            }
        } 
        else {
            $('.site-header.sticky-header').removeClass('nav-shrink');
        }
    });

    $('.main-navigation ul li a.search').on('click', function(e) {
        e.preventDefault();
        $('#search').toggleClass('search-open');
        $('#search .search-field').focus();
    });

    /*--------------------------------------------------------------
     Keyboard Navigation
    ----------------------------------------------------------------*/
    if( $(window).width() < 1024 ) {
        $('#primary-menu').find("li").last().bind( 'keydown', function(e) {
            if( e.which === 9 ) {
                e.preventDefault();
                $('#masthead').find('.menu-toggle').focus();
            }
        });
    }
    else {
        $( '#primary-menu li:last-child' ).unbind('keydown');
    }

    $(window).resize(function() {
        if( $(window).width() < 1024 ) {
            $('#primary-menu').find("li").last().bind( 'keydown', function(e) {
                if( e.which === 9 ) {
                    e.preventDefault();
                    $('#masthead').find('.menu-toggle').focus();
                }
            });
        }
        else {
            $( '#primary-menu li:last-child' ).unbind('keydown');
        }
    });

    $(document).keyup(function(e) {
        e.preventDefault();
        if (e.keyCode === 27) {
            $('#search').removeClass('search-open');
        }

        if (e.keyCode === 9) {
            $('#search').removeClass('search-open');
        }
    });

    $('.main-navigation').on('keydown', function(e) {
        tabKey = e.keyCode === 9;
        shiftKey = e.shiftKey;
        if( $('.main-navigation').hasClass('menu-open') ) {
            if ( shiftKey && tabKey ) {
                e.preventDefault();
                nav_menu.slideUp();
                $('.main-navigation').removeClass('menu-open');
            };
        }
    });


/*------------------------------------------------
                SLICK SLIDERS
------------------------------------------------*/


if ( banner_slider.hasClass( 'column-4', 'column-3' ) ) {
    banner_slider.slick({
        responsive: [
            {
                breakpoint: 1025,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
}
else {
    banner_slider.slick({
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
}

var status = $('.pagingInfo');

/*------------------------------------------------
                MASONRY
------------------------------------------------*/

masonry_gallery.imagesLoaded( function() {
    masonry_gallery.packery({
        itemSelector: '.grid-item'
    });
});
                
$('#filter-posts ul li a').on('click', function(event) {
    event.preventDefault();

    var selector = $(this).attr('data-filter');
    masonry_gallery.isotope({ filter: selector });
    $('#filter-posts ul li').removeClass('active');
    $(this).parent().addClass('active');
    return false;
});

packery = function () {
    masonry_gallery.isotope({
        resizable: true,
        itemSelector: '.grid-item',
        layoutMode : 'packery',
        gutter: 0,
    });
};
packery();

/*------------------------------------------------
                END JQUERY
------------------------------------------------*/

});