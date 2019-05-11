<?php 
//=============================================================
// Select/radio santitization
//=============================================================
if ( ! function_exists( 'blog_lite_sanitize_select' ) ) :

	function blog_lite_sanitize_select( $input, $setting ) {
	  
		$input = esc_attr( $input );
	  
		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

	}

endif;

//=============================================================
// Checkbox santitization
//=============================================================
if ( ! function_exists( 'blog_lite_checkbox_sanitization' ) ) :

	function blog_lite_checkbox_sanitization( $input ) {

		if ( $input == 1 ) {

			return 1;

		} else {

			return '';

		}
	}

endif;

//=============================================================
// Blog Lite Integer Number Sanitization
//=============================================================
if ( ! function_exists( 'blog_lite_number_sanitization' ) ) :

	function blog_lite_number_sanitization( $input, $setting ) {

		$input = absint( $input );

		return ( $input ? $input : $setting->default );

	}

endif;

//=============================================================
// Blog Lite active callback for type of slider
//=============================================================
if ( ! function_exists( 'blog_lite_slider_type_category' ) ) :

	function blog_lite_slider_type_category( $control ) { 

		if( 'slider' == $control->manager->get_setting('blog_lite[main_slider_type]')->value() ){
		
			return true;
		
		} else {
		
			return false;
		
		}
	}

endif;

//=============================================================
// Blog Lite active callback for type of banner 
//=============================================================
if ( ! function_exists( 'blog_lite_slider_type_banner' ) ) :

	function blog_lite_slider_type_banner( $control ) { 
		
		if( 'banner-image' == $control->manager->get_setting('blog_lite[main_slider_type]')->value() ){
		
			return true;
		
		} else {
		
			return false;
		
		}
	}

endif;

//=============================================================
// Blog Lite active callback for type of featured block category
//=============================================================
if ( ! function_exists( 'blog_lite_block_type_cat' ) ) :

	function blog_lite_block_type_cat( $control ) { 
		
		if( 'category' == $control->manager->get_setting('blog_lite[blocks_type]')->value() ){
		
			return true;
		
		} else {
		
			return false;
		
		}
	}

endif;

//=============================================================
// Blog Lite active callback for type of featured block posts 
//=============================================================
if ( ! function_exists( 'blog_lite_block_type_post' ) ) :

	function blog_lite_block_type_post( $control ) { 
		
		if( 'post_ids' == $control->manager->get_setting('blog_lite[blocks_type]')->value() ){
		
			return true;
		
		} else {
		
			return false;
		
		}
	}

endif;

//=============================================================
// Blog Lite active callback for type of news ticker
//=============================================================
if ( ! function_exists( 'blog_lite_ticker_type_category' ) ) :

	function blog_lite_ticker_type_category( $control ) { 

		if( 'category' == $control->manager->get_setting('blog_lite[top_ticker_type]')->value() ){
			
			return true;

		} else {

			return false;

		}
	}
 
endif;

//=============================================================
// Blog Lite active callback for top header enable/disable
//=============================================================
if ( ! function_exists( 'blog_lite_top_header_show' ) ) :

	function blog_lite_top_header_show( $control ) { 

		if( '1' == $control->manager->get_setting('blog_lite[top_bar]')->value() ){

			return true;

		} else {

			return false;

		}
	}
 
endif;

//=============================================================
// Blog Lite sanitize html fields
//=============================================================
if ( ! function_exists( 'blog_lite_sanitize_html' ) ) :

	function blog_lite_sanitize_html( $html ) {

		return wp_filter_post_kses( $html );

	}

endif;

//=============================================================
// Blog Lite css sanitization
//=============================================================
if ( ! function_exists( 'blog_lite_sanitize_css' ) ) :

	function blog_lite_sanitize_css( $css ) {

		return wp_strip_all_tags( $css );

	}

endif;