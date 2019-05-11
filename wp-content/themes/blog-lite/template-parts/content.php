<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blog_Lite
 */

$theme_options = blog_lite_theme_options(); 

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('full-thumbnail'); ?>>
	<?php 
	if ( has_post_thumbnail() ) { ?>

		<a href="<?php the_permalink(); ?>">

			<?php the_post_thumbnail(); ?>

	    </a>

	    <?php 
	}

	if( is_sticky() ){ ?>

		<div class="favourite"><i class="fa fa-star"></i></div>

	<?php } ?>
	<div class="content-wrapper full-wrap">		    
	    <header class="entry-header">
	    	<?php
	    	if ( is_single() ) :
	    		the_title( '<h2 class="entry-title">', '</h2>' );
	    	else :
	    		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	    	endif; ?>      
	    </header><!-- .entry-header -->

	    <?php if( 1 !== $theme_options['hide_meta'] ){ ?>
		    <div class="post-details">  	
		    	
		    	<?php 
		    	blog_lite_posted_on(); 
		    	blog_lite_entry_footer();
		    	?> 

		    </div><!-- .post-details -->
	    <?php } ?>

	    <div class="entry-content">
		    <?php 
		    $excerpt_length = $theme_options['excerpt_length']; 
		    $read_more		= $theme_options['readmore_text'];

		    if( is_single() ){
		    	the_content( sprintf(
		    		/* translators: %s: Name of current post. */
		    		wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'blog-lite' ), array( 'span' => array( 'class' => array() ) ) ),
		    		the_title( '<span class="screen-reader-text">"', '"</span>', false )
		    	) );
		    } else{ ?>
	    	<p><?php echo esc_html( blog_lite_limit_words(get_the_excerpt(), absint( $excerpt_length ) ) ); ?></p>	        
	        <a class="readmore" href="<?php the_permalink(); ?> "><?php echo esc_html( $read_more ); ?></a>

	       <?php }
	        
	          wp_link_pages( array(
	        		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blog-lite' ),
	        		'after'  => '</div>',
	        	) ); ?>

	    </div><!-- .entry-content -->		

	</div><!-- .content-wrapper -->
</article><!-- #post-## -->
