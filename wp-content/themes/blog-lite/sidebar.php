<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blog_Lite
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
$theme_options = blog_lite_theme_options();
if( isset( $theme_options['sidebar'] ) && 'no-sidebar' == $theme_options['sidebar'] ) {
	return;
}
?>

<div id="secondary" class="widget-area col col-1-of-3" role="complementary"><!--secondary start-->	
	<div class="sidebar"> 
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</div> <!-- #secondary -->
