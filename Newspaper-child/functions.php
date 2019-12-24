<?php
/*  ----------------------------------------------------------------------------
    Newspaper V9.0+ Child theme - Please do not use this child theme with older versions of Newspaper Theme

    What can be overwritten via the child theme:
     - everything from /parts folder
     - all the loops (loop.php loop-single-1.php) etc
	 - please read the child theme documentation: http://forum.tagdiv.com/the-child-theme-support-tutorial/

 */

 /*  ----------------------------------------------------------------------------
     Recommended by Flywheel to resolve image upload issues.
  */
 function wpb_image_editor_default_to_gd( $editors ) {
     $gd_editor = 'WP_Image_Editor_GD';
     $editors = array_diff( $editors, array( $gd_editor ) );
     array_unshift( $editors, $gd_editor );
     return $editors;
 }
 add_filter( 'wp_image_editors', 'wpb_image_editor_default_to_gd' );

/*  ----------------------------------------------------------------------------
    add the parent style + style.css from this folder
 */
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 11);
function theme_enqueue_styles() {
    wp_enqueue_style('td-theme', get_template_directory_uri() . '/style.css', '', TD_THEME_VERSION, 'all' );
    wp_enqueue_style('td-theme-child', get_stylesheet_directory_uri() . '/style.css', array('td-theme'), TD_THEME_VERSION . 'c', 'all' );

}

/*
	Get Script and Style IDs
	Adds inline comment to your frontend pages
	View source code near the <head> section
	Lists only properly registered scripts
	@ https://digwp.com/2018/08/disable-script-style-added-plugins/
*/
function shapeSpace_inspect_script_style() {
	
	global $wp_scripts, $wp_styles;
	
	echo "\n" .'<!--'. "\n\n";
	
	echo 'SCRIPT IDs:'. "\n";
	
	foreach($wp_scripts->queue as $handle) echo $handle . "\n";
	
	echo "\n" .'STYLE IDs:'. "\n";
	
	foreach($wp_styles->queue as $handle) echo $handle . "\n";
	
	echo "\n" .'-->'. "\n\n";
	
}
add_action('wp_print_scripts', 'shapeSpace_inspect_script_style');

function mind_defer_scripts( $tag, $handle, $src ) {
  $defer = array( 
    'admin-bar',
    'query-monitor',
    'amazonpolly',
    'select2',
    'geodir-select2',
    'geodir',
    'geodir_lity',
    'geodir-leaflet',
    'geodir-leaflet-geo',
    'leaflet-routing-machine',
    'geodir-o-overlappingmarker',
    'geodir-goMap',
    'jquery-ui-datepicker',
	'hui_scripts',
	'hustle_front',
	'hustle_front_fitie',
	'iml_owl_carousel_vc',
	'iml_jquery_isotope_vc',
	'imt_owl_carousel_vc',
	'imt_isotope_pkgd_min_vc',
	'wpurp_script_minified',
	'monsterinsights-vue-vendors',
	'monsterinsights-vue-common',
	'monsterinsights-vue-frontend',
	'js_files_for_ace',
	'js_files_for_ace_ext_language_tools',
	'js_files_for_ace_ext_searchbox',
	'js_files_for_live_css',
	'js_files_for_plugin_live_css',
	'td-site-min',
	'comment-reply',
	'gadwp-nprogress',
	'gadwp-frontend-item-reports'

  );
  if ( in_array( $handle, $defer ) ) {
     return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>' . "\n";
  }
    
    return $tag;
} 

add_filter( 'script_loader_tag', 'mind_defer_scripts', 10, 3 );