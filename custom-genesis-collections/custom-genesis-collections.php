<?php
/*
    Plugin Name: Custom Genesis Collection
    Plugin URI: custom-genesis-collection
    Description: The Custom Collection for Genesis Blocks
    Version: 0.1.22
    Author: Rubico
    Author URI: #
    License: GPLv3
    License URI: http://www.gnu.org/licenses/gpl-3.0.html
    */

/****Custom Genesis Plugin Automatic Update Starts****/

defined( 'ABSPATH' ) || exit;

/****Custom Genesis Plugin Automatic Update Ends****/

// Needed for adding the PHP Template Method blocks from within the plugin
use function Genesis\CustomBlocks\add_block;

define( "CUSTOM_GENESIS_PLUGIN_URL", plugin_dir_url( __FILE__ ) );
define( "CUSTOM_GENESIS_PLUGIN_DIR", plugin_dir_path( __FILE__ ) );

function plugin_alternate_template_path( $path ) {
	unset( $path );

	return __DIR__;
}

add_filter( 'genesis_custom_blocks_template_path', 'plugin_alternate_template_path' );

function filter_wpseo_breadcrumb_separator( $this_options_breadcrumbs_sep ) {
	return '<img src="' . plugin_dir_url( __FILE__ ) . 'images/breadcrumb_sep.png' . '">';
}

;
add_filter( 'wpseo_breadcrumb_separator', 'filter_wpseo_breadcrumb_separator', 10, 1 );

// removes the code editor option for users without required roles
function disable_code_editor_mode( $block_editor_settings ) {
	$user = wp_get_current_user();
	if ( ! in_array( 'administrator', (array) $user->roles ) ) {
		$block_editor_settings['codeEditingEnabled'] = false;
	}

	return $block_editor_settings;
}

add_filter( 'block_editor_settings', 'disable_code_editor_mode', 10, 1 );

/**
 * Function to add menu locations, so that could call them in navigation module/block
 * Created By: RubicoTech
 * @package Custom Genesis Collection
 */
if ( ! function_exists( 'register_custom_genesis_nav' ) ) {
	function register_custom_genesis_nav() {
		register_nav_menu( 'top_nav', __( 'CUSTOM Top Menu' ) );
		register_nav_menu( 'main_nav', __( 'CUSTOM Primary Menu' ) );
		register_nav_menu( 'footer_nav', __( 'Custom Footer Menu' ) );
	}

	add_action( 'init', 'register_custom_genesis_nav' );
}

/**
 * Generate custom search form
 *
 * @param string $form Form HTML.
 *
 * @return string Modified form HTML.
 * Created By: RubicoTech
 * @package Custom Genesis Collection
 */
if ( ! function_exists( 'custom_genesis_search_form' ) ) {
	function custom_genesis_search_form( $form ) {
		$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <div class="open-search-wrapper"><label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
    <div class="search-input-group">
    <input type="search" class="search-field" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr_x( 'Search', 'placeholder' ) . '" />
    
    </div>
    <div class="mobile-search-submit"><input type="submit" id="searchsubmit" value="' . esc_attr__( 'Search' ) . '" /></div>
    </div>
    </form>';

		return $form;
	}

	add_filter( 'get_search_form', 'custom_genesis_search_form' );
}

// Add PHP Template Method blocks from within the plugin
function add_custom_genesis_manual_blocks() {
	//Include add-block-hooks function's files here from add-block-hooks folder.
	require_once( __DIR__ . '/add-block-hooks/generic-slider.php' );
}

add_action( 'genesis_custom_blocks_add_blocks', 'add_custom_genesis_manual_blocks' );

// Add/include Collection from collection-hooks/layouts folder here
function custom_genesis_collection() {
	// Ensure a proper version of Genesis Blocks is active before continuing.
	if ( ! function_exists( 'genesis_blocks_register_layout_component' ) ) {
		return;
	}
	//Demo Block Section - Testing only Collection. We will remove this section after some time
	require_once( 'collection-hooks/add-all-section.php' );
	require_once( 'collection-hooks/add-all-layout.php' );

	// Load general setup files
	require_once( 'includes/functions-setup.php' );
	require_once( 'includes/ajax-location-finder.php' );

	// Load plugin css and scripts for frontend
	function custom_genesis_collections_plugin_script() {
		// Add plugin specific js
		wp_register_script( 'custom-genesis-slick-js1', plugins_url( '/js/slick.min.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( 'custom-genesis-slick-js1' );
		wp_register_script( 'custom-genesis-slick-lightbox-js', plugins_url( '/js/slick-lightbox.min.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( 'custom-genesis-slick-lightbox-js' );
		wp_register_script( 'custom-genesis-collections-js', plugins_url( '/js/custom.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( 'custom-genesis-collections-js' );

		// AOS JS
		wp_register_script( 'custom-genesis-aos-js', plugins_url( '/js/aos.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( 'custom-genesis-aos-js' );


		// Add plugin specific css
		wp_enqueue_style( 'custom-genesis-collections-css-material-icon', 'https://fonts.googleapis.com/css2?family=Material+Icons' );
		if ( ! is_admin() ) {
			wp_enqueue_style( 'custom-genesis-collections-css-variables', plugins_url( '/css/aos.css', __FILE__ ) );
		}
		wp_enqueue_style( 'custom-genesis-collections-css-variables', plugins_url( '/css/variables.css', __FILE__ ) );
		wp_enqueue_style( 'custom-genesis-collections-styles', plugins_url( '/css/custom.css', __FILE__ ) );

	}

	add_action( 'wp_enqueue_scripts', 'custom_genesis_collections_plugin_script' );
	add_action( 'admin_enqueue_scripts', 'custom_genesis_collections_plugin_script', 0 );

	// Remove other collections
	function non_brand_collection_remover() {
		// Clean up other collections and only show the custom genesis collection and sections
		add_filter(
			'genesis_blocks_allowed_layout_components',
			function ( $layouts ) {
				// Return an array of unique section/layout keys that are allowed.
				return [
					'genesis_generic_slider',
				];
			}
		);
	}

	add_action( 'plugins_loaded', 'non_brand_collection_remover', 13 );
}

add_action( 'plugins_loaded', 'custom_genesis_collection', 12 );

if ( ! isset( $locale ) ) {
	$locale = '';
}

$allTextDomains = require __DIR__ . '/textDomains.php';
$mo_file_path   = sprintf(
	'%s/%s-%s.mo',
	CUSTOM_GENESIS_PLUGIN_DIR . 'languages',
	'custom-genesis-collections',
	$locale
);
$domain_path    = path_join( CUSTOM_GENESIS_PLUGIN_DIR, 'languages' );

foreach ( $allTextDomains as $textDomain ):
	load_textdomain( $textDomain, path_join( $domain_path, $mo_file_path ) );
endforeach;
