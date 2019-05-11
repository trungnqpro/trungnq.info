jQuery(document).ready(function ($) {

    $('.main-navigation').meanmenu();
    
    /*Back to top*/    
    //Click event to scroll to top
    $('.go-to-top-link').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });    

});