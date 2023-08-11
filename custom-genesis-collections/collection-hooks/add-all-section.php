<?php
/**
 * All Block Layout Registration
 * Created By: RubicoTech
 * @Package Custom Genesis Collection
 */

// Register the Generic Slider
genesis_blocks_register_layout_component(
	[
		'type'       => 'section',
		'key'        => 'genesis_generic_slider',
		'name'       => __( 'Generic Slider', 'customGenericSlider' ),
		'content'    => require_once WP_PLUGIN_DIR . '/custom-genesis-collections/sections/generic-slider.php',
		'category'   => [
			'Text',
		],
		'keywords'   => [
			'Generic',
			'Slider',
			'Generic Slider',
		],
		'image'      => CUSTOM_GENESIS_PLUGIN_URL . 'assets/generic-slider.png',
		'collection' => [
			'slug'  => 'custom-genesis',
			'label' => 'Custom Genesis Collection',
		],
	]
);