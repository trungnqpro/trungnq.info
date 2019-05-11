jQuery(document).ready(function ($) {
 	var animateOut_effect = blog_lite_script_vars.animateOut;
 	
 	var args = {
			loop:true,
			items: 1,			
			autoplay: blog_lite_script_vars.autoplay,	         
			nav:true,
			navText: [ '', '' ],
		};
 	if( 'none' != animateOut_effect){
		args.animateOut=blog_lite_script_vars.animateOut;
	}
		$('#main-slider').owlCarousel(args)
	
});		