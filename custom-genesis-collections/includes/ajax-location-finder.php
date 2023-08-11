<?php
/**
 * ajax for find a location in auto-complete block,
 * used in : location-service finder Block
 */

add_action( "wp_ajax_get_current_location", "get_current_location" );
add_action( "wp_ajax_nopriv_get_current_location", "get_current_location" );

function get_current_location() {

	if ( ! wp_verify_nonce( $_REQUEST['nonce'], "my_user_vote_nonce" ) ) {
		exit( "Something went wrong" );
	}
	global $wpdb;
	$tableLocations = $wpdb->prefix . 'store_locations';
	$data           = array();
	$zipCode        = ( isset( $_REQUEST['zipCode'] ) && $_REQUEST['zipCode'] != '' ) ? $_REQUEST['zipCode'] : '';
	$geocode        = file_get_contents( 'https://maps.google.com/maps/api/geocode/json?address=' . urlencode( $zipCode ) . '&key=' . esc_attr( get_option( 'gmap_apikey' ) ) );
	$zipCode        = '';
	$geocode        = json_decode( $geocode, true );
	for ( $i = 0; $i < count( $geocode['results'] ); $i ++ ) {
		$location[]         = $geocode['results'][ $i ]['geometry']['location'];
		$address_components = $geocode['results'][ $i ]['address_components'];
		for ( $k = 0; $k < count( $address_components ); $k ++ ) {
			if ( $address_components[ $k ]['types'][0] == 'postal_code' && count( $address_components[ $k ]['types'] ) == 1 ) {
				$zipCode = $address_components[ $k ]['long_name'];
			}
		}
	}
	if ( $zipCode ) {
		$sqlzip = "SELECT * FROM $tableLocations WHERE zip = $zipCode";
		$sqlzip = $wpdb->get_results( $sqlzip, ARRAY_A );
		if ( ! empty( $sqlzip ) ) {
			$data = array( 'status' => 1, 'radius' => 0 );
			echo json_encode( $data );
			die();
		}
	}

	$lat     = $geocode['results'][0]['geometry']['location']['lat'];
	$lng     = $geocode['results'][0]['geometry']['location']['lng'];
	$recodes = zipcodeRadiusCode( $lat, $lng, 20 );


	if ( count( $recodes ) ) {
		$data = array( 'status' => 1, 'radius' => 20 );
	} else {
		$recodes = zipcodeRadiusCode( $lat, $lng, 40 );
		if ( count( $recodes ) ) {
			$data = array( 'status' => 1, 'radius' => 40 );
		} else {
			$data = array( 'status' => 0, 'radius' => 0 );
		}
	}
	echo json_encode( $data );


	die();
}

function zipcodeRadiusCode( $lat, $lon, $radius ) {
	global $wpdb;
	$tableNameUsZips = 'uszips';
	$tableLocations  = $wpdb->prefix . 'store_locations';
	$radius          = $radius ? $radius : 20;
	$sql             = 'SELECT distinct(zip) FROM ' . $tableNameUsZips . '  WHERE (3958*3.1415926*sqrt((lat-' . $lat . ')*(lat-' . $lat . ') + cos(lat/57.29578)*cos(' . $lat . '/57.29578)*(lng-' . $lon . ')*(lng-' . $lon . '))/180) <= ' . $radius . ';';
	$result          = $wpdb->get_results( $sql, ARRAY_A );
	$zipcodeList     = array();
	foreach ( $result as $row ) {
		array_push( $zipcodeList, $row['zip'] );
	}
	$ids    = implode( ', ', $zipcodeList );
	$sqlzip = "SELECT * FROM $tableLocations WHERE zip IN ($ids)";


	$resultLocationZip = $wpdb->get_results( $sqlzip, ARRAY_A );

	return $resultLocationZip;
}

?>