<?php
/**
 * Detect if current URL is YouTube or Vimeo
 *
 * @param string.
 *
 * @return string.
 * Created By: RubicoTech
 * @package Custom Genesis Collection
 */
function custom_video_type( $url ) {
	if ( strpos( $url, 'youtube' ) > 0 ) {
		return 'youtube';
	} elseif ( strpos( $url, 'vimeo' ) > 0 ) {
		return 'vimeo';
	} else {
		return 'unknown';
	}
}

/**
 * Get video ID from YouTube URL
 *
 * @param string.
 *
 * @return ID.
 * Created By: RubicoTech
 * @package Custom Genesis Collection
 */
function custom_get_youtube_video_id( $url ) {
	parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
	if ( $my_array_of_vars['v'] ) {
		return $my_array_of_vars['v'];
	} else {
		$video_id = explode( "embed/", $url );

		return $video_id[1];
	}
}

/**
 * Get video ID from Vimeo URL
 *
 * @param string.
 *
 * @return ID.
 * Created By: RubicoTech
 * @package Custom Genesis Collection
 */
function custom_get_vimeo_video_id( $url ) {
	return substr( parse_url( $url, PHP_URL_PATH ), 1 );
}

/**
 * Allow SVG and video mime types for upload
 * Created By: RubicoTech
 * @package Custom Genesis Collection
 */
function custom_cc_mime_types( $mimes ) {
	$mimes['ogv'] = 'video/ogg';

	return $mimes;
}

add_filter( 'upload_mimes', 'custom_cc_mime_types' );