<?php

/**
 * Toggle Switch Facet class example
 *
 * @class Toggle_Switch_Facet_Class
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Toggle_Switch_Button_Facet_Class {

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {
	}

	/**
	 * Render facet choices
	 *
	 * @access public
	 *
	 * @param array $facet Holds facet settings.
	 * @param array $items Holds facet items.
	 *
	 * @return string Facet markup.
	 */
	public function render_facet( $facet, $items ) {

		$output = '<div class="wpgb-ab-switch-facet">';
		$output .= $this->render_toggle_switch( $facet, $items );
		$output .= '</div>';

		return $output;

	}

	/**
	 * Toggle Switch Button
	 *
	 * @access public
	 *
	 * @param array $facet Holds facet settings.
	 * @param array $items Holds facet items.
	 *
	 * @return string Toggle Switch buttons markup.
	 */
	public function render_toggle_switch( $facet, $items ) {
		$isCheck = ( $_REQUEST[ '_' . $facet['slug'] ] == 'on' ) ? ' checked ' : '';
		$output  = '<div class="toggle-container">
	<span class="toggle-label">' . __( "All", "gb-custom-facets" ) . '</span>
 	 <div class="button-toggle switch solutions-switch" id="toggle-switch">
    	<input class="checkbox"  name="' . esc_attr( $facet['slug'] ) . '" type="checkbox"  ' . $isCheck . '>
    	<div class="knobs"></div>
		<div class="layer"></div></div>
  <span class="toggle-label">' . __( "Buy Now", "gb-custom-facets" ) . '</span>
</div>';

		return $output;

	}

	/**
	 * Query object ids (post, user, term) for selected facet values
	 *
	 * @param array $facet Holds facet settings.
	 *
	 * @return array Holds queried facet object ids.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function query_objects( $facet ) {

		global $wpdb;
		//	$isCheck =
		$where_clause = ( $_REQUEST[ '_' . $facet['slug'] ] == 'on' ) ? " facet_value = 1 " . " ORDER BY {$wpdb->prefix}wpgb_index.object_id  DESC" : " ORDER BY {$wpdb->prefix}wpgb_index.object_id  DESC";
		$object_ids   = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT object_id AS product_id
						FROM {$wpdb->prefix}wpgb_index
						WHERE slug = %s
						AND $where_clause",
				$facet['slug']
			)
		); // WPCS: unprepared SQL ok.

		return $object_ids;

	}
}