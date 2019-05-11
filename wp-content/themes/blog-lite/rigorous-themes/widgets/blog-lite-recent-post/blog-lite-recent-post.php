<?php
/**
 * Plugin widgets.
 *
 * @package Blog_Lite_Recent_Posts
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Blog_Lite_Recent_Posts extends WP_Widget {
	/**
	* Declares the Blog_Lite_Recent_Posts class.
	*
	*/	

	public function __construct() {

		global $control_ops;

		$widget_ops = array(						
					'classname' 	=> 'blog-lite-recent-posts', 
					'description' 	=> __( 'A widget that displays your latest posts and thumbnail with extended features.', 'blog-lite') 
					);

		parent::__construct('Blog_Lite_Recent_Posts', __('Blog Lite: Recent Post Extended', 'blog-lite'), $widget_ops, $control_ops);

		$this->alt_option_name = 'widget_rtrpe';		
	}

	/**
	* Displays the Widget
	*
	*/
	function widget($args, $instance){		

		$title 				= ! empty( $instance['title'] ) ? $instance['title'] : '';	

		$number				= ! empty( $instance['number'] ) ? $instance['number'] : 5;

		$excerpt_length		= ! empty( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 8;	

		$hide_meta         	= ! empty( $instance['hide_meta'] ) ? '1' : '0';

		echo $args['before_widget']; 

		if (!empty($title)):

        	echo $args['before_title'] . esc_html( $title ) . $args['after_title'];

    	endif; 

		$rtrpe_args = array(
						'posts_per_page'      => absint($number),
						'no_found_rows'       => true,
						'post_status'         => 'publish',
						'ignore_sticky_posts' => true
					);

		$rtrpe_query = new WP_Query( apply_filters( 'widget_posts_args', $rtrpe_args ) );

		if( $rtrpe_query->have_posts()):

	    	while ( $rtrpe_query->have_posts() ) : $rtrpe_query->the_post(); ?>			
		    	<article class="post-item">
		    		<div class="post-image">
		    			<?php if( has_post_thumbnail() ): ?>

		    				<a href="<?php the_permalink(); ?>">
		    					<?php the_post_thumbnail( 'thumbnail' ); ?>
		    				</a>			    			
		    			<?php endif; ?>
		    		</div>
		    		<div class="post-item-text">
		    			<header class="entry-header">
		    			    <h3 class="entry-title">
		    			        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		    			    </h3>
		    			</header><!-- .entry-header -->

		    			<?php if(1 != $hide_meta ){ ?>
			    			<div class="entry-meta post-item-meta">
			    			    <span class="date"><?php echo get_the_date(get_option( 'date_format' )) ; ?></span>
			    			    
								<?php if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
									echo '<span class="comments-link">';
										/* translators: %s: post title */
										comments_popup_link( sprintf( wp_kses( __( '0 Comment<span class="screen-reader-text"> on %s</span>', 'blog-lite' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
									echo '</span>';
								} ?>
			    			   
			    			</div>
		    			<?php } ?>
		    			<div class="entry-content">
		    			    <p><?php echo esc_attr( blog_lite_limit_words(get_the_excerpt(), absint( $excerpt_length ) ) ); ?></p>
		    			</div><!-- .entry-content -->						    	
				    </div>

		    	</article><?php 

	    	endwhile;	
	
			wp_reset_postdata();
				

		endif;

		echo $args['after_widget'];
	}	

	/**
	* Creates the edit form for the widget.
	*
	*/
	function form($instance){	

		$instance = wp_parse_args( (array) $instance, 
						array(
							'title'				=> '', 
							'number'			=> '5',
							'excerpt_length' 	=> '8', 
							'hide_meta'			=> 0,				
						) 
					);


		$title 			=  isset( $instance['title'] ) ? $instance['title'] : '';

		$number			= !empty( $instance['number']) ? $instance['number'] : '5';

		$excerpt_length = !empty( $instance['excerpt_length']) ? $instance['excerpt_length'] : '8';

		$hide_meta		= isset( $instance['hide_meta']) ? (bool) $instance['hide_meta'] : 0;	


		# Output the options ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_name('title') ); ?>">
				<?php esc_html_e('Title:', 'blog-lite'); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />		
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_name('number') ); ?>">
				<?php esc_html_e('Number of Posts:', 'blog-lite'); ?>
			</label>
			<input class="small-text" id="<?php echo esc_attr( $this->get_field_id('number') ); ?>" name="<?php echo esc_attr( $this->get_field_name('number') ); ?>" type="number" value="<?php echo absint( $number ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_name('excerpt_length') ); ?>">
				<?php esc_html_e('Excerpt Length:', 'blog-lite'); ?>
			</label>
			<input class="small-text" id="<?php echo esc_attr( $this->get_field_id('excerpt_length') ); ?>" name="<?php echo esc_attr( $this->get_field_name('excerpt_length') ); ?>" type="number" value="<?php echo absint( $excerpt_length ); ?>" />
		</p>

		<p>			
			<input class="checkbox" type="checkbox" <?php checked( $hide_meta ); ?> id="<?php echo esc_attr( $this->get_field_id('hide_meta') ); ?>" name="<?php echo esc_attr( $this->get_field_name('hide_meta') ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_name('hide_meta') ); ?>">
				<?php esc_html_e('Hide Date and Comment', 'blog-lite'); ?>
			</label>
		</p>

		<?php		



	} //end of form

	/**
	* Saves the widgets settings.
	*
	*/
	function update($new_instance, $old_instance){

		$instance 					= $old_instance;

		$instance['title'] 			= sanitize_text_field( $new_instance['title'] );	

		$instance['number'] 		= absint( $new_instance['number'] );

		$instance['excerpt_length'] = absint( $new_instance['excerpt_length'] );

		$instance['hide_meta'] 		= $new_instance['hide_meta'] ? 1 : 0;

		return $instance;
	}

}// END class

/**
* Register  widget.
*
* Calls 'widgets_init' action after widget has been registered.
*/
function blog_lite_posts_init() {

	register_widget('Blog_Lite_Recent_Posts');

}	

add_action('widgets_init', 'blog_lite_posts_init');
?>