<?php
// print_r($_POST);

/**
 * The plugin product type file
 *
 * This class file is contains the product type registration thingy
 *
 * @link              http://github.com/peterson-umoke
 * @since             4.1.0
 * @package           wc-gidi-hotels-and-rooms
 * @subpackage        wc-gidi-hotels-and-rooms/includes
 * @author            Peterson Nwachukwu Umoke <umoke10@hotmail.com>
 *
 * @wordpress-plugin
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * hotel_room_product_type 
 * 
 * load this custom product type in function so that it can be called for lazy inititalization
 * 
 * @called class Gidi_hotels_product_type
 * @class extended WC_Product
 *
 * @return void
 */

/**
 * This plugin basically depends on woocommerce to be active so if woocommerce is not active, send an error
 * 
 * * @since    1.0.0
 * @author Peterson Nwachukwu Umoke <umoke10@hotmail.com>
 */

if (!in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )) {
	$class = 'notice notice-error fade';
	$message = __( 'The Gidi Hotels plugin requires WooCommerce to be Installed. Please kindly install woocommerce now!.', 'gidi-hotels' );
	$url = "http://www.woocommerce.com";
	$link_text = "Download WooCommerce Now!";
	printf( '<div class="%1$s"><strong>%2$s</strong> <a href="%3$s">%4$s</a>"</div>', esc_attr( $class ), esc_html( $message ), esc_url($url),esc_html($link_text) );
} else {

	function gidi_rooms_product_type() {
		/**
		 * @todo Debug the reason the the script fails when i try to extend the original wc_product menu
		 * @problem_fixed make sure to wait for the whole plugins to be loaded before loading mine, afterall we are waiting for wordpress to let us know its time to come
		 * @todo make the loading of plugins better using oop - i cant seem to find a better find for this yet.
		 */
		class Gidi_hotels_product_type extends WC_Product {

			/**
			 * Short Description. (use period)
			 *
			 * Long Description.
			 *
			 * @since    1.0.0
			 */
			public function __construct( $product = "gidi_hotel_rooms" ) {
				parent::__construct( $product );
				
				$this->supports[]   = 'ajax_add_to_cart';
				$this->text_domain = "gidi-hotels";
				$this->product_type_id = "gidi_hotel_rooms";
				$this->product_type = $this->product_type_id;
				$this->product_type_name = "Hotel Room";

				/**
				 * @filtered product_type_selector
				 * @see WooCommerce product type selector
				 */
				add_filter( 'product_type_selector', array(  $this , 'add_product_type'), 90 ); // add the hotel_listings product type to the woocommerce dropdown
				
				/**
				 * @filtered woocommerce_product_data_tabs
				 * @see WooCommerce product data tabs
				 */
				add_filter( 'woocommerce_product_data_tabs',  array(  $this , 'product_type_tabs' ), 90 ); // hide the undesired things i dont want to show in the hotel_listings product type dropdown

				/**
				 * @hooked woocommerce_product_data_panels
				 */
				add_action( 'woocommerce_product_data_panels', array( $this , 'product_type_panels' ), 20 );

				/**
				 * @hooked woocommerce_process_product_meta_
				 */
				add_action( 'woocommerce_process_product_meta_'.$this->product_type_id, array( $this , 'product_save_fields' ), 20 );

				/**
				 * @hooked woocommerce_process_product_meta_variable_wc
				 */
				add_action( 'woocommerce_process_product_meta_variable_'.$this->product_type_id, array( $this , 'product_save_fields' ), 20 );
			}

			/**
			 * Save the fields as metas
			 *
			 * @return void
			 */
			public function product_save_fields( $post_id ) {
				global $post, $thepostid, $product_object, $text_domain;			

					if(isset($_POST['_gidi_hotel_room_size'])) {
						update_post_meta($post_id, "_gidi_hotel_room_size", sanitize_text_field( $_POST['_gidi_hotel_room_size'] ) );
					}

					if(isset($_POST['_gidi_hotel_number_of_rooms'])) {
						update_post_meta($post_id, "_gidi_hotel_number_of_rooms", sanitize_text_field( $_POST['_gidi_hotel_number_of_rooms'] ) );
					}

					if(isset($_POST['_gidi_hotel_room_capacity'])) {
						update_post_meta($post_id, "_gidi_hotel_room_capacity", sanitize_text_field( $_POST['_gidi_hotel_room_capacity'] ) );
					}

					if(isset($_POST['_gidi_hotel_number_of_children'])) {
						update_post_meta($post_id, "_gidi_hotel_number_of_children", sanitize_text_field( $_POST['_gidi_hotel_number_of_children'] ) );
					}

					if(isset($_POST['_gidi_hotel_minimum_nights'])) {
						update_post_meta($post_id, "_gidi_hotel_minimum_nights", sanitize_text_field( $_POST['_gidi_hotel_minimum_nights'] ) );
					}

					if(isset($_POST['_gidi_hotel_number_of_beds'])) {
						update_post_meta($post_id, "_gidi_hotel_number_of_beds", sanitize_text_field( $_POST['_gidi_hotel_number_of_beds'] ) );
					}

					if(isset($_POST['_gidi_hotel_select_hotel'])) {
						update_post_meta($post_id, "_gidi_hotel_select_hotel", sanitize_text_field( $_POST['_gidi_hotel_select_hotel'] ) );
					}

					$amenities_data = new Gidi_hotels_model();
					$amenities = $amenities_data->amenities();

					if(!empty($amenities)):
						foreach($amenities as $data => $value) :
							$woocommerce_checkbox = isset( $_POST["_gidi_hotel_room_".$data] ) ? 'yes' : 'no';
							update_post_meta( $post_id, "_gidi_hotel_room_".$data, $woocommerce_checkbox );
						endforeach;
					endif;

					if( ! empty( $_POST[ "_gidi_hotel_extra_amenities" ] ) ) {
						$room_extra_amenities = array_combine ( $_POST["_extra_amenities_names"] , $_POST['_extra_amenities_values'] );
						update_post_meta( $post_id, "_gidi_hotel_extra_amenities",  json_encode( $room_extra_amenities ) );
					}

					if( ! empty( $_POST[ "_gidi_hotel_extra_adult" ] ) ) {
						$room_extra_adult = array_combine ( $_POST["_gidi_hotel_extra_adult_qty"] , $_POST['_gidi_hotel_extra_adult_price'] );
						update_post_meta( $post_id, "_gidi_hotel_extra_adult",  json_encode( $room_extra_adult ) );
					}

					if( ! empty( $_POST[ "_gidi_hotel_extra_children" ] ) ) {
						$room_extra_adult = array_combine ( $_POST["_gidi_hotel_extra_children_qty"] , $_POST['_gidi_hotel_extra_children_price'] );
						update_post_meta( $post_id, "_gidi_hotel_extra_children",  json_encode( $room_extra_adult ) );
					}
			}

			/**
			 * Spit out the required html for this product type
			 *
			 * @return $product_type
			 */
			public function product_type_panels() {
				global $post, $thepostid, $product_object;
				
					/**
					 * @todo add the ability to add discounts and new seperate packages that are attached to each single rooms
					 */
					require_once GHROOT . "admin" . GHDS . "views" . GHDS . "product-type-panels" . GHDS . "html-product-data-gidi_hotel_selection.php";
					require_once GHROOT . "admin" . GHDS . "views" . GHDS . "product-type-panels" . GHDS . "html-product-data-gidi_room_management.php";
					require_once GHROOT . "admin" . GHDS . "views" . GHDS . "product-type-panels" . GHDS . "html-product-data-gidi_extra_price.php";
					require_once GHROOT . "admin" . GHDS . "views" . GHDS . "product-type-panels" . GHDS . "html-product-data-gidi_amenities.php";
					require_once GHROOT . "admin" . GHDS . "views" . GHDS . "product-type-panels" . GHDS . "html-product-data-gidi_extra_amenities.php";
			}

			public function add_product_type( $product_type ) {

				$product_type[$this->product_type_id] = __($this->product_type_name,$this->text_domain);

				return $product_type;
			}

			/**
			 * used to hide unwanted tabs and add new tabs for this product type to work efficiently well
			 *
			 * @return $tabs
			 */	
			public function product_type_tabs( $tabs ) {
				/**
				 * Hide unwanted tabs
				 */
				// $tabs['general']['class'][] = 'hide_if_' . $this->product_type_id . ' hide_if_variable_' . $this->product_type_id ; // hide the linked product tab
				// $tabs['linked_product']['class'][] = 'hide_if_' . $this->product_type_id . ' hide_if_variable_' . $this->product_type_id ; // hide the linked product tab
				// $tabs['inventory']['class'][] = 'hide_if_' . $this->product_type_id . ' hide_if_variable_' . $this->product_type_id ; // hide the linked product tab
				// $tabs['attribute']['class'][] = 'hide_if_' . $this->product_type_id . ' hide_if_variable_' . $this->product_type_id ; // hide the attributes tab
				// $tabs['advanced']['class'][] = 'hide_if_' . $this->product_type_id . ' hide_if_variable_' . $this->product_type_id ; // hide the linked product tab
				$tabs['variations']['class'][] = 'show_if_' . $this->product_type_id . ' show_if_variable_' . $this->product_type_id ; // hide the attributes tab
				$tabs['shipping']['class'][] = 'hide_if_' . $this->product_type_id . ' hide_if_variable_' . $this->product_type_id ; // hide the shipping tab

				/**
				 * Add new tabs specific for this class
				 */
				$tabs['gidi_hotel_selection'] = array(
					'label' => __("Select Hotel",$this->text_domain ),
					'target' => "gidi_hotel_selection_data",
					"class" => ['show_if_' . $this->product_type_id  ,' show_if_variable_' . $this->product_type_id ],
				);

				$tabs['gidi_room_management'] = array(
					'label' => __("Room Data",$this->text_domain ),
					'target' => "gidi_room_management_data",
					"class" => ['show_if_' . $this->product_type_id  ,' show_if_variable_' . $this->product_type_id ],
				);

				$tabs['gidi_extra_price'] = array(
					'label' => __("Extra Price",$this->text_domain ),
					'target' => "gidi_extra_price_data",
					"class" => ['show_if_' . $this->product_type_id  ,' show_if_variable_' . $this->product_type_id ],
				);

				$tabs['gidi_amenities'] = array(
					'label' => __("Amenities",$this->text_domain ),
					'target' => "gidi_amenities_data",
					"class" => ['show_if_' . $this->product_type_id  ,' show_if_variable_' . $this->product_type_id ],
				);

				$tabs['gidi_extra_amenities'] = array(
					'label' => __("Extra Amenities",$this->text_domain ),
					'target' => "gidi_extra_amenities_data",
					"class" => ['show_if_' . $this->product_type_id  ,' show_if_variable_' . $this->product_type_id ],
				);

				return $tabs;
			}

		}

		new Gidi_hotels_product_type();
	}

	add_action("plugins_loaded", "gidi_rooms_product_type");
}