<?php
/**
 * @package ACF Gutenberg Block
 */
/*
Plugin Name: ACF Gutenberg Block
Plugin URI: #
Description: This is ACF block plugin that helps to create gutenberg block using ACF fields. <strong>Note: </strong> This plugin require pro version of ACF plugin and without ACF pro plugin cannot be installed.
Version: 1.0
Requires at least: 5.0
Requires PHP: 7.4
Author: RubicoTech
Author URI: https://rubicotech.in/
License: GPLv2 or later
Text Domain: acf-gutenberg-block
*/

//define the required constants
define('ACF_GUTENBERG_VERSION', '1.0');
define('ACF_GUTENBERG__PLUGIN_DIR', plugin_dir_path(__FILE__));

// run the action on plugin activation
register_activation_hook(__FILE__, array('ACF_GUTENBERG', 'pluginActivation'));

/**
 * main file to boot plugin files
 */
require_once(ACF_GUTENBERG__PLUGIN_DIR . 'inc/class-acf-gutenberg.php');

// load the ACF block
add_action('init', ['ACF_Gutenberg', 'init']);