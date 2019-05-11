<?php
/**
 * Plugin widgets.
 *
 * @package Blog_Lite_Author
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Blog_Lite_Author.
 *
 * @since 1.0.0
 */
class Blog_Lite_Author extends WP_Widget {

	/**
	 * Sets up a new widget instance.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Widget options.
		$opts = array(
			'classname'                   => 'blog-lite-author',
			'description'                 => __( 'A widget that displays author bio with description, cover and profile picture.', 'blog-lite' ),
			'customize_selective_refresh' => true,
		);

		parent::__construct( 'blog-lite', __( 'Blog Pro: Author Bio', 'blog-lite' ), $opts );

	}

	/**
	 * Outputs the content for the current widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args     Display arguments.
	 * @param array $instance Settings for the current widget instance.
	 */
	function widget( $args, $instance ) {		

		$title 							= ! empty( $instance['title'] ) ? $instance['title'] : '';

		$rtam_cover_pic               	= ! empty( $instance['rtam_cover_pic'] ) ? $instance['rtam_cover_pic'] : '';
		$rtam_profile_pic               = ! empty( $instance['rtam_profile_pic'] ) ? $instance['rtam_profile_pic'] : '';
		$rtam_intro_title          		= ! empty( $instance['rtam_intro_title'] ) ? $instance['rtam_intro_title'] : '';
		$rtam_short_bio          		= ! empty( $instance['rtam_short_bio'] ) ? $instance['rtam_short_bio'] : '';
		
		$rtam_link                    	= ! empty( $instance['rtam_link'] ) ? $instance['rtam_link'] : '';
		
		$rtam_open_link               	= ! empty( $instance['rtam_open_link'] ) ? $instance['rtam_open_link'] : false;
		
		$rtam_disable_link_in_title   	= ! empty( $instance['rtam_disable_link_in_title'] ) ? $instance['rtam_disable_link_in_title'] : false;
		$rtam_disable_link_in_pic   	= ! empty( $instance['rtam_disable_link_in_pic'] ) ? $instance['rtam_disable_link_in_pic'] : false;		

		$instance['link_open']  		= '';
		$instance['link_close'] 		= '';
		
		if ( ! empty( $rtam_link ) ) {
			$target                 = ( empty( $rtam_open_link ) ) ? '' : ' target="_blank" ';
			$instance['link_open']  = '<a href="' . esc_url( $rtam_link ) . '"' . $target . '>';
			$instance['link_close'] = '</a>';
		}

		echo $args['before_widget'];

		if (!empty( $title )):

        	echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
        
    	endif;

		echo '<div class="widget-about-me">';	?>

					<div class="headshot-wrapper"> 

						<?php
						if ( ! empty( $rtam_cover_pic ) ) {			

							$alt_text_c =  __('cover-photo', 'blog-lite');						

							$imgtag = '<img src="' . esc_url( $rtam_cover_pic ) . '" alt="' . esc_attr( $alt_text_c ) . '"/>';
							
							echo sprintf( '<div class="header-image">%s</div>',									
								$imgtag					
							);				

						} // End if : cover image is there.
						

						if ( ! empty( $rtam_profile_pic ) ) {
							
							$alt_text_p =  __('profile-photo', 'blog-lite');						

							$imgtag_p = '<img src="' . esc_url( $rtam_profile_pic ) . '" alt="' . esc_attr( $alt_text_p ) . '"/>';

							if ( $rtam_disable_link_in_pic ) {
								
								echo sprintf( '<div class="headshot">%s</div>', $imgtag_p );

							} else {
								echo sprintf( '<div class="headshot">%s%s%s</div>',
									$instance['link_open'],
									$imgtag_p,
									$instance['link_close']
								);
							}								

						} // End if : profile image is there.
					    ?>
					    
					</div><!-- .headshot-wrapper -->

					<div class="entry-content profile-content">
						<?php 
						if ( $rtam_intro_title ) {

							echo '<p><span>';

							if ( $rtam_disable_link_in_title ) {

								echo sprintf( '%s', $rtam_intro_title );

							} else {

								echo sprintf( '%s%s%s',
											$instance['link_open'],
											$rtam_intro_title,
											$instance['link_close']
										);
							}
							echo '</p></span>';
						} 

						if ( ! empty( $rtam_short_bio ) || ! empty( $rtam_intro_title ) ) {

							echo '<p>';	

								

								if ( ! empty( $rtam_short_bio ) ) {

									echo sprintf( '<p>%s</p>', wp_kses_post( $rtam_short_bio ) );

								}

							echo '</p>';
						} ?>					    
					   
					</div>
			<?php 	

		echo '</div>';



		echo $args['after_widget'];

	}

