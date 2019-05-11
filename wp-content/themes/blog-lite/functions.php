<?php
/**
 * Blog Lite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Blog_Lite
 */

if ( ! function_exists( 'blog_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blog_lite_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Remove header text color from customizer
	add_theme_support( 'custom-header', array(
		'header-text' => false
	) );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	* Enable support for custom logo.
	*/  
	add_theme_support( 'custom-logo', array(
		'flex-height' => true,
		'flex-width'  => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 785, 520);
	add_image_size( 'blog-lite-block', 370, 275, true );
	

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'blog-lite' ),
		'top-bar' => esc_html__( 'Top Bar', 'blog-lite' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );	

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'blog_lite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

}
endif;
add_action( 'after_setup_theme', 'blog_lite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blog_lite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'blog_lite_content_width', 785 );
}
add_action( 'after_setup_theme', 'blog_lite_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blog_lite_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'blog-lite' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'blog-lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<header class="entry-header border-bottom"><h3 class="widget-title">',
		'after_title'   => '</header></h3>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer: One', 'blog-lite' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'blog-lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<header class="entry-header border-bottom"><h3 class="widget-title">',
		'after_title'   => '</header></h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Two', 'blog-lite' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'blog-lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<header class="entry-header border-bottom"><h3 class="widget-title">',
		'after_title'   => '</header></h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Three', 'blog-lite' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'blog-lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<header class="entry-header border-bottom"><h3 class="widget-title">',
		'after_title'   => '</header></h3>',
	) );
}
add_action( 'widgets_init', 'blog_lite_widgets_init' );


if ( ! function_exists( 'blog_lite_fonts_url' ) ) {
	/**
	 * Register Google fonts.
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function blog_lite_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Raleway: on or off', 'blog-lite' ) ) {
			$fonts[] = 'Raleway:400,300,500,700,800,900,500italic,600,700italic,100,200';
		}	

		if ( 'off' !== _x( 'on', 'Oswald: on or off', 'blog-lite' ) ) {
			$fonts[] = 'Oswald:400,700,300';
		}		

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}
}

/**
 * Enqueue scripts and styles.
 */
function blog_lite_scripts() {	

	$theme_options = blog_lite_theme_options();

	wp_enqueue_style( 'grid', get_template_directory_uri() . '/assets/css/grid.css' );
	
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css' );

	wp_enqueue_style( 'blog-lite-style', get_stylesheet_uri() );

	wp_enqueue_style( 'meanmenu', get_template_directory_uri() . '/assets/css/meanmenu.css' );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );	

	wp_enqueue_style( 'blog-lite-fonts', blog_lite_fonts_url(), array(), null );


	wp_enqueue_script( 'meanmenu', get_template_directory_uri() . '/assets/js/jquery.meanmenu.js', array('jquery'), '20151215', true );		

	wp_enqueue_script( 'blog-lite-custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array('jquery'), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/*for slider*/

	if( 'slider' === $theme_options['main_slider_type'] && ( is_home() || is_front_page() ) ){

		wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/owl-carousel/lib/owl.carousel.css' );	

		wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/owl-carousel/lib/owl.carousel.min.js', array('jquery'), '20151215', true );

		wp_enqueue_script( 'blog-lite-custom-slider', get_template_directory_uri() . '/assets/js/custom-slider.js', array('owl-carousel'), '20151215', true );   
    

	}	

	/*for sticky header*/
	if( 1 === $theme_options['sticky_header'] ){ 

		wp_enqueue_script( 'blog-lite-sticky-header', get_template_directory_uri() . '/assets/js/sticky-header.js', array('jquery'), '20151215', true );

	}

	wp_enqueue_style( 'blog-lite-responsive', get_template_directory_uri() . '/assets/css/responsive.css' );
}
add_action( 'wp_enqueue_scripts', 'blog_lite_scripts' );

/**
 * Load Blog Lite functions.
 */
require get_template_directory() . '/rigorous-themes/blog-lite-functions.php';
