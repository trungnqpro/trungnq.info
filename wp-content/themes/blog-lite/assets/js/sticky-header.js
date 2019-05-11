jQuery(window).scroll(function($) {

	var header_ht = jQuery( '#masthead' ).height();

	if (jQuery(this).scrollTop() > header_ht){  

		jQuery('header').addClass("sticky-header");

	}
	else{

		jQuery('header').removeClass("sticky-header");

	}
	
});		