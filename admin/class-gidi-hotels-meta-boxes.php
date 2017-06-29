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

class Gidi_hotels_meta_boxes {

	/**
	 * Hotel Metabox ID
	 *
	 * This is the id that the hotel metabox will use as general identifiers
	 * 
	 * @var array
	 */
	protected $prefix;

	/**
	 * Post type ID
	 *
	 * @var mixed|string|array
	 */
	private $attached_post_type;

	/**
	 * Plugin Locale
	 *
	 * @var string|mixed
	 */
	protected $locale;

	public function __construct( $plugin_name, $locale ) {
		$this->prefix = "_" . str_replace( "-", "_", $plugin_name ) . "_";
		$this->locale = $locale;
		$this->attached_post_type = array("gidi_hotels");
	}

	/**
	 * Price - General Price and Sale Price
	 *
	 * Here the user can input both sale and general price, this will be used if its not empty
	 *
	 * @since    1.0.0
	 */
	public function price_metabox() {
		$cmb = new_cmb2_box( array(
			'id'            => $this->prefix . 'pricebox',
			'title'         => esc_html__( 'Price', $this->locale ),
			'object_types'  => $this->attached_post_type, // Post type
			'priority'   => 'high',
			'context'    => 'side',
			'show_names' => false, // Show field names on the left
			'classes'    => 'gidi-hotel-pricebox', // Extra cmb2-wrap classes
			'show_in_rest' => WP_REST_Server::ALLMETHODS // allows this metabox to be visible in the rest api
		) );

		$cmb->add_field( array(
			'name' => esc_html__( 'Guess Prices', 'cmb2' ),
			'desc' => esc_html__( 'Allow the hotel engine to guess the highest and lowest price of the rooms in this hotel', 'cmb2' ),
			'id'   => $prefix . 'guess_room_checkbox',
			'type' => 'checkbox',
		) );

		$cmb->add_field( array(
			'column'          => true, // Display field value in the admin columns
			'id'   => $this->prefix . 'general_price_meta',
			'name' => 'General Price',
			'type' => 'text_money',
			'before_field' => get_woocommerce_currency_symbol(), // Replaces default '$'
			"desc"	=> "What is the least price for a room ?",
		) );

		$cmb->add_field( array(
			"column"	=> true, // Display field value in the admin columns
			'id'   => $this->prefix . 'sale_price_meta',
			'name' => 'Sale Price',
			'type' => 'text_money',
			'before_field' => get_woocommerce_currency_symbol(), // Replaces default '$'
			"desc"	=> "What is the highest price for a room ?",
		) );
		
	}

	/**
	 * Media - Hotel Pictures Gallery
	 *
	 * Here the user can select any amount pictures he/she wants with this module
	 *
	 * @since    1.0.0
	 */
	public function gallery_metabox() {
		$cmb = new_cmb2_box( array(
			'id'            => $this->prefix . 'gallerybox',
			'title'         => esc_html__( 'Hotel Gallery', $this->locale ),
			'object_types'  => $this->attached_post_type, // Post type
			'priority'   => 'high',
			'context'    => 'advanced',
			'show_names' => true, // Show field names on the left
			'classes'    => 'gidi-hotel-gallerybox', // Extra cmb2-wrap classes
			'show_in_rest' => WP_REST_Server::ALLMETHODS // allows this metabox to be visible in the rest api
		) );

		$cmb->add_field( array(
			'name'         => esc_html__( 'Hotel Gallery', $this->locale ),
			'desc'         => esc_html__( 'Add more pictures of this hotel', $this->locale ),
			'id'           => $this->prefix . 'gallery_meta',
			'type'         => 'file_list',
			'preview_size' => array( 50, 50 ), // Default: array( 50, 50 )
		) );
	}