	/**
	 * Handles updating settings for the current widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user.
	 * @param array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title']                        = sanitize_text_field( $new_instance['title'] );
		$instance['rtam_cover_pic']               = esc_url_raw( $new_instance['rtam_cover_pic'] );
		$instance['rtam_profile_pic']             = esc_url_raw( $new_instance['rtam_profile_pic'] );
		$instance['rtam_intro_title']             = sanitize_text_field( $new_instance['rtam_intro_title'] );	
		$instance['rtam_link']                    = esc_url_raw( $new_instance['rtam_link'] );
		
		$instance['rtam_open_link']               = isset( $new_instance['rtam_open_link'] );
		$instance['rtam_disable_link_in_title']   = isset( $new_instance['rtam_disable_link_in_title'] );
		$instance['rtam_disable_link_in_pic'] 	  = isset( $new_instance['rtam_disable_link_in_pic'] );
		
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['rtam_short_bio'] = $new_instance['rtam_short_bio'];
		} else {
			$instance['rtam_short_bio'] = wp_kses_post( $new_instance['rtam_short_bio'] );
		}

		return $instance;

	}

	/**
	 * Outputs the widget settings form.
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance Current settings.
	 */
	function form( $instance ) {

		// Defaults.
		$instance = wp_parse_args( (array) $instance, array(
			'title'                        => '',
			'rtam_cover_pic'               => '',
			'rtam_profile_pic'             => '',
			'rtam_intro_title'			   => '',
			'rtam_short_bio'           	   => '',			
			'rtam_link'                    => '',			
			'rtam_open_link'               => 0,			
			'rtam_disable_link_in_title'   => 0,
			'rtam_disable_link_in_pic' 	   => 0,
			) );
		?>
	    <p>
	        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
	        	<?php _e( 'Title', 'blog-lite' ); ?>:
	        </label>
	        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
	    </p>	    

		<div class="cover-image">
			<label for="<?php echo esc_attr( $this->get_field_id( 'rtam_cover_pic' ) ); ?>">
				<?php esc_html_e( 'Cover Photo', 'blog-lite' ); ?>:
			</label><br />
			<input type="text" class="img widefat" name="<?php echo esc_attr( $this->get_field_name( 'rtam_cover_pic' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'rtam_cover_pic' ) ); ?>" value="<?php echo esc_url( $instance['rtam_cover_pic'] ); ?>" /><br />
			<input type="button" class="select-img button button-primary" value="<?php _e( 'Upload', 'blog-lite' ); ?>" data-uploader_title="<?php _e( 'Select Cover Photo', 'blog-lite' ); ?>" data-uploader_button_text="<?php _e( 'Choose Image', 'blog-lite' ); ?>" style="margin-top:5px;" />

			<?php
			$rtam_cover_pic = '';

			if ( ! empty( $instance['rtam_cover_pic'] ) ) {

				$rtam_cover_pic = $instance['rtam_cover_pic'];

			}

			$wrap_style = '';

			if ( empty( $rtam_cover_pic ) ) {

				$wrap_style = ' style="display:none;" ';
			}
			?>
			<div class="rtam-preview-wrap" <?php echo $wrap_style; ?>>
				<img src="<?php echo esc_url( $rtam_cover_pic ); ?>" alt="<?php _e( 'Preview', 'blog-lite' ); ?>" style="max-width: 100%;"  />
			</div><!-- .rtam-preview-wrap -->

		</div>
		<br />
	    <div class="profile-image">
			<label for="<?php echo esc_attr( $this->get_field_id( 'rtam_profile_pic' ) ); ?>">
				<?php esc_html_e( 'Profile Picture', 'blog-lite' ); ?>:
			</label><br />
			<input type="text" class="img widefat" name="<?php echo esc_attr( $this->get_field_name( 'rtam_profile_pic' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'rtam_profile_pic' ) ); ?>" value="<?php echo esc_url( $instance['rtam_profile_pic'] ); ?>" /><br />
			<input type="button" class="select-img button button-primary" value="<?php _e( 'Upload', 'blog-lite' ); ?>" data-uploader_title="<?php _e( 'Select Profile Photo', 'blog-lite' ); ?>" data-uploader_button_text="<?php _e( 'Choose Image', 'blog-lite' ); ?>" style="margin-top:5px;" />

			<?php
			$rtam_profile_pic = '';

			if ( ! empty( $instance['rtam_profile_pic'] ) ) {

				$rtam_profile_pic = $instance['rtam_profile_pic'];

			}

			$wrap_style = '';

			if ( empty( $rtam_profile_pic ) ) {

				$wrap_style = ' style="display:none;" ';
			}
			?>
			<div class="rtam-preview-wrap" <?php echo $wrap_style; ?>>
				<img src="<?php echo esc_url( $rtam_profile_pic ); ?>" alt="<?php _e( 'Preview', 'blog-lite' ); ?>" style="max-width: 100%;"  />
			</div><!-- .rtam-preview-wrap -->

		</div> 

		<p>
		    <label for="<?php echo esc_attr( $this->get_field_id( 'rtam_intro_title' ) ); ?>">
		    	<?php _e( 'Intro Title', 'blog-lite' ); ?>:
		    </label>
		    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'rtam_intro_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'rtam_intro_title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['rtam_intro_title'] ); ?>" />
		</p>

