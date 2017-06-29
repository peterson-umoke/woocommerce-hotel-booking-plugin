<div id="gidi_amenities_data" class="panel woocommerce_options_panel">
    <div class="options_group">
    <?php 
        $amenities_data = new Gidi_hotels_model();
        $amenities = $amenities_data->amenities();

        if(!empty($amenities)):

        foreach($amenities as $name => $value) { ?>

            <div class="options_group">
                <?php
                    woocommerce_wp_checkbox( array(
                        'id'                => "_gidi_hotel_room_".$name,
                        'label'             => __( $value, 'wc-gidi-hotels-and-rooms' ),
                        "desc_tips"         => true,
                        "description"       => "Please check the custom values",
                    ) );
                ?>
            </div>
    <?php 
        }

    else: 
        echo "<h2> There are no services registered yet, please add some hotel services then refresh this page to select the services you want to add</h2>";
    endif;
    ?>
    </div>
</div>