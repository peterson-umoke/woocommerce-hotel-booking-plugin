<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/peterson-umoke/
 * @since      1.0.0
 *
 * @package    Gidi_hotels
 * @subpackage Gidi_hotels/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Gidi_hotels
 * @subpackage Gidi_hotels/includes
 * @author     Peterson Nwachukwu Umoke <umoke10@hotmail.com>
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) { 
    exit; // Exit if accessed directly
}

class Gidi_hotels {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Gidi_hotels_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'gidi-hotels';
		$this->version = '6.1.3';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Gidi_hotels_Loader. Orchestrates the hooks of the plugin.
	 * - Gidi_hotels_i18n. Defines internationalization functionality.
	 * - Gidi_hotels_Admin. Defines all hooks for the admin area.
	 * - Gidi_hotels_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		$this->loader = new Gidi_hotels_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Gidi_hotels_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Gidi_hotels_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		/**
		 * Make the gidi_hotels_templates var global
		 */
		global $gidi_hotels_templates;
		$gidi_hotels_templates = new Gidi_hotels_template_loader();

		$template_loader = new Gidi_hotels_page_templates_loader();
		$this->loader->add_action( 'plugins_loaded', $template_loader, 'get_instance' );

		$post_type_loader = new Gidi_hotels_post_type_loader();
		$this->loader->add_filter( 'template_include', $post_type_loader, 'templates' );

