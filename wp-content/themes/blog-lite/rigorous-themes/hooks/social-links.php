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

if ( ! function_exists( 'blog_lite_social_links' ) ) :

    function blog_lite_social_links(){

    $theme_options  = blog_lite_theme_options(); 

    $facebook       = $theme_options['facebook'];
    $twitter        = $theme_options['twitter'];
    $google_plus    = $theme_options['google_plus'];
    $instagram      = $theme_options['instagram'];
   
    ?> 

        <ul class="social-list">
            <?php if( $facebook ){ ?>
                <li>
                    <a href="<?php echo esc_url( $facebook ); ?>" target="_blank"><i class="fa fa-facebook"></i><span><?php esc_html_e('Facebook', 'blog-lite'); ?></span></a>
                </li>
            <?php } ?>

            <?php if( $twitter ){ ?>
                <li>
                    <a href="<?php echo esc_url( $twitter ); ?>" target="_blank"><i class="fa fa-twitter"></i><span><?php esc_html_e('Twitter', 'blog-lite'); ?></span></a>
                </li>
            <?php } ?>

            <?php if( $google_plus ){ ?>
                <li>
                    <a href="<?php echo esc_url( $google_plus ); ?>" target="_blank"><i class="fa fa-google-plus"></i><span><?php esc_html_e('Google+', 'blog-lite'); ?></span></a>
                </li>
            <?php } ?>

            <?php if( $instagram ){ ?>
                <li>
                    <a href="<?php echo esc_url( $instagram ); ?>" target="_blank"><i class="fa fa-instagram"></i><span><?php esc_html_e('Instagram', 'blog-lite'); ?></span></a>
                </li>
            <?php } ?>            
          
        </ul>

    <?php }

endif;

add_action( 'blog_lite_social_links', 'blog_lite_social_links', 10 );