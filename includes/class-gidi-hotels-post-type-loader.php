<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Class Gidi_hotels_post_type_loader
 *
 * @class Gidi_hotels_post_type_loader
 * @package gidi-hotels/
 * @subpackage gidi-hotels/includes
 * @author Code Vision
 */
class Gidi_hotels_post_type_loader {
	/**
	 * Initialize template loader
	 *
	 * @access public
	 * @return void
	 */
	public static function init() {
		
	}

	/**
	 * Default templates
	 *
	 * @access public
	 * @param string $template
	 * @return string
	 * @throws Exception
	 */
	public static function templates( $template ) {
		$post_type = get_post_type();
		$custom_post_types = array( 'gidi_hotels' );

		if ( in_array( $post_type, $custom_post_types ) ) {
			if ( is_archive() ) {
				if ( is_tax() ) {
					return self::locate( 'taxonomy-' . get_query_var( 'taxonomy' ) );
				}

				return self::locate( 'archive-' . $post_type );
			}

			if ( is_single() ) {
				return self::locate( 'single-' . $post_type );
			}
		}

		return $template;
	}

	/**
	 * Gets template path
	 *
	 * @access public
	 * @param string $name
	 * @param string $plugin_dir
	 * @return string
	 * @throws Exception
	 */
	public static function locate( $name, $plugin_dir = GHROOT ) {
		$template = '';

		// Current theme base dir
		if ( ! empty( $name ) ) {
			$template = locate_template( "{$name}.php" );
		}

		// Child theme
		if ( ! $template && ! empty( $name ) && file_exists( get_stylesheet_directory() . "/gidi-hotels-templates/{$name}.php" ) ) {
			$template = get_stylesheet_directory() . "/gidi-hotels-templates/{$name}.php";
		}

		// Original theme
		if ( ! $template && ! empty( $name ) && file_exists( get_template_directory() . "/gidi-hotels-templates/{$name}.php" ) ) {
			$template = get_template_directory() . "/gidi-hotels-templates/{$name}.php";
		}

		// Plugin
		if ( ! $template && ! empty( $name ) && file_exists( $plugin_dir . "/public/views/post-types/{$name}.php" ) ) {
			$template = $plugin_dir . "/public/views/post-types/{$name}.php";
		}

		// Nothing found
		if ( empty( $template ) ) {
			throw new Exception( "Template /public/views/post-types/{$name}.php in plugin dir {$plugin_dir} not found." );
		}

		return $template;
	}
}