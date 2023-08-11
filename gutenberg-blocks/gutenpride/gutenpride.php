<?php
/**
 * Plugin Name:       Gutenpride
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 5.9
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       gutenpride
 *
 * @package           create-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
//https://make.wordpress.org/core/2022/10/12/block-api-changes-in-wordpress-6-1/
//https://github.com/WordPress/twentytwentythree
//https://make.wordpress.org/test/2022/09/21/help-test-wordpress-6-1/

require_once( 'inc/gutenpride-patterns.php' );
//Register Block Pattern Category
////https://make.wordpress.org/core/2022/05/03/page-creation-patterns-in-wordpress-6-0/
register_block_pattern_category(
	'gutenpride',
	array(
		'label' => __( 'Guten Pride', 'gutenpride' ),
	)
);
//Lock GutenPride Block
//https://developer.wordpress.org/block-editor/how-to-guides/curating-the-editor-experience/#utilizing-patterns
add_filter( 'block_editor_settings_all', function ( $settings, $context ) {
	if ( $context->post && 'page' === $context->post->post_type ) {
		$settings['canLockBlocks'] = false;
	}

	return $settings;
}, 10, 2 );

function render_block_category_posts( $attributes ) {
	$args = array( 'posts_per_page' => 10, 'offset' => 0, 'category' => $attributes['selectedCategory'] );

	$allPosts = get_posts( $args );
	$count    = 1;
	$cards    = '';
	foreach ( $allPosts as $recentPost ) :
		$cards .= '<div class="components-item-group">
			<div class="post-list" data-aos="fade-up">

				<div class="post-content" data-aos="fade-up">
					<h3><a href="' . get_permalink( $recentPost->ID ) . '">' . get_the_title( $recentPost->ID ) . '</a></h3>
					<p>' . $recentPost->post_excerpt . '</p>
					<a href="' . get_permalink( $recentPost->ID ) . '" class="view-case-btn">' . __( "Read More" ) . ' <span class="icon-right-arrow"></span></a>
				</div>
			</div>
		</div>';

		$count = $count + 1;
	endforeach;
	wp_reset_postdata();

	return $cards;
}

function create_block_gutenpride_block_init() {
	register_block_type( __DIR__ . '/build', array(
		'render_callback' => 'render_block_category_posts',
	) );
}

add_action( 'init', 'create_block_gutenpride_block_init' );

//Get author information
function get_author_info( $object, $field_name, $request ) {

	/* Get the author name */
	$author_data['display_name'] = get_the_author_meta( 'display_name', $object['author'] );
	/* Get the author link */
	$author_data['author_link'] = get_author_posts_url( $object['author'] );
	/* Get the featured Image url */
	$author_data['feature_img'] = wp_get_attachment_image_src( $object['featured_media'], 'thumbnail',
		false );

	/* Return the author data */

	return $author_data;
}

//Create API fields for additional info Author and Attachment (Featured Image)
add_action( 'rest_api_init', function () {
	register_rest_field(
		'post',
		'author_info',
		array(
			'get_callback'    => 'get_author_info',
			'update_callback' => null,
			'schema'          => null,
		)
	);
} );



