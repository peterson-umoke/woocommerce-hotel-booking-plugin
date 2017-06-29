<?php

/**
 * This class is an extension to the cmb2 library allowing users to input information in  a tabular layout, and it comes with a repeater field.
 * 
 * @cmb2-plugin
 * @author Peterson nwachukwu umoke
 * @version 1.20.0
 * @package gidi-hotels
 * @subpackage gidi-hotels/includes
 */

class Gidi_hotels_cmb_table_layout {
    public function __construct() {

    }

    public function add_table_field( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {
        ?>
            <div class="gidi-hotel-repeater-container">
            <table class="widefat center-the-text gidi-hotels-repeater-wrap">
                <thead>
                    <tr>
                        <th class="sort">&nbsp;</th>
						<th class="_gidi-hotels-table-layout-name-field make-it-important center-the-text bold-the-text"><?php _e( 'Name', "gidi-hotels" ); ?></th>
						<th class="_gidi-hotels-table-layout-value-field make-it-important center-the-text bold-the-text" colspan="2"><?php _e( 'Value', "gidi-hotels" ); ?></th>
						<th class="center-the-text">&nbsp;</th>
                    </tr>
                </thead>
                <tbody class="">
                    <?php
                        $hotel_information_number = get_post_meta( $field_object_id, "_gidi_hotel_extra_information", true );
                        if ( $hotel_information_number ) {
                            foreach ( $hotel_information_number as $name => $value ) {
                                include( GHROOT . 'admin/views/cmb2/html-cmb-table.php' );
                            }
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="center-the-text make-it-important"><a href="#" class="button insert gidi-hotels-repeater-fields" data-row="<?php
                            $name  = '';
                            $value = "";
                            $hotel_information_number = array(
                                'name' => '',
                                'value' => '',
                            );
                            ob_start();
                            include( GHROOT . 'admin/views/cmb2/html-cmb-table.php' );
                            echo esc_attr( ob_get_clean() );
                        ?>">
                            <?php _e( 'Add New', "gidi-hotels" ); ?></a></td>
                    </tr>
                </tfoot>
            </table>
            </div>
        <?php
        $field_type_object->_desc( true, true ); 
    }

    public function save_table_field( $override_value, $value, $object_id, $field_args ) {
        if ( ! empty( $_POST['_gidi_hotels_cmb_table_name'] ) ) {
            $extra_info = array_combine ( $_POST["_gidi_hotels_cmb_table_name"] , $_POST['_gidi_hotels_cmb_table_value'] );
            update_post_meta( $object_id, "_gidi_hotel_extra_information", $extra_info );
        }
        
		return $value;
    }
}