	/**
	 * Contact Details - Email, Phone Number, address location
	 *
	 * Here the user can input both sale and general price, this will be used if its not empty
	 *
	 * @since    1.0.0
	 */
	public function contact_metabox() {
		$cmb = new_cmb2_box( array(
			'id'            => 'contactbox',
			'title'         => esc_html__( 'Contact Details', $this->locale ),
			'object_types'  => $this->attached_post_type, // Post type
			'priority'   => 'low',
			'context'    => 'advanced',
			'show_names' => true, // Show field names on the left
			'classes'    => 'gidi-hotel-contactbox', // Extra cmb2-wrap classes
			'show_in_rest' => WP_REST_Server::ALLMETHODS // allows this metabox to be visible in the rest api
		) );

		$cmb->add_field( array(
			'name'       => esc_html__( 'Email', 'cmb2' ),
			'desc'       => esc_html__( 'Enter the hotel email address', 'cmb2' ),
			'id'         => $this->prefix . 'email_address_meta',
			'type'       => 'text_email',
			'column'          => true, // Display field value in the admin post-listing columns
		) );

		$cmb->add_field( array(
			'name'       => esc_html__( 'Contact Number', 'cmb2' ),
			'desc'       => esc_html__( 'Enter the hotel frontdesk contact number(you are allowed to add more than one)', 'cmb2' ),
			'id'         => $this->prefix . 'contact_number_meta',
			'type'       => 'text',
			'column'          => true, // Display field value in the admin post-listing columns
			'repeatable' => true,
		) );

		$cmb->add_field( array(
			'name' => esc_html__( 'Website URL', 'cmb2' ),
			'desc' => esc_html__( 'Enter the hotel website', 'cmb2' ),
			'id'   => $this->prefix . 'website_meta',
			'type' => 'text_url',
			'protocols' => array('http', 'https'), // Array of allowed protocols
		) );

		$cmb->add_field( array(
			'name' => esc_html__( 'Address', 'cmb2' ),
			'desc' => esc_html__( 'Enter the hotel address', 'cmb2' ),
			'id'   => $this->prefix . 'address',
			'type' => 'text',
		) );
	}

	/**
	 * Rooms Metabox
	 *
	 * show the list of rooms and the ones that have been booked or available
	 * non-editable
	 *
	 * @since    1.0.0
	 */
	public function rooms_metabox() {
		$cmb = new_cmb2_box( array(
			'id'            => $this->prefix . 'rooms_box',
			'title'         => esc_html__( 'Related Rooms', $this->locale ),
			'object_types'  => $this->attached_post_type, // Post type
			'priority'   => 'low',
			'context'    => 'advanced',
			'show_names' => false, // Show field names on the left
			'classes'    => 'gidi-hotel-rooms-box', // Extra cmb2-wrap classes
			'show_in_rest' => WP_REST_Server::ALLMETHODS // allows this metabox to be visible in the rest api
		) );

		$cmb->add_field( array(
			'id'   => $this->prefix . 'rooms_meta',
			'name' => 'Related Rooms',
			'type' => 'gidi_hotels_related_rooms',
			"desc"	=> "You dont have to do anything, all rooms linked to this hotel will show up from time to time",
		) );
	}
	
	/**
	 * Policies Metabox
	 *
	 * Allow the owner of the hotel to enter policies, terms and conditions
	 * @editable
	 *
	 * @since    1.0.0
	 */
	public function policies_metabox() {
		$cmb = new_cmb2_box( array(
			'id'            => $this->prefix . 'policies_box',
			'title'         => esc_html__( 'Policies', $this->locale ),
			'object_types'  => $this->attached_post_type, // Post type
			'priority'   => 'low',
			'context'    => 'advanced',
			'show_names' => true, // Show field names on the left
			'classes'    => 'gidi-hotel-policies-box', // Extra cmb2-wrap classes
			'show_in_rest' => WP_REST_Server::ALLMETHODS // allows this metabox to be visible in the rest api
		) );

		$cmb->add_field( array(
			'name'    => esc_html__( 'Hotel Policies', 'cmb2' ),
			'desc'    => esc_html__( 'Enter the policies of this hotel', 'cmb2' ),
			'id'      => $this->prefix . 'policies',
			'type'    => 'wysiwyg',
			'options' => array( 'textarea_rows' => 3, ),
		) );
	}

