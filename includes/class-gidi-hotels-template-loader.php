<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Template Loader
 *
 * @class 		Gidi_template_loader
 * @version		2.2.0
 * @package		gidi_hotesl/includes
 * @category	Class
 * @author 		Peterson Nwaachukwu Umoke <umoke10@hotmail.com>
 * 
 * This template loader is basically written off the woocommerce template loader
 */
class Gidi_hotels_template_loader {

	/**
	 * Write a template base off of woocommerce functionlity
	 * 
	 * this is just a wrapper function just around the woocommerce functionality
	 * 
	 * Basically according to wordpress standards and conventions, anything that is a template part is basically to be used in loop.
	 */
	public function gh_get_template_part($slug, $name = "") {
		$template = "";

		// Look in yourtheme/slug-name.php and yourtheme/woocommerce/slug-name.php
		if ( $name && ! WC_TEMPLATE_DEBUG_MODE ) {
			$template = locate_template( array( "{$slug}-{$name}.php", WC()->template_path() . "../gidi-hotels/{$slug}-{$name}.php" ) );
		}

		// Get default slug-name.php
		if ( ! $template && $name && file_exists( GHROOT . "/public/views/templates/{$slug}-{$name}.php" ) ) {
			$template = GHROOT . "/public/views/templates/{$slug}-{$name}.php";
		}

		// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/woocommerce/slug.php
		if ( ! $template && ! WC_TEMPLATE_DEBUG_MODE ) {
			$template = locate_template( array( "{$slug}.php", WC()->template_path() . "../gidi-hotels/{$slug}.php" ) );
		}

		// Allow 3rd party plugins to filter template file from their plugin.
		$template = apply_filters( 'gh_get_template_part', $template, $slug, $name );

		if ( $template ) {
			load_template( $template, false );
		}
	}

	/**
	 * Like wc_get_template, but returns the HTML instead of outputting.
	 * @see wc_get_template
	 * @since 2.5.0
	 * @param string $template_name
	 */
	public function gh_get_template_html( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
		ob_start();
		$this->gh_get_template( $template_name, $args, $template_path, $default_path );
		return ob_get_clean();
	}

	/**
	 * Get other templates (e.g. product attributes) passing attributes and including the file.
	 *
	 * @access public
	 * @param string $template_name
	 * @param array $args (default: array())
	 * @param string $template_path (default: '')
	 * @param string $default_path (default: '')
	 */
	public function gh_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
		if ( ! empty( $args ) && is_array( $args ) ) {
			extract( $args );
		}

		$located = $this->gh_locate_template( $template_name, $template_path, $default_path );

		if ( ! file_exists( $located ) ) {
			wc_doing_it_wrong( __FUNCTION__, sprintf( __( '%s does not exist.', 'woocommerce' ), '<code>' . $located . '</code>' ), '2.1' );
			return;
		}

		// Allow 3rd party plugin filter template file from their plugin.
		$located = apply_filters( 'gh_get_template', $located, $template_name, $args, $template_path, $default_path );

		// do_action( 'woocommerce_before_template_part', $template_name, $template_path, $located, $args );

		include( $located );

		// do_action( 'woocommerce_after_template_part', $template_name, $template_path, $located, $args );
	}

	/**
	 * Locate a template and return the path for inclusion.
	 *
	 * This is the load order:
	 *
	 *      yourtheme       /   $template_path  /   $template_name
	 *      yourtheme       /   $template_name
	 *      $default_path   /   $template_name
	 *
	 * @access public
	 * @param string $template_name
	 * @param string $template_path (default: '')
	 * @param string $default_path (default: '')
	 * @return string
	 */
	public function gh_locate_template( $template_name, $template_path = '', $default_path = '' ) {
		if ( ! $template_path ) {
			$template_path = WC()->template_path();
		}

		if ( ! $default_path ) {
			$default_path = GHROOT . '/public/views/templates/';
		}

		// Look within passed path within the theme - this is priority.
		$template = locate_template(
			array(
				trailingslashit( $template_path ) . $template_name,
				$template_name,
			)
		);

		// Get default template/
		if ( ! $template || WC_TEMPLATE_DEBUG_MODE ) {
			$template = $default_path . $template_name;
		}

		// Return what we found.
		return apply_filters( 'gh_locate_template', $template, $template_name, $template_path );
	}
}