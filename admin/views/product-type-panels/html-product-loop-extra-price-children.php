<tr>
	<td class="sort"></td>
	<td class="gidi_extra_children_qty">
		<input type="number" class="input_text" placeholder="<?php esc_attr_e( 'Number of Children', "wc-gidi-hotels-and-rooms" ); ?>" name="_gidi_hotel_extra_children_qty[]" value="<?php echo esc_attr( $name ); ?>" />
		<input type="hidden" name="_gidi_hotel_extra_children[]" value="<?php echo esc_attr( $key ); ?>" />
	</td>
	<td class="gidi_extra_children_price" colspan="2"><input type="number" class="input_text" placeholder="<?php esc_attr_e( "Price(".get_woocommerce_currency_symbol().")", "wc-gidi-hotels-and-rooms" ); ?>" name="_gidi_hotel_extra_children_price[]" value="<?php echo esc_attr( $value ); ?>" /></td>
	<td width="1%"><a href="#" class="delete"><?php _e( 'Delete', "wc-gidi-hotels-and-rooms" ); ?></a></td>
</tr>