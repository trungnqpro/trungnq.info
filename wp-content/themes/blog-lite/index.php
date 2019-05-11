<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
			<div id="scroll" class="home-text">
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
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar(); 
get_footer();
