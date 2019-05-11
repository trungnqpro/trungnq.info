<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load widget.
require get_template_directory() . '/rigorous-themes/widgets/blog-lite-author/inc/widget.php';

/**
 * Register widget.
 *
 * @since 1.0.0
 */
function blog_lite_author_init() {

	register_widget( 'Blog_Lite_Author' );

}
add_action( 'widgets_init', 'blog_lite_author_init' );

/**
 * Tasks in init.
 *
 * @since 1.0.0
 */
function blog_lite_author_translate_init() {

	// Make plugin translation ready.
	load_plugin_textdomain( 'blog-lite-author' );

}

add_action( 'init', 'blog_lite_author_translate_init' );

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 *
 * @param string $hook Hook.
 */
function blog_lite_author_scripts( $hook ) {

	if ( 'widgets.php' !== $hook ) {
		return;
	}

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'rt-about-me-admin', get_template_directory_uri() . '/rigorous-themes/widgets/blog-lite-author/css/admin' . $min . '.css', array(), '1.0.0' );

	wp_enqueue_media();

	wp_enqueue_script( 'rt-about-me-admin', get_template_directory_uri() . '/rigorous-themes/widgets/blog-lite-author/js/admin' . $min . '.js', array( 'jquery' ), '1.0.0' );

}
add_action( 'admin_enqueue_scripts', 'blog_lite_author_scripts' );