		<p>
		  <label for="<?php echo esc_attr( $this->get_field_id( 'rtam_short_bio' ) ); ?>">
		  	<?php _e( 'Short Bio', 'blog-lite' ); ?>:
		  </label>
		  <textarea class="widefat" rows="4" id="<?php echo esc_attr( $this->get_field_id( 'rtam_short_bio' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'rtam_short_bio' ) ); ?>"><?php echo esc_textarea( $instance['rtam_short_bio'] ); ?></textarea>
		</p>	    

	    <p>
	      <label for="<?php echo esc_attr( $this->get_field_id( 'rtam_link' ) ); ?>"><?php _e( 'Link', 'blog-lite' ); ?>:</label>
	        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'rtam_link' ) ); ?>"
	        name="<?php echo esc_attr( $this->get_field_name( 'rtam_link' ) ); ?>" type="text" value="<?php echo esc_url( $instance['rtam_link'] ); ?>" />
	    </p>

	    <p>
	    	<input id="<?php echo esc_attr( $this->get_field_id( 'rtam_open_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'rtam_open_link' ) ); ?>" type="checkbox" <?php checked( isset( $instance['rtam_open_link'] ) ? $instance['rtam_open_link'] : 0 ); ?> />
	      	<label for="<?php echo esc_attr( $this->get_field_id( 'rtam_open_link' ) ); ?>"><?php _e( 'Open in New Tab', 'blog-lite' ); ?></label>	      
	    </p>

	    <p>
	    	<input id="<?php echo esc_attr( $this->get_field_id( 'rtam_disable_link_in_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'rtam_disable_link_in_title' ) ); ?>" type="checkbox" <?php checked( isset( $instance['rtam_disable_link_in_title'] ) ? $instance['rtam_disable_link_in_title'] : 0 ); ?> />
	      	<label for="<?php echo esc_attr( $this->get_field_id( 'rtam_disable_link_in_title' ) ); ?>"><?php _e( 'Disable Link in Title', 'blog-lite' ); ?></label>	      
	    </p>

	    <p>
	    	<input id="<?php echo esc_attr( $this->get_field_id( 'rtam_disable_link_in_pic' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'rtam_disable_link_in_pic' ) ); ?>" type="checkbox" <?php checked( isset( $instance['rtam_disable_link_in_pic'] ) ? $instance['rtam_disable_link_in_pic'] : 0 ); ?> />
	      	<label for="<?php echo esc_attr( $this->get_field_id( 'rtam_disable_link_in_pic' ) ); ?>"><?php _e( 'Disable Link in Profile Picture', 'blog-lite' ); ?></label>	      
	    </p>

	    
		<?php
	}
}
