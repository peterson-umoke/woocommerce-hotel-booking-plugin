<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/peterson-umoke/
 * @since      1.0.0
 *
 * @package    Gidi_hotels
 * @subpackage Gidi_hotels/admin
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
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

class Gidi_hotels_taxonomy {

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

	// Register Custom Taxonomy
	public function gidi_room_categories() {

		$labels = array(
			'name'                       => _x( 'Room Categories(Types)', 'Taxonomy General Name', $this->language ),
			'singular_name'              => _x( 'Room Category', 'Taxonomy Singular Name', $this->language ),
			'menu_name'                  => __( 'Room Categories(Types)', $this->language ),
			'all_items'                  => __( 'All Room Categories', $this->language ),
			'parent_item'                => __( 'Parent Item', $this->language ),
			'parent_item_colon'          => __( 'Parent Item:', $this->language ),
			'new_item_name'              => __( 'New Item Name', $this->language ),
			'add_new_item'               => __( 'Add New Room Category', $this->language ),
			'edit_item'                  => __( 'Edit Room Category', $this->language ),
			'update_item'                => __( 'Update Room Category', $this->language ),
			'view_item'                  => __( 'View Room Category', $this->language ),
			'separate_items_with_commas' => __( 'Separate items with commas', $this->language ),
			'add_or_remove_items'        => __( 'Add or remove items', $this->language ),
			'choose_from_most_used'      => __( 'Choose from the most used', $this->language ),
			'popular_items'              => __( 'Popular Items', $this->language ),
			'search_items'               => __( 'Search Items', $this->language ),
			'not_found'                  => __( 'Not Found', $this->language ),
			'no_terms'                   => __( 'No items', $this->language ),
			'items_list'                 => __( 'Items list', $this->language ),
			'items_list_navigation'      => __( 'Items list navigation', $this->language ),
		);
		$rewrite = array(
			'slug'                       => 'hotel_room_categories',
			'with_front'                 => true,
			'hierarchical'               => true,
		);
		$args = array(
			'labels'                     => $labels,
			'rewrite'                    => $rewrite,
            "description"                => "This is use to register the kind of rooms that is available for quick categorization",
			'hierarchical'               => false,
			'show_admin_column'          => false,
            'show_in_menu'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'show_in_rest'               => true,
            'query_var'                  => true,
		);
		register_taxonomy( 'gidi_room_categories', array( "product" ), $args );

	}

	// Register Custom Taxonomy
	public function gidi_room_tags() {

		$labels = array(
			'name'                       => _x( 'Room Tags', 'Taxonomy General Name', $this->language ),
			'singular_name'              => _x( 'Room Tag', 'Taxonomy Singular Name', $this->language ),
			'menu_name'                  => __( 'Room Tags', $this->language ),
			'all_items'                  => __( 'All Room Tags', $this->language ),
			'parent_item'                => __( 'Parent Item', $this->language ),
			'parent_item_colon'          => __( 'Parent Item:', $this->language ),
			'new_item_name'              => __( 'New Item Name', $this->language ),
			'add_new_item'               => __( 'Add New Room Tag', $this->language ),
			'edit_item'                  => __( 'Edit Room Tag', $this->language ),
			'update_item'                => __( 'Update Room Tag', $this->language ),
			'view_item'                  => __( 'View Room Tag', $this->language ),
			'separate_items_with_commas' => __( 'Separate items with commas', $this->language ),
			'add_or_remove_items'        => __( 'Add or remove items', $this->language ),
			'choose_from_most_used'      => __( 'Choose from the most used', $this->language ),
			'popular_items'              => __( 'Popular Items', $this->language ),
			'search_items'               => __( 'Search Items', $this->language ),
			'not_found'                  => __( 'Not Found', $this->language ),
			'no_terms'                   => __( 'No items', $this->language ),
			'items_list'                 => __( 'Items list', $this->language ),
			'items_list_navigation'      => __( 'Items list navigation', $this->language ),
		);
		$rewrite = array(
			'slug'                       => 'hotel_room_tags',
			'with_front'                 => true,
			'hierarchical'               => true,
		);
		$args = array(
			'labels'                     => $labels,
			'rewrite'                    => $rewrite,
            "description"                => "This is use to add tags for kind of rooms mainly for SEO",
			'hierarchical'               => false,
			'show_admin_column'          => false,
            'show_in_menu'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'show_in_rest'               => true,
            'query_var'                  => true,
		);
		register_taxonomy( 'gidi_room_tags', array( "product" ), $args );

	}

