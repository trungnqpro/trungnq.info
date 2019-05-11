/**
 * Customizer custom js
 */

jQuery(document).ready(function() {
   jQuery('.wp-full-overlay-sidebar-content').prepend('<div class="bloglite-ads"> <a href="http://themepalace.com/downloads/blog-pro/" class="button" target="_blank">{pro}</a></div>'.replace('{pro}',blog_lite_customizer_js_obj.pro));
});