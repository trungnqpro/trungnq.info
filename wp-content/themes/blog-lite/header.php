<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blog_Lite
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php 

	$theme_options = blog_lite_theme_options(); 

	$site_identity 	= $theme_options['site_identity'];

	$header_class 	= 'site-header header primary-header';

	if( 'logo-only' === $site_identity ){

		$header_class = 'site-header header primary-header header-logo-only';

	}elseif ( 'logo-text' === $site_identity ) {

		$header_class = 'site-header header primary-header header-logo-text';
		
	}elseif ( 'title-only' === $site_identity ) {

		$header_class = 'site-header header primary-header header-title-only';	

	}elseif ( 'title-text' === $site_identity ) {
		
		$header_class = 'site-header header primary-header header-title-text';
	}

	?>

	<div id="page" class="hfeed site">
		<header id="masthead" class="<?php echo esc_attr( $header_class ); ?>"  role="banner"> 

			<?php do_action( 'blog_lite_top_header' ); ?>	          

			<div class="container">
				<div class="row">
					<div class="col col-1-of-4">
						<div class="site-branding">
							<?php						

							$title 			= get_bloginfo( 'name', 'display' );

							$description 	= get_bloginfo( 'description', 'display' );

							if( 'logo-only' === $site_identity){

								if ( has_custom_logo() ) {

									the_custom_logo();

								}
							} elseif( 'logo-text' === $site_identity){

								if ( has_custom_logo() ) {

									the_custom_logo();

								}

								if ( $description ) {
									echo '<p class="site-description">'.esc_html( $description ).'</p>';
								}

							} elseif( 'title-only' === $site_identity && $title ){ ?>

								<h1 class="site-title title-only"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php 

							}elseif( 'title-text' === $site_identity){ 

								if( $title ){ ?>

									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
									<?php 
								}

								if ( $description ) {

									echo '<p class="site-description">'.esc_html( $description ).'</p>';

								}
							}

							?>
						</div><!-- .site-branding -->
					</div><!-- .col -->
					<div class="col col-3-of-4">
						<nav class="main-navigation">
							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => 'blog_lite_menu_fallback', 'container'=> false ) ); ?>	                   
						</nav><!-- .main-navigation -->
					</div><!-- .col -->
				</div><!-- .row -->
			</div><!-- .container -->
		</header><!-- #masthead -->

		<?php
		if( is_home() || is_front_page() ){

			do_action( 'blog_lite_slider' );

			do_action( 'blog_lite_breadcrumb_show');

			do_action( 'blog_lite_featured_blocks' );

		} else{ 

			$image_url = get_header_image(); ?>		    	

			<div class="single-header-banner" style="background-image: url(<?php echo esc_url( $image_url ); ?>);">

				<div class="v-center">
					<header class="entry-header">
						<?php 
						if(is_page() || is_single() ){ ?>
							<h2 class="entry-title">
								<?php echo esc_html( get_the_title() ); ?>
							</h2>
							<?php
						} elseif( is_search() ){ ?>
							<h2 class="entry-title"><?php printf( esc_html__( 'Search Results For: %s', 'blog-lite' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
							<?php
						} else{
							the_archive_title( '<h2 class="entry-title">', '</h2>' );
							the_archive_description( '<div class="taxonomy-description">', '</div>' );
						}
						?>
					</header><!-- .entry-header -->

					
					<?php if( 0 === $theme_options['hide_meta'] && is_single() ){ ?>

						<div class="post-details">
							<?php 

							$author_id = get_post_field( 'post_author'); 	       

							?>		        
							<span class="post-by">
								<i class="fa fa-user"></i> <a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>"><?php echo the_author_meta( 'user_nicename' , $author_id ); ?></a>
							</span>
							<span class="post-date"><i class="fa fa-calendar-o"></i> <?php echo esc_html( get_the_date( get_option( 'date_format' ) ) ); ?></span>

							<span class="post-category">
								<i class="fa fa-folder-open-o"></i> <?php echo get_the_category_list( __( ', ', 'blog-lite' ) ); // WPCS: XSS OK.?>
							</span>
						</div><!-- .post-details -->

						<?php } ?>

						<?php do_action( 'blog_lite_breadcrumb_show');?>
						
					</div><!-- .caption -->
				</div><!-- .single-header-banner -->

				<?php 

			} ?>
	<div id="content" class="site-content">
		<div class="container">
			<div class="row">
				