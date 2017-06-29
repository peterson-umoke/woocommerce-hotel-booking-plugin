(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$(function(){

		/**
		 * The sale and general price engine for the plugin
		 */
		var guess_hotels = $("#guess_room_checkbox");

		guess_hotels.change(function(){
			if(this.checked) {
				$("#_gidi_hotels_general_price_meta").val("The value is set").attr("disabled","disabled");
				$("#_gidi_hotels_sale_price_meta").val("The value is set").attr("disabled","disabled");
			} else {
				$("#_gidi_hotels_general_price_meta").val("").removeAttr("disabled");
				$("#_gidi_hotels_sale_price_meta").val("").removeAttr("disabled");
			}
		});

		/**
         * Add the General Tab options to our custom product type
         */
        $( '.options_group.pricing' ).addClass( 'show_if_wc_gidi_hotel_rooms_listings' ).show();

        /**
         * Allow for grouped product sell-out
         */

        $(".options_group > .show_if_grouped").addClass("show_if_wc_gidi_hotel_rooms_listings").show();

        /**
         * Add custom icon for the hotel listing post type
         */
        $(".menu-icon-gidi_hotels").find(".wp-menu-image").replaceWith("<div class='fa fa-hotel'></div>");
        // $(".menu-icon-wbr_booking_listings").find(".wp-menu-image").replaceWith("<div class='fa fa-address-book-o'></div>");

        /**
         * Dynamically add classes to what has a fa.fa-**something there ** in the dashboard sidemenu
         */
        $("#adminmenumain .fa").addClass("wp-menu-image fontawesome-before");
	});

})( jQuery );
