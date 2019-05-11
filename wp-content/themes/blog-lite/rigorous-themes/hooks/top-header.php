<?php
/**
 * The top bar hook for our theme.
 *
 * This is the template that displays top header of the theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blog_Lite
 */

if ( ! function_exists( 'blog_lite_top_header_bar' ) ) :

    function blog_lite_top_header_bar(){

        $theme_options  = blog_lite_theme_options();

        if( 1 === $theme_options['top_bar'] ){ ?> 
            
            <div class="top-bar">
                <div class="container">
                    <div class="row">
                        <div class="col col-1-of-2 top-left">
                            <?php if( 'menu' == $theme_options['top_bar_left'] ){ ?>

                                <nav class="top-navigation">
                                    <?php wp_nav_menu( array( 'theme_location' => 'top-bar', 'fallback_cb' => 'blog_lite_menu_fallback', 'container'=> false, 'depth' => 1 ) ); ?>                     
                                </nav><!-- .main-navigation -->

                            <?php } ?>

                            <?php if( 'address' == $theme_options['top_bar_left'] && !empty( $theme_options['top_address'] )){ ?>

                                <address class="top-address">
                                   <i class="fa fa-map-marker"></i><?php echo esc_html( $theme_options['top_address'] );   ?>
                                </address>

                            <?php } ?>

                           <?php 
                           if( 'social-icons' == $theme_options['top_bar_left'] ){ 

                                do_action( 'blog_lite_social_links' ); 

                           } ?>

                        </div><!--.col -->

                        <div class="col col-1-of-2 top-right">

                             <?php if( 'menu' == $theme_options['top_bar_right'] ){ ?>

                                 <nav class="top-navigation">
                                     <?php wp_nav_menu( array( 'theme_location' => 'top-bar', 'fallback_cb' => 'blog_lite_menu_fallback', 'container'=> false, 'depth' => 1 ) ); ?>                     
                                 </nav><!-- .main-navigation -->

                             <?php } ?>

                             <?php if( 'address' == $theme_options['top_bar_right'] && !empty( $theme_options['top_address'] )){ ?>

                                 <address class="top-address">
                                    <i class="fa fa-map-marker"></i><?php echo esc_html( $theme_options['top_address'] );   ?>
                                 </address>

                             <?php } ?>

                            <?php 
                            if( 'social-icons' == $theme_options['top_bar_right'] ){ 

                                 do_action( 'blog_lite_social_links' ); 

                            } ?>

                            <?php
                            if( 'search-form' == $theme_options['top_bar_right'] ){   

                                get_search_form();
                                
                            } ?>
                        </div><!--.col -->
                    </div> <!-- .row -->
                </div> <!-- .container -->
            </div> <!-- .top-bar -->

        <?php 
        }
    }

endif;

add_action( 'blog_lite_top_header', 'blog_lite_top_header_bar', 10 );