		/**
		 * Add stylesheets and enqueue scripts to the wordpress admin dashboard
		 */
		$plugin_admin = new Gidi_hotels_Admin( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		/**
         * Add custom menu to listing-manager
         *
         * @return void
         */
		$taxonomy_menu = new Gidi_hotels_admin_menu( $this->get_plugin_name(), $this->set_locale() );
		$this->loader->add_action( 'parent_file', $taxonomy_menu , 'menu' );
        $this->loader->add_action( 'admin_menu', $taxonomy_menu , 'submenu_listings' );

		/**
         * Add custom taxonomy type
         *
         * @return void
         */
		$taxonomy = new Gidi_hotels_taxonomy( $this->get_plugin_name(), $this->set_locale() );
		$this->loader->add_action( 'init', $taxonomy, 'gidi_room_categories' );
		$this->loader->add_action( 'init', $taxonomy, 'gidi_room_tags' );
		$this->loader->add_action( 'init', $taxonomy, 'gidi_hotel_services' );
		$this->loader->add_action( 'init', $taxonomy, 'gidi_hotel_locations' );
		$this->loader->add_action( 'init', $taxonomy, 'gidi_hotel_facilities' );

		/**
         * Add custom post type
         *
         * @return void
         */
		$post_type_hotel = new Gidi_hotels_post_type( $this->get_plugin_name(), $this->set_locale() );
		$this->loader->add_action("init", $post_type_hotel, "register_hotel_listings" );

		/**
         * Add custom fields to the facilites custom taxonomy
         */
		$add_font_icon_to_facilities = new Gidi_hotels_facilities_font_icon( $this->get_plugin_name() , $this->set_locale() );
        $this->loader->add_filter( 'manage_edit-gidi_hotel_facilities_columns', $add_font_icon_to_facilities, 'facilities_custom_column');
        $this->loader->add_filter( 'manage_gidi_hotel_facilities_custom_column', $add_font_icon_to_facilities, 'facilities_add_field_column_contents');
        $this->loader->add_action( 'gidi_hotel_facilities_add_form_fields', $add_font_icon_to_facilities, 'facilities_add_custom_font' );
        $this->loader->add_action( 'gidi_hotel_facilities_edit_form_fields', $add_font_icon_to_facilities, 'facilities_edit_custom_font' );
        $this->loader->add_action( 'created_gidi_hotel_facilities', $add_font_icon_to_facilities, 'facilities_update_custom_font' );
        $this->loader->add_action( 'edited_gidi_hotel_facilities', $add_font_icon_to_facilities, 'facilities_update_custom_font' );

         /**
         * Add custom image to the hotel_location custom taxonomy
         */
		$add_image_upload_to_locations = new Gidi_hotels_location_images( $this->get_plugin_name() , $this->set_locale() );
        $this->loader->add_filter( 'manage_edit-gidi_hotel_locations_columns', $add_image_upload_to_locations, 'location_custom_columnn');
        $this->loader->add_filter( 'manage_gidi_hotel_locations_custom_column', $add_image_upload_to_locations, 'location_add_field_column_contents');
        $this->loader->add_action( 'gidi_hotel_locations_add_form_fields', $add_image_upload_to_locations, 'location_add_custom_image' );
        $this->loader->add_action( 'gidi_hotel_locations_edit_form_fields', $add_image_upload_to_locations, 'location_edit_custom_image' );
        $this->loader->add_action( 'created_gidi_hotel_locations', $add_image_upload_to_locations, 'location_update_custom_image' );
        $this->loader->add_action( 'edited_gidi_hotel_locations', $add_image_upload_to_locations, 'location_update_custom_image' );
        $this->loader->add_action("admin_footer", $add_image_upload_to_locations,"location_upload_js" );

		/**
		 * Add custom metaboxes to the hotel post type
		 */
		$hotel_metaboxes = new Gidi_hotels_meta_boxes( $this->get_plugin_name(), $this->set_locale() );
		$this->loader->add_action( 'cmb2_init', $hotel_metaboxes, 'price_metabox' );
		$this->loader->add_action( 'cmb2_init', $hotel_metaboxes, 'gallery_metabox' );
		$this->loader->add_action( 'cmb2_init', $hotel_metaboxes, 'contact_metabox' );
		$this->loader->add_action( 'cmb2_init', $hotel_metaboxes, 'rooms_metabox' );
		$this->loader->add_action( 'cmb2_init', $hotel_metaboxes, 'policies_metabox' );
		$this->loader->add_action( 'cmb2_init', $hotel_metaboxes, 'ratings_metabox' );
		$this->loader->add_action( 'cmb2_init', $hotel_metaboxes, 'more_information_metabox' );
		$this->loader->add_action( 'cmb2_init', $hotel_metaboxes, 'specials_metabox' );
		$this->loader->add_action( 'cmb2_init', $hotel_metaboxes, 'location_metabox' );

		/**
		 * cmb2 location - Add my own custom boxxes to the cmb2 plugin
		 */
		$add_location_to_cmb2 = new Gidi_hotels_cmb_location_metabox();
		$this->loader->add_filter( 'cmb2_render_gidi_hotels_location_metabox', $add_location_to_cmb2, 'render_gidi_hotels_location_metabox', 10, 5 );
		$this->loader->add_filter( 'cmb2_sanitize_gidi_hotels_location_metabox', $add_location_to_cmb2, 'sanitize_gidi_hotels_location_metabox' , 10, 4 );

		/**
		 * Add the use of table layout to the cmb2 plugin
		 */
		$add_table_layout = new Gidi_hotels_cmb_table_layout();
		$this->loader->add_filter( 'cmb2_render_gidi_hotels_table_layout', $add_table_layout, 'add_table_field', 10, 5 );
		$this->loader->add_filter( 'cmb2_sanitize_gidi_hotels_table_layout', $add_table_layout, 'save_table_field' , 10, 4 );

		/**
		 * Add the use of rooms to cmb2
		 */
		$get_rooms_cmb = new Gidi_hotels_cmb_get_rooms();
		$this->loader->add_filter( 'cmb2_render_gidi_hotels_related_rooms', $get_rooms_cmb, 'add_table_field', 10, 5 );
		$this->loader->add_filter( 'cmb2_sanitize_gidi_hotels_related_rooms', $get_rooms_cmb, 'save_table_field' , 10, 4 );

		/**
		 * Add the use of shortcodes to this plugin
		 *
		 * @return void
		 */
		$shortcode_wrapper = new Gidi_hotels_shortcodes();
		add_shortcode("gh_load_template", array( $shortcode_wrapper, "template_loader") );
		add_shortcode("gh_count_hotels", array( $shortcode_wrapper, "count_hotels") );
		add_shortcode("gh_page_title_open", array( $shortcode_wrapper, "page_title_open") );
		add_shortcode("gh_page_title_close", array( $shortcode_wrapper, "page_title_close") );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Gidi_hotels_Public( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Gidi_hotels_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
