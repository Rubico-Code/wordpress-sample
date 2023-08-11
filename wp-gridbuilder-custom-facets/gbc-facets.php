<?php
/*
Plugin Name:  WP GridBuilder Custom Facets
Plugin URI:   https://rubicotech.com
Description:   It allows to add your own facets with your own logic.
Version:      1.0
Author:       Rubico
Author URI:   https://rubicotech.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  gb-custom-facets
*/
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
require_once 'gbc-facets-price-range-class.php';
require_once 'gbc-facets-toggle-switch-class.php';
require_once 'gbc-facets-toggle-true-false-class.php';

add_action( 'wp_enqueue_scripts', 'custom_facets_assets' );
function custom_facets_assets() {
	wp_enqueue_style( 'gb-fecets-css', plugins_url( '/css/gbc-facets.css', __FILE__ ) );
}

/**
 * @param $facets
 *
 * @return array Holds registered facet arguments
 */
function gbc_register_facet( $facets ) {
	$facets['price_range_button_facet']    = [
		'name'  => __( 'Price Range Button', 'gb-custom-facets' ),
		'type'  => 'filter',
		'class' => 'Price_Range_Button_Facet_Class',
	];
	$facets['toggle_switch_button_facet']  = [
		'name'  => __( 'Toggle Switch Button', 'gb-custom-facets' ),
		'type'  => 'filter',
		'class' => 'Toggle_Switch_Button_Facet_Class',
	];
	$facets['two_toggle_true_false_facet'] = [
		'name'  => __( 'Two Toggle Switch (T/F)', 'gb-custom-facets' ),
		'type'  => 'filter',
		'class' => 'Two_Toggle_True_False_Facet_Class',
	];

	return $facets;
}

add_filter( 'wp_grid_builder/facets', 'gbc_register_facet', 10, 1 );

