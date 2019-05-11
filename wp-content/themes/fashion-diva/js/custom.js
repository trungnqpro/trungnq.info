jQuery(document).ready(function($){    
    
    var rtl, mrtl, winWidth;
    
    if( fashion_diva_data.rtl == '1' ){
        rtl = true;
        mrtl = false;
    }else{
        rtl = false;
        mrtl = true;
    }
    winWidth = $(window).width();
    
    //banner layout two
    $('#banner-slider-two').owlCarousel({
        loop       : true,
        nav        : true,
        items      : 1,
        dots       : true,
        autoplay   : true,
        animateOut : '',
        navText    : '',
        center     : true,
        rtl        : rtl,
        lazyLoad   : true,
        responsive : {
            1200: {
                margin: 80,
                stagePadding: 234,
            },
            1025: {
                margin: 50,
                stagePadding: 150,
            },
            768: {
                margin: 20,
                stagePadding: 50
            }
        }
    });

    $('.site-header .form-holder').prepend('<div class="btn-close-form"><span></span></div>');

    $('.btn-close-form').click(function(){
        $(this).parent('.form-holder').hide("fast");
    });

    //secondary menu
    if( winWidth < 1025 ){
        $('.secondary-nav ul li.menu-item-has-children').append('<span><i class="fa fa-angle-down"></i></span>');
        $('.secondary-nav ul li span').click(function(){
            $(this).prev().slideToggle();
            $(this).toggleClass('active');
        });

        $('#secondary-toggle-button').click(function(){
            $('.secondary-nav').slideToggle();
            $(this).toggleClass('close');
        });
    }
       
});