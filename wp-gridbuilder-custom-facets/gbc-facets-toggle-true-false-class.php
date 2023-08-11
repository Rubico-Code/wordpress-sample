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

class Two_Toggle_True_False_Facet_Class {

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {
	}

	/**
	 * Query facet choices
	 *
	 * @access public
	 *
	 * @param array $facet Holds facet settings.
	 *
	 * @return array Holds facet items.
	 */
	public function query_facet( $facet ) {
		global $wpdb;
		$where_clause = wpgb_get_where_clause( $facet );
		$facet_names  = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT DISTINCT facet_name AS toggleValue
				FROM {$wpdb->prefix}wpgb_index
				WHERE slug = %s
				AND $where_clause
				GROUP BY toggleValue",
				$facet['slug']
			)
		); // WPCS: unprepared SQL ok.

		return $facet_names;
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
		$output = '<div class="wpgb-true-false-facet">';
		$output .= $this->render_range( $facet, $items );
		$output .= '</div>';

		return $output;
	}

	public function render_range( $facet, $items ) {
		$output = '<div class="toggle-container">';
		$i      = 1;
		foreach ( $items as $rangeVal ) {
			$class_name = 'button-toggle-' . $i;
			$output     .= $this->render_true_false_switch( $facet, $items, $rangeVal, $class_name );
			$i ++;
		}
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
	public function render_true_false_switch( $facet, $items, $rangeVal, $class_name ) {
		$checked  = in_array( $rangeVal, $facet['selected'], true );
		$disabled = ! in_array( $rangeVal, (array) $items, true );
		$pressed  = $checked ? 'true' : 'false';
		$tabindex = $disabled ? - 1 : 0;
		$checkVal = ( $pressed == 'true' ) ? ' checked' : ' ';
		$output   = '<div class="button-toggle switch ' . $class_name . '" id="toggle-switch"><input class="checkbox"  name="' . esc_attr( $facet['slug'] ) . '" type="checkbox" value="' . $rangeVal . '" ' . disabled( $disabled, true, false ) . $checkVal . '>';
		$output   .= '<div class="knobs"></div>
		<div class="layer"></div></div>';


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
		$placeholders = rtrim( str_repeat( '%s,', count( $facet['selected'] ) ), ',' );
		$object_ids   = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT DISTINCT object_id AS object_id
						FROM {$wpdb->prefix}wpgb_index
						WHERE slug = %s
						AND UPPER(LEFT(facet_name, 1)) IN ($placeholders)",
				array_merge( (array) $facet['slug'], $facet['selected'] )
			)
		); // WPCS: unprepared SQL ok.

		return $object_ids;

	}
}