    /**
     * @todo Enables this when it is due, for now it is not due
     */
	public function gidi_room_equipments_tax() {
        $labels = array(
            'name'                       => _x( 'Room Amenities', 'Taxonomy General Name', $this->language ),
            'singular_name'              => _x( 'Room Amenities', 'Taxonomy Singular Name', $this->language ),
            'menu_name'                  => __( 'Room Amenities', $this->language ),
            'all_items'                  => __( 'All Room Amenities', $this->language ),
            'parent_item'                => __( 'Parent Item', $this->language ),
            'parent_item_colon'          => __( 'Parent Item:', $this->language ),
            'new_item_name'              => __( 'New Room Amenity', $this->language ),
            'add_new_item'               => __( 'Add New Amenity', $this->language ),
            'edit_item'                  => __( 'Edit Amenity', $this->language ),
            'update_item'                => __( 'Update Amenity', $this->language ),
            'view_item'                  => __( 'View Amenity', $this->language ),
            'separate_items_with_commas' => __( 'Separate Amenities with commas', $this->language ),
            'add_or_remove_items'        => __( 'Add or remove Amenities', $this->language ),
            'choose_from_most_used'      => __( 'Choose from the most used', $this->language ),
            'popular_items'              => __( 'Popular Amenities', $this->language ),
            'search_items'               => __( 'Search Amenities', $this->language ),
            'not_found'                  => __( 'Amenities Not Found', $this->language ),
            'no_terms'                   => __( 'No Amenities', $this->language ),
            'items_list'                 => __( 'Amenities list', $this->language ),
            'items_list_navigation'      => __( 'Amenities list navigation', $this->language ),
        );
        $rewrite = array(
            'slug'                       => 'hotel_room_equipments',
            'with_front'                 => true,
            'hierarchical'               => true,
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => false,
            'show_in_nav_menus'          => false,
            'show_tagcloud'              => false,
            'rewrite'                    => $rewrite,
            'show_in_rest'               => true,
            "query_var"
        );
        register_taxonomy( 'gidi_hotel_room_equipments',  array( "product" ), $args );
    }

	public function gidi_hotel_services() {
        $labels = array(
            'name'                       => _x( 'Hotel Services', 'Taxonomy General Name', $this->language ),
            'singular_name'              => _x( 'Hotel Services', 'Taxonomy Singular Name', $this->language ),
            'menu_name'                  => __( 'Hotel Services', $this->language ),
            'all_items'                  => __( 'All Hotel Services', $this->language ),
            'parent_item'                => __( 'Parent Item', $this->language ),
            'parent_item_colon'          => __( 'Parent Item:', $this->language ),
            'new_item_name'              => __( 'New Hotel Service', $this->language ),
            'add_new_item'               => __( 'Add New Service', $this->language ),
            'edit_item'                  => __( 'Edit Service', $this->language ),
            'update_item'                => __( 'Update Service', $this->language ),
            'view_item'                  => __( 'View Service', $this->language ),
            'separate_items_with_commas' => __( 'Separate Services with commas', $this->language ),
            'add_or_remove_items'        => __( 'Add or remove Services', $this->language ),
            'choose_from_most_used'      => __( 'Choose from the most used', $this->language ),
            'popular_items'              => __( 'Popular Services', $this->language ),
            'search_items'               => __( 'Search Services', $this->language ),
            'not_found'                  => __( 'Services Not Found', $this->language ),
            'no_terms'                   => __( 'No Services', $this->language ),
            'items_list'                 => __( 'Services list', $this->language ),
            'items_list_navigation'      => __( 'Services list navigation', $this->language ),
        );
        $rewrite = array(
            'slug'                       => 'gidi_hotel_services',
            'with_front'                 => true,
            'hierarchical'               => true,
        );
        $args = array(
            'labels'                     => $labels,
			'rewrite'                    => $rewrite,
            "description"                => "This is use to register the kind of rooms that is available for quick categorization",
			'hierarchical'               => true,
			'show_admin_column'          => false,
            'show_in_menu'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'show_in_rest'               => true,
            "query_var"                 => true,
        );
        register_taxonomy( 'gidi_hotel_services',  array( "gidi_hotel_listings"), $args );
    }

