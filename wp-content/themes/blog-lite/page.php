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
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content-page', 'page' );		

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;		

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
