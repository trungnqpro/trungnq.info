<?php
/**
 *  Default theme options
 */
if ( !function_exists('blog_lite_default_options') ) :

    function blog_lite_default_options() {

        $default_options = array(
            'site_identity'             => 'title-text',         
            'sticky_header'             => 1,
            'top_bar'                   => 1,
            'top_bar_left'              => 'social-icons',
            'top_bar_right'             => 'search-form',
            'top_address'               => '',           
            'slider_enable'             => 1,
            'date_enable'               => 1,
            'read_more_enable'          => 1,
            'main_slider_type'          => 'slider',
            'slider_cat'                => '',
            'slider_readmore_text'      =>  __( 'Continue Reading', 'blog-lite' ), 
            'main_slider_effect'        => 'none',
            'blog_Lite_autoslide'       => 'false',
            'banner_image'              => '',
            'banner_title'              => __('Blog Lite - Responsive Blog Theme', 'blog-lite'),
            'banner_sub_title'          => __('For stunning blogs and websites', 'blog-lite'),
            'banner_link'               => '',
            'featured_enable'           => 0,
            'breadcumb_onhomepage'      => 0,
            'breadcrumb_enable'         => 0,
            'breadcumb_seperator'       => '>>',
            'blocks_type'               => 'category',
            'blocks_cat'                => '',
            'block_post_ids'            => '',            
            'home_layout'               => 'layout-1',
            'facebook'                  => '',
            'twitter'                   => '',
            'google_plus'               => '',
            'instagram'                 => '',       
            'sidebar'                   => 'right',          
            'hide_meta'                 => 0,            
            'readmore_text'             =>  __( 'Continue Reading', 'blog-lite' ), 
            'excerpt_length'            => 40,
            'hide_social_share'         => 0,
            'footer_social'             => 0,           
            'copyright'                 => __('Copyright 2016. All rights reserved', 'blog-lite'),      
            'scroll_top'                => 0,      

        );

        return apply_filters( 'blog_lite_defaults', $default_options );

    }

endif;


/**
*  Get theme options
*/
if ( !function_exists('blog_lite_theme_options') ) :

    function blog_lite_theme_options() {

        $blog_lite_defaults = blog_lite_default_options();

        $blog_lite_option_values = get_theme_mod( 'blog_lite');

        if( is_array($blog_lite_option_values )){

            return array_merge( $blog_lite_defaults ,$blog_lite_option_values );

        }
        else{

            return $blog_lite_defaults;

        }

    }
endif;