	/**
	 * Ratings Metabox
	 *
	 * Allow the owner of the hotel to enter its star rating
	 * @editable
	 *
	 * @since    1.0.0
	 */
	public function ratings_metabox() {
		$cmb = new_cmb2_box( array(
			'id'            => 'star_ratingsbox',
			'title'         => esc_html__( 'Ratings Details', $this->locale ),
			'object_types'  => $this->attached_post_type, // Post type
			'priority'   => 'low',
			'context'    => 'advanced',
			'show_names' => true, // Show field names on the left
			'classes'    => 'gidi-hotel-star-ratingsbox', // Extra cmb2-wrap classes
			'show_in_rest' => WP_REST_Server::ALLMETHODS // allows this metabox to be visible in the rest api
		) );

		$cmb->add_field( array(
			'name'       => esc_html__( 'Star Rating', 'cmb2' ),
			'desc'       => esc_html__( 'Enter the hotel star rating', 'cmb2' ),
			'id'         => $this->prefix . 'star_rating',
			'type'       => 'text',
			'column'          => true, // Display field value in the admin post-listing columns
		) );
	}

	/**
	 * Location Metabox
	 *
	 * Allow the owner of the hotel to enter their location
	 * @editable
	 *
	 * @since    1.0.0
	 */
	public function location_metabox() {
		$cmb = new_cmb2_box( array(
			'id'            => $this->prefix . 'location_metabox',
			'title'         => esc_html__( 'Location', $this->locale ),
			'object_types'  => $this->attached_post_type, // Post type
			'priority'   => 'high',
			'context'    => 'advanced',
			'show_names' => true, // Show field names on the left
			'classes'    => 'gidi-hotel-location', // Extra cmb2-wrap classes
			'show_in_rest' => WP_REST_Server::ALLMETHODS // allows this metabox to be visible in the rest api
		) );

		$cmb->add_field( array(
			'name'       => esc_html__( 'Hotel Location', 'cmb2' ),
			'desc'       => esc_html__( 'Enter the hotel\'s address', 'cmb2' ),
			'id'         => $this->prefix . 'gidi_hotels_main_location',
			'type'       => 'gidi_hotels_location_metabox',
			'column'          => true, // Display field value in the admin post-listing columns
		) );
	}

	/**
	 * More Information Metabox
	 *
	 * Allow the owner of the hotel to enter more information about thier hotel
	 * @editable
	 *
	 * @since    1.0.0
	 */
	public function more_information_metabox() {
		$cmb = new_cmb2_box( array(
			'id'            => $this->prefix . 'information_box',
			'title'         => esc_html__( 'Extra Info', $this->locale ),
			'object_types'  => $this->attached_post_type, // Post type
			'priority'   => 'low',
			'context'    => 'advanced',
			'show_names' => true, // Show field names on the left
			'classes'    => 'gidi-hotel-info-box', // Extra cmb2-wrap classes
			'show_in_rest' => WP_REST_Server::ALLMETHODS // allows this metabox to be visible in the rest api
		) );

		$cmb->add_field( array(
			'id'   => $this->prefix . 'informtaion_meta',
			'name' => 'Extra Information',
			'type' => 'gidi_hotels_table_layout',
			"desc"	=> "Extra information not covered can be added here!",
		) );
	}

	/**
	 * Specials Metabox
	 *
	 * Allow the owner of the hotel to just one special
	 * @editable
	 *
	 * @since    1.0.0
	 */
	public function specials_metabox() {
		$cmb = new_cmb2_box( array(
			'id'            => 'specialsbox',
			'title'         => esc_html__( 'Hotel Extra Meta', $this->locale ),
			'object_types'  => $this->attached_post_type, // Post type
			'priority'   => 'low',
			'context'    => 'side',
			'show_names' => true, // Show field names on the left
			'classes'    => 'gidi-hotel-specials', // Extra cmb2-wrap classes
			'show_in_rest' => WP_REST_Server::ALLMETHODS // allows this metabox to be visible in the rest api
		) );

		$cmb->add_field( array(
			'id'   => $this->prefix . 'specials_meta',
			'name' => 'Special Offer',
			'type' => 'text',
			"desc"	=> "Special Offer that makes this hotel different from the others ?",
		) );
	}

}
