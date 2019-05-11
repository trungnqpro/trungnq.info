<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blog_Lite
 */

$theme_options = blog_lite_theme_options(); 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('full-thumbnail'); ?>>
	<div class="content-wrapper full-wrap">
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>			
		</header><!-- .entry-header -->

		<?php if ( 'post' === get_post_type() && ( 1 !== $theme_options['hide_meta'] ) ) : ?>
		<div class="post-details">
			<?php 
			blog_lite_posted_on();
			blog_lite_entry_footer();
			?>
		</div><!-- .entry-meta -->
		<?php endif; ?>

	<div class="entry-content">
		<?php 
		$excerpt_length = $theme_options['excerpt_length']; 
		$read_more		= $theme_options['readmore_text'];
		?>
		<p><?php echo esc_html( blog_lite_limit_words(get_the_excerpt(), absint( $excerpt_length ) ) ); ?></p>	        
		<a class="readmore" href="<?php the_permalink(); ?> "><?php echo esc_html( $read_more ); ?></a>	
	</div><!-- .entry-summary -->

	</div><!-- .content-wrapper -->
</article><!-- #post-## -->
