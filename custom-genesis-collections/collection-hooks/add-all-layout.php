<?php
// Register Home Layout
genesis_blocks_register_layout_component(
	[
		'type'       => 'layout',
		'key'        => 'genesis_example_home',
		'name'       => __( 'Custom Genesis Home Page', 'exampleLayouts' ),
		'content'    => require_once WP_PLUGIN_DIR . '/custom-genesis-collections/layouts/home.php',
		'category'   => [
			'Genesis Blocks',
		],
		'keywords'   => [
			'Home',
		],
		'image'      => CUSTOM_GENESIS_PLUGIN_URL . 'assets/generic-slider.png',
		'collection' => [
			'slug'      => 'custom-genesis',
			'label'     => 'Custom Genesis Collection',
			'thumbnail' => CUSTOM_GENESIS_PLUGIN_URL . 'assets/generic-slider.png',
		],
	]
);


//single post
genesis_blocks_register_layout_component(
	[
		'type'       => 'layout',
		'key'        => 'genesis_single_post',
		'name'       => __( 'Custom Genesis Single Post', 'exampleLayouts' ),
		'content'    => require_once WP_PLUGIN_DIR . '/custom-genesis-collections/layouts/single-post.php',
		'category'   => [
			'Genesis Blocks',
		],
		'keywords'   => [
			'single',
			'post',
			'single post'
		],
		'image'      => CUSTOM_GENESIS_PLUGIN_URL . 'assets/generic-slider.png',
		'collection' => [
			'slug'      => 'custom-genesis',
			'label'     => 'Custom Genesis Collection',
			'thumbnail' => CUSTOM_GENESIS_PLUGIN_URL . 'assets/generic-slider.png',
		],
	]
);