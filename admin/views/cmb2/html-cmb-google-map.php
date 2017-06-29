<?php $field_type_object->_desc( true, true ); ?>
<input type="text" class="large-text gidi-hotels-map-search" id="<?php echo $field->args( 'id' ); ?>" name="address" placeholder='Type a street, city, state, any location' value="<?php echo get_post_meta(get_the_ID(),"_gidi_hotels_address_location",true); ?>"/>
<div class="gidi-hotels-map"></div>

<?php 
    echo $field_type_object->input( array(
        'type'       => 'hidden',
        'name'       => $field->args('_name') . '[latitude]',
        'value'      => isset( $field_escaped_value['latitude'] ) ? $field_escaped_value['latitude'] : '',
        'class'      => 'gidi-hotels-map-latitude',
        'desc'       => '',
    ) );
    echo $field_type_object->input( array(
        'type'       => 'hidden',
        'name'       => $field->args('_name') . '[longitude]',
        'value'      => isset( $field_escaped_value['longitude'] ) ? $field_escaped_value['longitude'] : '',
        'class'      => 'gidi-hotels-map-longitude',
        'desc'       => '',
    ) );
?>
