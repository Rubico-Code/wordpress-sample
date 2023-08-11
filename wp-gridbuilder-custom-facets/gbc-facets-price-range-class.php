<?php

/**
 * Custom Price Facet class example
 *
 * @class Price_Range_Facet_Class
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Price_Range_Button_Facet_Class {

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
		$rangeVals = array( '', 50, 500, 5000, 5001 );

		return $rangeVals;
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


		$output = '<div class="wpgb-price-range-facet">';
		$output .= '<ul class="wpgb-inline-list">';
		$output .= $this->render_range( $facet, $items );
		$output .= '</ul>';
		$output .= '</div>';

		return $output;

	}

	/**
	 * Price Range buttons
	 *
	 * @access public
	 *
	 * @param array $facet Holds facet settings.
	 * @param array $items Holds facet items.
	 *
	 * @return string Price Range buttons markup.
	 */
	public function render_range( $facet, $items ) {

		$output    = '';
		$rangeVals = array(
			''         => '',
			'0-50'     => 50,
			'51-500'   => 500,
			'501-5000' => 5000,
			'5001'     => 5001
		);

		foreach ( $rangeVals as $key => $rangeVal ) {

			$output .= '<li>' . $this->render_button( $facet, $items, $key, $rangeVal ) . '</li>';
		}

		return $output;

	}

	/**
	 * Render Price Range button
	 *
	 * @access public
	 *
	 * @param array $facet Holds facet settings.
	 * @param array $items Holds facet items.
	 * @param string $rangeVal range value.
	 * @param string $key range key
	 *
	 * @return string Price Range button markup.
	 */
	public function render_button( $facet, $items, $key, $rangeVal ) {
		if ( ! isset( $_REQUEST[ '_' . $facet['slug'] ] ) && $key === '' ) {
			$checked = true;
		} else {
			$checked = in_array( $key, $facet['selected'] );
		}
		$disabled = ! in_array( $rangeVal, (array) $items, true );
		$pressed  = $checked ? 'true' : 'false';
		$tabindex = $disabled ? - 1 : 0;

		$output        = '<div class="wpgb-button" role="button" aria-pressed="' . esc_attr( $pressed ) . '" tabindex="' . esc_attr( $tabindex ) . '">';
		$output        .= '<input type="hidden" name="' . esc_attr( $facet['slug'] ) . '" value="' . esc_attr( $key ) . '"' . disabled( $disabled, true, false ) . '>';
		$laleKeyArr    = explode( '-', $key );
		$laleKeyArr[1] = ( $laleKeyArr[1] != '' ) ? ' - $' . $laleKeyArr[1] : '+';
		$keyLabel      = ( $key === '' ) ? 'All' : '$' . $laleKeyArr[0] . $laleKeyArr[1];
		$output        .= '<span class="wpgb-button-label">' . $keyLabel . '</span>';
		$output        .= '</div>';

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
		if ( isset( $_REQUEST[ '_' . $facet['slug'] ] ) ) {
			$priceArr   = array();
			$priceRange = $_REQUEST[ '_' . $facet['slug'] ];
			$priceArr   = explode( '-', $priceRange );
		}

		if ( $priceRange == '5001' ) {
			$where_clause = " facet_name >= " . $priceArr[0];
		} else {
			$where_clause = " facet_name BETWEEN " . $priceArr[0] . " AND " . $priceArr[1];
		}
		$object_ids = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT object_id AS product_id
						FROM {$wpdb->prefix}wpgb_index
						WHERE slug = %s
						AND $where_clause
						ORDER BY product_id ASC",
				$facet['slug']
			)
		); // WPCS: unprepared SQL ok.

		return $object_ids;

	}
}