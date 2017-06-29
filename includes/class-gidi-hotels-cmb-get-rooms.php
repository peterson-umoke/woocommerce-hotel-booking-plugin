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

class Gidi_hotels_cmb_get_rooms {
    public function __construct() {

    }

    public function add_table_field( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {
        ?>
            
        <?php
        $field_type_object->_desc( true, true ); 
    }

    public function save_table_field( $override_value, $value, $object_id, $field_args ) {
        
    }
}