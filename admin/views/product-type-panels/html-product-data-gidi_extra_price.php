<div id="gidi_extra_price_data" class="panel woocommerce_options_panel">
    <div class="options_group">
        <div class="form_fields gidi_repeater_fields">
        
            <table class="widefat center-the-text">
                <thead>
                    <tr>
                        <th colspan="5" class="center-the-text bold-the-text make-it-important">Adults</th>
                    </tr>
                    <tr>
                        <th class="sort">&nbsp;</th>
						<th class="make-it-important center-the-text bold-the-text"><?php _e( 'Quantity', "wc-gidi-hotels-and-rooms" ); ?> <?php echo wc_help_tip( __( 'Number of Adults using this room', "wc-gidi-hotels-and-rooms" ) ); ?></th>
						<th class="make-it-important center-the-text bold-the-text" colspan="2"><?php _e( 'Price('.get_woocommerce_currency_symbol().')', "wc-gidi-hotels-and-rooms" ); ?> <?php echo wc_help_tip( __( 'per of adult per person.', "wc-gidi-hotels-and-rooms" ) ); ?></th>
						<th class="center-the-text">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $adult_qty = get_post_meta( $thepostid, "_gidi_hotel_extra_adult", true );
                        $adult_qty = json_decode($adult_qty);
                        if ( $adult_qty ) {
                            foreach ( $adult_qty as $name => $value ) {
                                include( 'html-product-loop-extra-price-adult.php' );
                            }
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="center-the-text make-it-important"><a href="#" class="button insert" data-row="<?php
                            $name  = '';
                            $value = "";
                            $adult_qty = array(
                                'name' => '',
                                'value' => '',
                            );
                            ob_start();
                            include( 'html-product-loop-extra-price-adult.php' );
                            echo esc_attr( ob_get_clean() );
                        ?>">
                            <?php _e( 'Add New', "wc-gidi-hotels-and-rooms" ); ?></a></td>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
    <!-- insert a spacer -->
    <br>
    <br>
    <!-- insert a spacer -->
    <div class="options_group">
        <div class="form_fields gidi_repeater_fields">
        
            <table class="widefat center-the-text">
                <thead>
                    <tr>
                        <th colspan="5" class="center-the-text bold-the-text make-it-important">Children</th>
                    </tr>
                    <tr>
                        <th class="sort">&nbsp;</th>
						<th class="make-it-important center-the-text bold-the-text"><?php _e( 'Quantity', "wc-gidi-hotels-and-rooms" ); ?> <?php echo wc_help_tip( __( 'Number of Adults using this room', "wc-gidi-hotels-and-rooms" ) ); ?></th>
						<th class="make-it-important center-the-text bold-the-text" colspan="2"><?php _e( 'Price('.get_woocommerce_currency_symbol().')', "wc-gidi-hotels-and-rooms" ); ?> <?php echo wc_help_tip( __( 'per of adult per person.', "wc-gidi-hotels-and-rooms" ) ); ?></th>
						<th class="center-the-text">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $children_qty = get_post_meta( $thepostid, "_gidi_hotel_extra_children", true );
                        $children_qty = json_decode($children_qty);
                        if ( $children_qty ) {
                            foreach ( $children_qty as $name => $value ) {
                                include( 'html-product-loop-extra-price-children.php' );
                            }
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="center-the-text make-it-important"><a href="#" class="button insert" data-row="<?php
                            $name  = '';
                            $value = "";
                            $children_qty = array(
                                'name' => '',
                                'value' => '',
                            );
                            ob_start();
                            include( 'html-product-loop-extra-price-children.php' );
                            echo esc_attr( ob_get_clean() );
                        ?>">
                            <?php _e( 'Add New', "wc-gidi-hotels-and-rooms" ); ?></a></td>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
</div>