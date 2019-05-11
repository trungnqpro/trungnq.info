<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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

				while ( have_posts() ) : the_post();
					
					get_template_part( 'template-parts/content', 'search' );				

				endwhile; // End of the loop.

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
