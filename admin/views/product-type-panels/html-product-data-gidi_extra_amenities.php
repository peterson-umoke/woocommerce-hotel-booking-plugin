<div id="gidi_extra_amenities_data" class="panel woocommerce_options_panel">
    <div class="options_group">
		<div class="form-field gidi_repeater_fields">
			<table class="widefat">
				<thead>
					<tr>
						<th class="sort">&nbsp;</th>
						<th><?php _e( 'Name', "wc-gidi-hotels-and-rooms" ); ?> <?php echo wc_help_tip( __( 'This is the name of the extra amenities', "wc-gidi-hotels-and-rooms" ) ); ?></th>
						<th colspan="2"><?php _e( 'Value', "wc-gidi-hotels-and-rooms" ); ?> <?php echo wc_help_tip( __( 'The Value for the extra amenities name.', "wc-gidi-hotels-and-rooms" ) ); ?></th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$amenities_extra = get_post_meta( $thepostid, "_gidi_hotel_extra_amenities", true );
					$amenities_extra = json_decode($amenities_extra);
					if ( $amenities_extra ) {
						foreach ( $amenities_extra as $name => $value ) {
							include( 'html-product-loop-extra-amenities.php' );
						}
					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="5">
							<a href="#" class="button insert" data-row="<?php
								$name  = '';
								$value = "";
								$amenities_extra = array(
									'name' => '',
									'value' => '',
								);
								ob_start();
								include( 'html-product-loop-extra-amenities.php' );
								echo esc_attr( ob_get_clean() );
							?>"><?php _e( 'Add Extra Amenities', "wc-gidi-hotels-and-rooms" ); ?></a>
						</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>