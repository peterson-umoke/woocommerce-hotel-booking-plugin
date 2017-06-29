<tr>
	<td class="sort"></td>
	<td class="gidi_hotels_cmb_table_name">
		<input type="text" class="input_text" placeholder="<?php esc_attr_e( 'Name', "gidi-hotels" ); ?>" name="_gidi_hotels_cmb_table_name[] _<?php echo $field->args( 'id' ); ?>" value="<?php echo esc_attr( $name ); ?>" />
		<input type="hidden" name="_gidi_hotels_cmb_table[] _<?php echo $field->args( 'id' ); ?>" value="<?php echo esc_attr( $name ); ?>" />
	</td>
	<td class="gidi_hotels_cmb_table_value" colspan="2"><input type="text" class="input_text" placeholder="<?php esc_attr_e( "Value", "gidi-hotels" ); ?>" name="_gidi_hotels_cmb_table_value[] _<?php echo $field->args( 'id' ); ?>" value="<?php echo esc_attr( $value ); ?>" /></td>
	<td width="1%"><a href="#" class="delete"><?php _e( 'Delete', "gidi-hotels" ); ?></a></td>
</tr>