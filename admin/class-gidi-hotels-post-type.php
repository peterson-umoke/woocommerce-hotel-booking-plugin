<?php

/**
 * Registers a Hotel Listings Post Type
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
 * This class registers a Hotel Listings Post Type
 *
 * @since      1.0.5
 * @package    Gidi_hotels
 * @subpackage Gidi_hotels/admin
 * @author     Peterson Nwachukwu Umoke <umoke10@hotmail.com>
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) { 
    exit; // Exit if accessed directly
}

class Gidi_hotels_post_type {

	/**
	 * The Page that holds the search and listings function
	 *
	 * @var string
	 * @access protected
	 */
    protected $single_page_name = "";

	/**
	 * Post Type Supports - What does the post type support
	 *
	 * @var array
	 */
	protected $post_type_supports = array();

	/**
	 * Supported Taxonomies - State what kind of related taxonomy is tied to this post type
	 *
	 * @var array
	 */
	protected $supported_taxonomies = array();

	/**
	 * Post Type ID - The Post type id that is unique to this post type
	 *
	 * @var string
	 */
	protected $post_type_id = "";

	/**
	 * Plugin name
	 */
	protected $plugin_name;

	/**
	 * Language ID
	 */
	protected $locale;

    public function __construct( $plugin_name , $locale , $page_name = "hotel-listings-page/view-single") {
		
        $this->single_page_name = $page_name;

		$this->post_type_supports_now = array(
			"title",
			"thumbnail",
			"custom_fields",
			"editor",
			"comments",
			"revisions",
			"page-attributes",
		);

		$this->supported_taxonomies = array( 
			"gidi_hotel_services",
			"gidi_hotel_locations",
			"gidi_hotel_facilities",
		);

		$this->post_type_id = str_replace("-","_",$plugin_name);
    }

    /**
     * This is used to register a custom post type called hotel_listings
	 * 
	 * @author Peterson Nwachukwu Umoke <umoke10@hotmail.com>
	 * @access public
     */
    public function register_hotel_listings() {
        $labels = array(
			'name'                  => _x( 'Hotel Listings', 'Post Type General Name', 'wc-hotel-and-rooms' ),
			'singular_name'         => _x( 'Hotel Listing', 'Post Type Singular Name', 'wc-hotel-and-rooms' ),
			'menu_name'             => __( 'Hotel Listings', 'wc-hotel-and-rooms' ),
			'name_admin_bar'        => __( 'Hotel Listings', 'wc-hotel-and-rooms' ),
			'archives'              => __( 'Hotel Listings Archives', 'wc-hotel-and-rooms' ),
			'attributes'            => __( 'Hotel Listings Attributes', 'wc-hotel-and-rooms' ),
			'parent_item_colon'     => __( 'Hotel Listings Item:', 'wc-hotel-and-rooms' ),
			'all_items'             => __( 'All Listings', 'wc-hotel-and-rooms' ),
			'add_new_item'          => __( 'Add New Listing Item', 'wc-hotel-and-rooms' ),
			'add_new'               => __( 'Add New Listing', 'wc-hotel-and-rooms' ),
			'new_item'              => __( 'New Listings', 'wc-hotel-and-rooms' ),
			'edit_item'             => __( 'Edit Listings', 'wc-hotel-and-rooms' ),
			'update_item'           => __( 'Update Hotel Listings', 'wc-hotel-and-rooms' ),
			'view_item'             => __( 'View Hotel Listing', 'wc-hotel-and-rooms' ),
			'view_items'            => __( 'View Hotel Listings', 'wc-hotel-and-rooms' ),
			'search_items'          => __( 'Search Hotel Listings', 'wc-hotel-and-rooms' ),
			'not_found'             => __( 'No Hotel Listings found', 'wc-hotel-and-rooms' ),
			'not_found_in_trash'    => __( 'No Hotel Listings found in Trash', 'wc-hotel-and-rooms' ),
			'featured_image'        => __( 'Hotel Listings Featured Image', 'wc-hotel-and-rooms' ),
			'set_featured_image'    => __( 'Set featured image', 'wc-hotel-and-rooms' ),
			'remove_featured_image' => __( 'Remove featured image', 'wc-hotel-and-rooms' ),
			'use_featured_image'    => __( 'Use as Hotel Listings featured image', 'wc-hotel-and-rooms' ),
			'insert_into_item'      => __( 'Insert into Hotel Listings item', 'wc-hotel-and-rooms' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Hotel Listings item', 'wc-hotel-and-rooms' ),
			'items_list'            => __( 'Hotel Listings Items list', 'wc-hotel-and-rooms' ),
			'items_list_navigation' => __( 'Hotel Listings Items list navigation', 'wc-hotel-and-rooms' ),
			'filter_items_list'     => __( 'Filter Hotel Listings items list', 'wc-hotel-and-rooms' ),
		);
		$rewrite = array(
			"slug"					=> $this->single_page_name,
			'with_front'            => true,
			'pages'                 => true,
			'feeds'                 => true,
		);
		$args = array(
			'label'                 => __( 'Hotel Listing', 'wc-hotel-and-rooms' ),
			'description'           => __( 'This Post Type is used to list hotels which will later be tied to the woocommerce room listing product type', 'wc-hotel-and-rooms' ),
			'labels'                => $labels,
			'supports'              => $this->post_type_supports_now,
			'taxonomies'            => $this->supported_taxonomies,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => '',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,	
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'rewrite'               => $rewrite,
			'capability_type'       => 'page',
			'show_in_rest'          => true,
			"query_var"				=> true,
		);
		register_post_type( $this->post_type_id, $args );
    }
}