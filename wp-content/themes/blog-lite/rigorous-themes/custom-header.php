<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Blog_Lite
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses blog_lite_header_style()
 */
function blog_lite_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'blog_lite_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1600,
		'height'                 => 270,
		'flex-height'            => true,
		'header-text'            => false,
		'default-image'			 => '%s/assets/images/headers/small-boy.jpg',
	) ) );

	/*
	 * Default custom headers packaged with the theme.
	 * %s is a placeholder for the theme template directory URI.
	 */
	register_default_headers( array(		
		'small-boy' => array(
			'url'           => '%s/assets/images/headers/small-boy.jpg',
			'thumbnail_url' => '%s/assets/images/headers/small-boy-thumbnail.jpg',
			'description'   => _x( 'small-boy', 'small-boy for default banner', 'blog-lite' )
		),	

		'notebook' => array(
			'url'           => '%s/assets/images/headers/notebook.jpg',
			'thumbnail_url' => '%s/assets/images/headers/notebook-thumbnail.jpg',
			'description'   => _x( 'notebook', 'header image description', 'blog-lite' )
		),	

		'computer-cup' => array(
			'url'           => '%s/assets/images/headers/computer-cup.jpg',
			'thumbnail_url' => '%s/assets/images/headers/computer-cup-thumbnail.jpg',
			'description'   => _x( 'computer-cup', 'header image description', 'blog-lite' )
		),
					
	) );
}
add_action( 'after_setup_theme', 'blog_lite_custom_header_setup' );