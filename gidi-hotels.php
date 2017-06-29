<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/peterson-umoke/
 * @since             1.0.0
 * @package           Gidi_hotels
 *
 * @wordpress-plugin
 * @woocommerce-plugin
 * 
 * Plugin Name:       Gidi Hotels and Booking
 * Plugin URI:        https://github.com/peterson-umoke/gidi-hotels
 * Description:       This is the plugin responsible for the hotel and booking part of the gidievents website. It has a lot of functionality added. It comes installed with a shortcode display, widget bundles and others.
 * Version:           1.0.0
 * Author:            Peterson Nwachukwu Umoke
 * Author URI:        https://github.com/peterson-umoke/
 * Developer: 		  Peterson Nwachukwu Umoke
 * Developer URI: 	  https://github.com/peterson-umoke/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gidi-hotels
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) { 
    exit; // Exit if accessed directly
}

/**
 * Define the root of the project
 */
if( !defined( "GHROOT" ) ){
	define( "GHROOT", plugin_dir_path( __FILE__ ) );
}

/**
 * Define the url of the project
 */
if( !defined( "GHURL" ) ){
	define( "GHURL", plugin_dir_url( __FILE__ ) );
}

/**
 * Define the directory separator of the project
 */
if( !defined( "GHDS" ) ){
	define( "GHDS", DIRECTORY_SEPARATOR );
}

/**
 * Initiate the woocommerce setup simply because, this is a woocommerce based plugin.
 * 
 * @todo find the better way of creating a product type without using a plain function call
 */
require_once GHROOT . "admin" . GHDS . "class-gidi-hotels-product-type.php";

/**
 * The core plugin autoloader - used to autoload classes that are instantiated
 */
require_once GHROOT . "autoloader.php";

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-gidi-hotels-activator.php
 */
function activate_gidi_hotels() {
	Gidi_hotels_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-gidi-hotels-deactivator.php
 */
function deactivate_gidi_hotels() {
	Gidi_hotels_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_gidi_hotels' );
register_deactivation_hook( __FILE__, 'deactivate_gidi_hotels' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_gidi_hotels() {

	$plugin = new gidi_hotels();
	$plugin->run();

}
run_gidi_hotels();
