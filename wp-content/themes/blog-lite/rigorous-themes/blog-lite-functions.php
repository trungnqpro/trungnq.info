<?php 

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/rigorous-themes/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/rigorous-themes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/rigorous-themes/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/rigorous-themes/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/rigorous-themes/jetpack.php';

/**
 * Load Blog Lite Controls.
 */
require get_template_directory() . '/rigorous-themes/customizer/blog-lite-controls.php';

/**
 * Load Blog Lite Sanitization Functions.
 */
require get_template_directory() . '/rigorous-themes/customizer/blog-lite-sanitization-functions.php';

/**
 * Load Blog Lite Default Options.
 */
require get_template_directory() . '/rigorous-themes/customizer/blog-lite-defaults.php';

/**
 * Init Hooks of the theme
 */
require get_template_directory() . '/rigorous-themes/hooks/hooks-init.php';

/**
 * Init Widgets of the theme
 */
require get_template_directory() . '/rigorous-themes/widgets/widgets-init.php';

//=============================================================
// Function to remove default controls
//=============================================================
add_action( "customize_register", "blog_lite_page_banner" );

function blog_lite_page_banner( $wp_customize ) {

	$wp_customize->get_section('header_image')->title = __( 'Inner Page Banners', 'blog-lite' );

}

//=============================================================
// Menu Fallback function
//=============================================================

if ( !function_exists('blog_lite_menu_fallback') ) :

function blog_lite_menu_fallback(){

	echo '<ul id="menu-main-menu" class="menu">';
		echo '<li class="menu-item"><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'blog-lite' ). '</a></li>';
		wp_list_pages( array(
			'title_li' => '',
			'depth'    => 1,
			'number'   => 5,
		) );
		echo '</ul>';
	
}

endif;

//=============================================================
// Function limit the number of words.
//=============================================================
if ( !function_exists('blog_lite_limit_words') ) :

	function blog_lite_limit_words($string, $word_limit) {

		$words = explode(' ', $string, ($word_limit + 1));

		if(count($words) > $word_limit) {

			if(count($words) > $word_limit) {

				array_pop($words);

				return implode(' ', $words).'...';
				
			}
		} else {  

			return $string;

		}

	}

endif;

//=============================================================
// To add class on body for sidebar
//=============================================================
if ( ! function_exists( 'blog_lite_alter_body_class' ) ) {

	function blog_lite_alter_body_class( $classes ) {
	    
	    $theme_options = blog_lite_theme_options();

	    if( isset( $theme_options['sidebar'] ) && 'left' == $theme_options['sidebar'] ) {

	        $sidebar_layout = 'left-sidebar';    

	    }elseif( isset( $theme_options['sidebar'] ) && 'right' == $theme_options['sidebar'] ) {

	        $sidebar_layout = 'right-sidebar';

	    }else{
	    	$sidebar_layout = 'no-sidebar';
	    }            
	    
	    $classes[] = $sidebar_layout;

	    return $classes;
	}
	
}
add_filter( 'body_class', 'blog_lite_alter_body_class' );

