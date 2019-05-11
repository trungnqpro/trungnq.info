<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blog_Lite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
	<?php 
	if ( has_post_thumbnail() ) { ?>

		<a href="<?php the_permalink(); ?>">

			<?php the_post_thumbnail(); ?>

	    </a>

	    <?php 
	} ?>
	
	<div class="content-wrapper">		

		<div class="entry-content">
			<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blog-lite' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'blog-lite' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-## -->
