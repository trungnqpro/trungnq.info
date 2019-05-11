<?php
/**
 * The slider hook for our theme.
 *
 * This is the template that displays slider of the theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blog_Lite
 */

if ( ! function_exists( 'blog_lite_powerby' ) ) :

    function blog_lite_powerby(){

    $theme_options  = blog_lite_theme_options();      
   
    ?> 

    <div id="copyright">
        	<?php 
			$copyright_footer = $theme_options['copyright']; 
			if ( ! empty( $copyright_footer ) ) {
				$copyright_footer = wp_kses_data( $copyright_footer );
			}
			/* translators: %s: theme */ 
			$powered_by_text = sprintf( __( 'Theme of %s', 'blog-lite' ), '<a target="_blank" rel="designer" href="https://rigorousthemes.com/">Rigorous Themes</a>' ); /* translators: %s: theme info */ 
			?>
			<p><?php echo esc_html( $copyright_footer );?>&nbsp;<?php echo wp_kses_post($powered_by_text);?>&</p>      
    </div>
        

    <?php }

endif;

add_action( 'blog_lite_copyright', 'blog_lite_powerby', 10 );