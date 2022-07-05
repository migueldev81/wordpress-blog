
(function($){ //create closure so we can safely use $ as alias for jQuery

    $(document).ready(function(){

        "use strict";

        /*-----------------------------------------------------------------------------------*/
        /*  Superfish Menu
        /*-----------------------------------------------------------------------------------*/
        // initialise plugin
        var example = $('.sf-menu').superfish({
            //add options here if required
            delay:       100,
            speed:       'fast',
            autoArrows:  false  
        }); 

        /*-----------------------------------------------------------------------------------*/
        /*  bxSlider
        /*-----------------------------------------------------------------------------------*/
        $('.bxslider').bxSlider({
            auto: true,
            pause: '6000',
            autoHover: true,
            adaptiveHeight: true,
            mode: 'fade',
            touchEnabled: false,
            onSliderLoad: function(){ 
                $(".bxslider").css("display", "block");
                $(".bxslider").css("visibility", "visible");  
                $('#featured-content .featured-slide .entry-header').fadeIn("100");
                $('#featured-content .featured-slide .gradient').fadeIn("100"); 
                $('#featured-content .featured-grid .entry-header').fadeIn("100");
                $('#featured-content .featured-grid .gradient').fadeIn("100");                       
            }
        });

        $('.widget-posts-thumbnail .gradient').fadeIn("100"); 

        /*-----------------------------------------------------------------------------------*/
        /*  Tabs
        /*-----------------------------------------------------------------------------------*/
        $('.widget_tabs').show(); 
        $('.widget_tabs .tabs').tabslet({
            mouseevent: 'click',
            attribute: 'href',
            animation: false
        });

        /*-----------------------------------------------------------------------------------*/
        /*  Back to Top
        /*-----------------------------------------------------------------------------------*/
        // hide #back-top first
        $("#back-top").hide();

        $(function () {
            // fade in #back-top
            $(window).scroll(function () {
                if ($(this).scrollTop() > 100) {
                    $('#back-top').fadeIn('200');
                } else {
                    $('#back-top').fadeOut('200');
                }
            });

            // scroll body to 0px on click
            $('#back-top a').click(function () {
                $('body,html').animate({
                    scrollTop: 0
                }, 400);
                return false;
            });
        });                                            

    });

})(jQuery);
