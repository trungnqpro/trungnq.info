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

if ( ! function_exists( 'blog_lite_main_slider' ) ) :

  function blog_lite_main_slider(){  

    $theme_options  = blog_lite_theme_options();

    if( 1 === $theme_options['slider_enable'] ){ 

      $read_more      = $theme_options['slider_readmore_text'];

      $readmore       = $theme_options['read_more_enable'];

      $date           = $theme_options['date_enable'];

      if( 'slider' === $theme_options['main_slider_type'] ){ 
        
        if(!empty( $theme_options['slider_cat'] )){
          $slider_args = array( 'cat' => $theme_options['slider_cat'], 'post_status' => 'publish', 'posts_per_page' => 5 );
        } else{
          $slider_args = array( 'post_status' => 'publish', 'posts_per_page' => 5 );
        }
         

        $slider_query = new WP_Query( $slider_args ); 

        if ( $slider_query->have_posts() ) : ?>

          <div id="main-slider" class="owl-carousel">

            <?php while ( $slider_query->have_posts() ) : $slider_query->the_post(); ?>

            <?php $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
              
              <div class="item" style="background-image: url(<?php echo esc_url($image_url[0]); ?>); ">                             
                <div class="caption v-center">
                  <h2><?php the_title(); ?></h2>

                  <?php if( 1 === $date ){ ?>
                    <div class="entry-meta date"><?php echo esc_html( get_the_date( get_option( 'date_format' ) ) ) ; ?></div>
                  <?php } ?>

                  <?php if( 1 === $readmore ){ ?>
                    <div class="readmore"><a href="<?php the_permalink(); ?>"><?php echo esc_html( $read_more ); ?></a></div>
                  <?php } ?>
                </div><!-- .caption -->
              </div>
            <?php endwhile; ?>

          </div>

          <?php wp_reset_postdata(); ?>

        <?php endif; ?>

        
      <?php } else{ ?>

         <div id="main-slider" class="main-banner">

                <?php 
                $banner_img = $theme_options['banner_image'];

                $banner_style = '';

                if( $banner_img ){ 

                  $banner_style = 'style="background-image: url('.esc_url($banner_img).');"';
                  
                } ?>
            
                <div class="item" <?php echo $banner_style; ?>>
                  

                    <div class="caption v-center">
                      <?php 
                      $banner_title = $theme_options['banner_title'];

                        if( $banner_title ){ ?>
                          <h2><?php echo esc_html( $banner_title ); ?></h2>
                        <?php } ?>

                        
                        <?php if( 1 === $date && !empty( $theme_options['banner_sub_title'] )){ ?>
                          <div class="entry-meta date"><?php echo esc_html( $theme_options['banner_sub_title'] ); ?></div>
                        <?php } ?>

                        <?php if( 1 === $readmore && !empty( $theme_options['banner_link'] ) ){ ?>
                          <div class="readmore">
                              <a href="<?php echo esc_url( $theme_options['banner_link'] ); ?>"><?php echo esc_html( $read_more ); ?></a>
                          </div>
                        <?php } ?>


                    </div><!-- .caption -->
                </div><!-- .item -->       
           
        </div><!-- .main-slider -->

      <?php }

    }

  }

endif;

add_action( 'blog_lite_slider', 'blog_lite_main_slider', 10 );

//=============================================================================================
// Function for owlcarousel auto slider, slider transition delay and slider transition duration
//=============================================================================================

if ( ! function_exists( 'blog_lite_load_owl_scripts' ) ) {

function blog_lite_load_owl_scripts() {
   $theme_options  = blog_lite_theme_options(); 

  wp_localize_script('blog-lite-custom-slider', 'blog_lite_script_vars', array(
      'autoplay'      => ($theme_options['blog_Lite_autoslide']),
      'animateOut'    => ($theme_options['main_slider_effect']),
      
    ));
  }
}

add_action('wp_enqueue_scripts', 'blog_lite_load_owl_scripts');