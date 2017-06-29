<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/peterson-umoke/
 * @since      1.0.0
 *
 * @package    Gidi_hotels
 * @subpackage Gidi_hotels/admin
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Gidi_hotels
 * @subpackage Gidi_hotels/admin
 * @author     Peterson Nwachukwu Umoke <umoke10@hotmail.com>
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) { 
    exit; // Exit if accessed directly
}

class Gidi_hotels_admin_menu {
	
	/**
	 * Plugin name
	 */
	protected $plugin_name;

	/**
	 * Language ID
	 */
	protected $locale;

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function __construct($plugin_name , $locale ) {
		$this->language = $locale;
		$this->plugin_name = $plugin_name;
	}

	/**
     * Set active menu for taxonomy color
     *
     * @hook parent_file
     * @access public
     * @return string
     */
    public function menu( $parent_file ) {
        global $current_screen;
        $taxonomy = $current_screen->taxonomy;

        if ( 'gidi_hotel_locations' == $taxonomy || 'gidi_hotel_services' == $taxonomy || 'gidi_room_tags' == $taxonomy || 'gidi_room_categories' == $taxonomy || "gidi_hotel_facilities" == $taxonomy) {
            return 'listing-manager';
        }

        return $parent_file;
    }

    public function submenu_listings() {
        add_submenu_page( 'listing-manager', esc_attr__( 'Room Types', $this->language ), esc_attr__( 'Room Types', $this->language ), 'edit_posts', 'edit-tags.php?taxonomy=gidi_room_categories', false );
        add_submenu_page( 'listing-manager', esc_attr__( 'Room Tags', $this->language ), esc_attr__( 'Room Tags', $this->language ), 'edit_posts', 'edit-tags.php?taxonomy=gidi_room_tags', false );
        add_submenu_page( 'listing-manager', esc_attr__( 'Hotel Services', $this->language ), esc_attr__( 'Hotel Services', $this->language ), 'edit_posts', 'edit-tags.php?taxonomy=gidi_hotel_services', false );
        add_submenu_page( 'listing-manager', esc_attr__( 'Hotel Locations', $this->language ), esc_attr__( 'Hotel Locations', $this->language ), 'edit_posts', 'edit-tags.php?taxonomy=gidi_hotel_locations', false );
        add_submenu_page( 'listing-manager', esc_attr__( 'Hotel Facilities', $this->language ), esc_attr__( 'Hotel Facilities', $this->language ), 'edit_posts', 'edit-tags.php?taxonomy=gidi_hotel_facilities', false );
    }	

}
