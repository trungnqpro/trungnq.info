<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blog_Lite
 */

get_header(); ?>
<?php 
$theme_options = blog_lite_theme_options();
$sidebar_class = 'col-2-of-3';
if( isset( $theme_options['sidebar'] ) && 'no-sidebar' == $theme_options['sidebar'] ) {
	$sidebar_class = 'col-1-of-1';
}
?>
	<div id="primary" class="content-area col <?php echo esc_attr( $sidebar_class );?>">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : 
			
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
