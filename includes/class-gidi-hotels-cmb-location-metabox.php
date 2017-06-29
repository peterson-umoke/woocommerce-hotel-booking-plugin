<?php
/*
Plugin Name: CMB2 Field Type: Google Maps
Plugin URI: https://github.com/mustardBees/cmb_field_map
GitHub Plugin URI: https://github.com/mustardBees/cmb_field_map
Description: Google Maps field type for CMB2.
Version: 2.1.2
Author: Phil Wylie
Author URI: http://www.philwylie.co.uk/
License: GPLv2+
*/

/**
 * Class Gidi_hotels_location_metabox
 */
class Gidi_hotels_cmb_location_metabox {

	/**
	 * Initialize the plugin by hooking into CMB2
	 */
	public function __construct() {
		
		
	}

	/**
	 * Render field
	 */
	public function render_gidi_hotels_location_metabox( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {
		require_once GHROOT . "admin/views/cmb2/html-cmb-google-map.php";
	}

	/**
	 * Optionally save the latitude/longitude values into two custom fields
	 */
	public function sanitize_gidi_hotels_location_metabox( $override_value, $value, $object_id, $field_args ) {
		if ( isset( $field_args['split_values'] ) && $field_args['split_values'] ) {
			if ( ! empty( $value['latitude'] ) ) {
				update_post_meta( $object_id, $field_args['id'] . '_gidi_hotels_latitude', $value['latitude'] );
			}

			if ( ! empty( $value['longitude'] ) ) {
				update_post_meta( $object_id, $field_args['id'] . '_gidi_hotels_longitude', $value['longitude'] );
			}
		}

		return $value;
	}
}