<?php 
if ( ! function_exists( 'custom_theme_support' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook.
 */
function custom_theme_support() {
	// Add support for block styles.
	add_theme_support( 'wp-block-styles' );
	add_theme_support('post-thumbnails');
	// Enqueue editor styles.
	add_editor_style( 'style.css' );
}
endif; // myfirsttheme_setup
add_action( 'after_setup_theme', 'custom_theme_support' );

/*---------------------------
Enqueue styles
---------------------------*/
if ( ! function_exists( 'custom_theme_styles' ) ) :
 function custom_theme_styles(){
     //register stylesheet
     wp_enqueue_style('custom-style',get_stylesheet_uri(),array(),wp_get_theme()->get('Version'));
     wp_enqueue_style('custom-style-block',get_template_directory_uri().'/assets/css/blocks.css');
 }
endif;
 add_action('wp_enqueue_scripts','custom_theme_styles');
/*-----------------------------
Customizing The Excerpt Length
-----------------------------*/
 function custom_excerpt_length($length)
{
	return 25;
}
add_filter( 'excerpt_length','custom_excerpt_length');