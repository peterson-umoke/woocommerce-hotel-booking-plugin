<div id="gidi_room_management_data" class="panel woocommerce_options_panel">
    <div class="options_group">
        <?php 
             woocommerce_wp_text_input( array(
				'id'          => '_gidi_hotel_room_size',
				'label'       => __( 'Room(Appartment) Size', 'gidi-hotels' ),
				'placeholder' => '12',
                "desc_tips"     => true,
				'description' => __( '<b>(m<sup>2</sup>)</b> Enter the Size of the Room.', 'gidi-hotels' ),
                "type"      => "text",
			) );
        ?>
    </div>

    <div class="options_group">
        <?php 
             woocommerce_wp_text_input( array(
				'id'          => '_gidi_hotel_number_of_rooms',
				'label'       => __( 'Number of Rooms', 'gidi-hotels' ),
				'placeholder' => '2',
				'description' => __( 'Enter the number of rooms.', 'gidi-hotels' ),
                "type"      => "number",
			) );
        ?>
    </div>

    <div class="options_group">
        <?php 
             woocommerce_wp_text_input( array(
				'id'          => '_gidi_hotel_room_capacity',
				'label'       => __( 'Capacities', 'gidi-hotels' ),
				'placeholder' => '2',
				'description' => __( 'Enter the room capacities.', 'gidi-hotels' ),
                "type"      => "number",
			) );
        ?>
    </div>

    <div class="options_group">
        <?php 
             woocommerce_wp_text_input( array(
				'id'          => '_gidi_hotel_number_of_children',
				'label'       => __( 'Children', 'gidi-hotels' ),
				'placeholder' => '1',
				'description' => __( 'Enter the number of children allowed in this room.', 'gidi-hotels' ),
                "type"      => "number",
			) );
        ?>
    </div>

    <div class="options_group">
        <?php 
             woocommerce_wp_text_input( array(
				'id'          => '_gidi_hotel_minimum_nights',
				'label'       => __( 'Minimum Nights', 'gidi-hotels' ),
				'placeholder' => '1',
                "desc_tips"     => true,
				'description' => __( 'Enter the minimum number of nights one is allowed.', 'gidi-hotels' ),
                "type"      => "number",
			) );
        ?>
    </div>

    <div class="options_group">
        <?php 
             woocommerce_wp_text_input( array(
				'id'          => '_gidi_hotel_number_of_beds',
				'label'       => __( 'Beds', 'gidi-hotels' ),
				'placeholder' => '2',
				'description' => __( 'Enter the number of beds with description', 'gidi-hotels' ),
                "type"      => "text",
			) );
        ?>
    </div>
</div>