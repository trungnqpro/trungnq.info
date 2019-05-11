<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blog_Lite
 */

$theme_options = blog_lite_theme_options(); ?>

			</div><!-- .row -->
		</div><!-- .container -->

		<div class="footer-widget-wrapper">
			<div class="container">
			    <div class="row">
			    	<?php if ( is_active_sidebar( 'footer-1' ) ) { ?>
				        <div class="col col-1-of-3">
				            <?php dynamic_sidebar( 'footer-1' ); ?>
				        </div><!-- .col -->
			        <?php } ?>

			        <?php if ( is_active_sidebar( 'footer-2' ) ) { ?>
				        <div class="col col-1-of-3">
				            <?php dynamic_sidebar( 'footer-2' ); ?>
				        </div><!-- .col -->
			        <?php } ?>

			        <?php if ( is_active_sidebar( 'footer-3' ) ) { ?>
				        <div class="col col-1-of-3">
				            <?php dynamic_sidebar( 'footer-3' ); ?>
				        </div><!-- .col -->
			        <?php } ?>

			    </div><!-- .row -->		
		    </div><!-- .container -->	
		</div><!-- .footer-widget-wrapper -->

	</div><!-- #content -->	

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<div class="container">
			    <div class="footer">
			        <div class="row">
			            <div class="col col-1-of-1">
			            	<?php if( 0 == $theme_options['footer_social'] ){ ?>
				                <div class="footer-socials-section">
				                	<?php do_action( 'blog_lite_social_links' ); ?>
				                    
				                </div><!-- .footer-socials-section -->
				            <?php } ?>

			                <div class="footer-copyright">
			                	<?php do_action( 'blog_lite_copyright' ); ?>		                    

			                    <?php if( 0 == $theme_options['scroll_top'] ){ ?>
				                    <div class="go-to-top">
				                        <a href="#" class="go-to-top-link"> <i class="fa fa-angle-up"></i><br><?php esc_html_e('Back To Top', 'blog-lite'); ?></a>
				                    </div><!-- .go-to-top -->
			                    <?php } ?>

			                </div><!-- .footer-copyright -->
			            </div><!-- .col -->
			        </div><!-- .row -->

			    </div><!-- .footer -->
			</div><!-- .container -->				
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
