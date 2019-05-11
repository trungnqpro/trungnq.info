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

if ( ! function_exists( 'blog_lite_featured_blocks' ) ) :

    function blog_lite_featured_blocks(){ 

        $theme_options  = blog_lite_theme_options();

        if( 1 === $theme_options['featured_enable'] ){ ?> 

            <div class="featured-block-section">
                <div class="container">
                        <div class="row">
                            <div class="col col-1-of-1 medium-section-padding">
                                <ul class="featured-boxes-wrapper">
                                <?php                         

                                    $block_cat      = $theme_options['blocks_cat'];

                                    $block_pids     = $theme_options['block_post_ids'];

                                    if( 'category' === $theme_options['blocks_type'] && !empty( $block_cat )){

                                        $block_args = array(
                                                        'cat'                   => absint( $block_cat ),
                                                        'post_type'             => 'post',
                                                        'posts_per_page'        => 3,
                                                        'post_status'           => 'publish', 
                                                        'ignore_sticky_posts'   => 1,       
                                                    );

                                    } elseif( 'post_ids' === $theme_options['blocks_type'] && !empty( $block_pids ) ){

                                        $block_ids = explode(',', $block_pids);

                                        $block_args = array(
                                                        'post__in'              => $block_ids,
                                                        'post_type'             => 'post',
                                                        'posts_per_page'        => 3,
                                                        'post_status'           => 'publish', 
                                                        'ignore_sticky_posts'   => 1,    
                                                        'orderby'               => 'post__in',
                                                    );

                                    } else{

                                        $block_args = array(                                                 
                                                        'posts_per_page'        => 3,
                                                        'post_type'             => 'post',
                                                        'post_status'           => 'publish',  
                                                        'ignore_sticky_posts'   => 1,      
                                                    );

                                    }                                

                                    $block_query = new WP_Query( $block_args );

                                    if( $block_query->have_posts() ){ 

                                        while( $block_query->have_posts()){

                                            $block_query->the_post(); ?>

                                            <li class="featured-box">
                                                <a href="<?php the_permalink(); ?>">  
                                                    
                                                    <?php if( has_post_thumbnail() ){ ?>                  
                                                        <div class="featured-box-img">
                                                            <?php the_post_thumbnail('blog-lite-block'); ?>
                                                        </div><!-- .featured-box-img -->
                                                    <?php } ?>

                                                   
                                                    <div class="box-text v-center">
                                                        <span class="featured-box-title"><?php the_title(); ?></span>
                                                    </div><!-- .box-text -->
                                                   

                                                </a>                
                                            </li><!-- .featured-box -->

                                            <?php 
                                        }
                                        
                                        wp_reset_postdata();

                                    } ?>                                
                                </ul><!-- .featured-boxs-wrapper-->
                            </div><!-- .col -->
                        </div><!-- .row -->
                </div><!-- .container -->
            </div>

        <?php 
        }
    }

endif;

add_action( 'blog_lite_featured_blocks', 'blog_lite_featured_blocks', 10 );