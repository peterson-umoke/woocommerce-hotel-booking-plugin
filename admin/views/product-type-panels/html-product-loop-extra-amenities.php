<tr>
	<td class="sort"></td>
	<td class="gidi_extra_amenities_name">
		<input type="text" class="input_text" placeholder="<?php esc_attr_e( 'Label', "wc-gidi-hotels-and-rooms" ); ?>" name="_extra_amenities_names[]" value="<?php echo esc_attr( $name ); ?>" />
		<input type="hidden" name="_gidi_hotel_extra_amenities[]" value="<?php echo esc_attr( $key ); ?>" />
	</td>
	<td class="gidi_extra_amenities_value"><input type="text" class="input_text" placeholder="<?php esc_attr_e( "Content", "wc-gidi-hotels-and-rooms" ); ?>" name="_extra_amenities_values[]" value="<?php echo esc_attr( $value ); ?>" /></td>
	<td class="" width="1%"><!-- empty placeholder for the next content --></td>
	<td width="1%"><a href="#" class="delete"><?php _e( 'Delete', "wc-gidi-hotels-and-rooms" ); ?></a></td>
</tr>
