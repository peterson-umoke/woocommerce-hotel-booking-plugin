<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/peterson-umoke/
 * @since      1.0.0
 *
 * @package    Gidi_hotels
 * @subpackage Gidi_hotels/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Gidi_hotels
 * @subpackage Gidi_hotels/public
 * @author     Peterson Nwachukwu Umoke <umoke10@hotmail.com>
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) { 
    exit; // Exit if accessed directly
}

class Gidi_hotels_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Gidi_hotels_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Gidi_hotels_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'sass-compiler.php/gidi-hotels-public.scss', array(), $this->version, 'all' );
		wp_enqueue_style( 'select2', "https://cdn.jsdelivr.net/select2/4.0.3/css/select2.min.css", array(), $this->version, 'all' );
		wp_enqueue_style( 'star-rating', "https://cdn.jsdelivr.net/bootstrap.star-rating/4.0.1/star-rating.min.css", array(), $this->version, 'all' );
		wp_enqueue_style("fontawesome", "https://cdn.jsdelivr.net/fontawesome/4.7.0/css/font-awesome.min.css");
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'scss/gidi-hotels-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Gidi_hotels_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Gidi_hotels_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( "select2", 'https://cdn.jsdelivr.net/select2/4.0.3/js/select2.full.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( "star-rating", "https://cdn.jsdelivr.net/bootstrap.star-rating/4.0.1/star-rating.min.js", array( 'jquery' ), $this->version, false );
		wp_enqueue_script( "lightbox", "https://cdn.jsdelivr.net/colorbox/1.6.4/jquery.colorbox-min.js", array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/gidi-hotels-public.js', array( 'jquery','jquery-ui-button','select2' ), $this->version, false );
		wp_localize_script( $this->plugin_name, "gidi_hotels_api_data", array("site_url" => site_url()) );
	}

}