    public function gidi_hotel_facilities() {
        $labels = array(
            'name'                       => _x( 'Hotel Facilites', 'Taxonomy General Name', $this->language ),
            'singular_name'              => _x( 'Hotel Facilites', 'Taxonomy Singular Name', $this->language ),
            'menu_name'                  => __( 'Hotel Facilites', $this->language ),
            'all_items'                  => __( 'All Hotel Facilites', $this->language ),
            'parent_item'                => __( 'Parent Item', $this->language ),
            'parent_item_colon'          => __( 'Parent Item:', $this->language ),
            'new_item_name'              => __( 'New Hotel Facility', $this->language ),
            'add_new_item'               => __( 'Add New Facility', $this->language ),
            'edit_item'                  => __( 'Edit Facility', $this->language ),
            'update_item'                => __( 'Update Facility', $this->language ),
            'view_item'                  => __( 'View Facility', $this->language ),
            'separate_items_with_commas' => __( 'Separate Facilites with commas', $this->language ),
            'add_or_remove_items'        => __( 'Add or remove Facilites', $this->language ),
            'choose_from_most_used'      => __( 'Choose from the most used', $this->language ),
            'popular_items'              => __( 'Popular Facilites', $this->language ),
            'search_items'               => __( 'Search Facilites', $this->language ),
            'not_found'                  => __( 'Facilites Not Found', $this->language ),
            'no_terms'                   => __( 'No Facilites', $this->language ),
            'items_list'                 => __( 'Facilites list', $this->language ),
            'items_list_navigation'      => __( 'Facilites list navigation', $this->language ),
        );
        $rewrite = array(
            'slug'                       => 'gidi_hotel_facilities',
            'with_front'                 => true,
            'hierarchical'               => true,
        );
        $args = array(
            'labels'                     => $labels,
			'rewrite'                    => $rewrite,
            "description"                => "This is use to register the kind of rooms that is available for quick categorization",
			'hierarchical'               => true,
			'show_admin_column'          => false,
            'show_in_menu'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'show_in_rest'               => true,
            "query_var"                 => true,
        );
        register_taxonomy( 'gidi_hotel_facilities',  array( "gidi_hotel_listings"), $args );
    }

	public function gidi_hotel_locations() {
        $labels = array(
            'name'                       => _x( 'Hotel Locations', 'Taxonomy General Name', $this->language ),
            'singular_name'              => _x( 'Hotel Locations', 'Taxonomy Singular Name', $this->language ),
            'menu_name'                  => __( 'Hotel Locations', $this->language ),
            'all_items'                  => __( 'All Hotel Locations', $this->language ),
            'parent_item'                => __( 'Parent Item', $this->language ),
            'parent_item_colon'          => __( 'Parent Item:', $this->language ),
            'new_item_name'              => __( 'New Hotel Location', $this->language ),
            'add_new_item'               => __( 'Add New Location', $this->language ),
            'edit_item'                  => __( 'Edit Location', $this->language ),
            'update_item'                => __( 'Update Location', $this->language ),
            'view_item'                  => __( 'View Location', $this->language ),
            'separate_items_with_commas' => __( 'Separate Locations with commas', $this->language ),
            'add_or_remove_items'        => __( 'Add or remove Locations', $this->language ),
            'choose_from_most_used'      => __( 'Choose from the most used', $this->language ),
            'popular_items'              => __( 'Popular Locations', $this->language ),
            'search_items'               => __( 'Search Locations', $this->language ),
            'not_found'                  => __( 'Locations Not Found', $this->language ),
            'no_terms'                   => __( 'No Locations', $this->language ),
            'items_list'                 => __( 'Locations list', $this->language ),
            'items_list_navigation'      => __( 'Locations list navigation', $this->language ),
        );
        $rewrite = array(
            'slug'                       => 'gidi_hotel_locations',
            'with_front'                 => true,
            'hierarchical'               => true,
        );
        $args = array(
            'labels'                     => $labels,
			'rewrite'                    => $rewrite,
            "description"                => "Register the Locations Of the Hotels",
			'hierarchical'               => true,
			'show_admin_column'          => false,
            'show_in_menu'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'show_in_rest'               => true,
            "query_var"                 => true,
        );
        register_taxonomy( 'gidi_hotel_locations',  array( "gidi_hotel_listings"), $args );
    }
	
}
