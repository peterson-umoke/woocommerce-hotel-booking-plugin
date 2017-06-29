<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/peterson-umoke/
 * @since      1.0.0
 *
 * @package    Gidi_hotels
 * @subpackage Gidi_hotels/admin
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Gidi_hotels
 * @subpackage Gidi_hotels/admin
 * @author     Peterson Nwachukwu Umoke <umoke10@hotmail.com>
 */
class Gidi_hotels_location_images {

	/**
	 * Plugin name
	 */
	protected $plugin_name;

	/**
	 * Language ID
	 */
	protected $locale;

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function __construct($plugin_name , $locale ) {
		$this->locale = $locale;
		$this->plugin_name = str_replace( "-", "_", $plugin_name);
        $this->plugin_name = $this->plugin_name . "_location_image_meta";
	}

    public function location_custom_columnn( $columns ) {
        //  $columns[this->plugin_name] = __( 'Location Image', $this->locale );

        return $columns;
    }

	function location_add_field_column_contents( $content, $column_name, $term_id ) {
        switch( $column_name ) {
            case $this->plugin_name :
                $content = get_term_meta( $term_id, $this->plugin_name, true );
                break;
        }

        return $content;
    }

    public function location_add_custom_image( $taxonomy ) {
        ?>
        <div class="form-field term-group">
            <label for="<?= $this->plugin_name; ?>"><?php _e( 'Location Thumbnail', $this->locale ); ?></label>

            <input type="text" id="<?= $this->plugin_name; ?>" name="<?= $this->plugin_name; ?>" style="margin-bottom:10px;"/>
            
            <input type="button" value="Upload Image" class="upload_location_image_btn button button-secondary" name="upload_location_image_btn" id="upload_location_image_btn">
            <input type="button" value="Remove Image" class="remove_location_image_btn button button-secondary" name="remove_location_image_btn" id="remove_location_image_btn">
            <p class="description">Upload a Image for this Location here</p>
        </div>
        <?php
    }

    public function location_edit_custom_image( $term, $taxonomy ) {
        $this->plugin_name = get_term_meta( $term->term_id, $this->plugin_name, true );
        ?>
        <tr class="form-field term-group-wrap">
            <th scope="row">
                <label for="<?php echo $this->plugin_name; ?>"><?php _e( 'Location Thumbnail', $this->locale ); ?></label>
            </th>
            <td>
                <input type="text" id="<?= $this->plugin_name; ?>" name="<?= $this->plugin_name; ?>" value="<?php echo '<?= $this->plugin_name; ?>'; ?>" style="margin-bottom:10px;"/>
                <input type="button" value="Upload Image" class="upload_location_image_btn button button-secondary" name="upload_location_image_btn" id="upload_location_image_btn">
                <input type="button" value="Remove Image" class="remove_location_image_btn button button-secondary" name="remove_location_image_btn" id="remove_location_image_btn">
                <p class="description">Upload an image for this location.</p>
            </td>
        </tr>
        <?php
    }

    public function location_update_custom_image( $term_id, $tag_id ) {
        if( isset( $_POST[$this->plugin_name] ) ) {
            update_term_meta( $term_id, $this->plugin_name, esc_attr( $_POST[$this->plugin_name] ) );
        }
    }

    public function location_upload_js() {
        ?>
        <script type="text/javascript">

        // Only show the "remove image" button when needed
        if ( '0' === jQuery( '#gidi_hotels_location_image_meta' ).val() ) {
            jQuery( '.remove_location_image_btn' ).hide();
        }

        // Uploading files
        var file_frame;

        jQuery( document ).on( 'click', '#upload_location_image_btn', function( event ) {

            event.preventDefault();

            // If the media frame already exists, reopen it.
            if ( file_frame ) {
                file_frame.open();
                return;
            }

            // Create the media frame.
            file_frame = wp.media.frames.downloadable_file = wp.media({
                title: '<?php _e( "Choose an image", "woocommerce" ); ?>',
                button: {
                    text: '<?php _e( "Use image", "woocommerce" ); ?>'
                },
                multiple: false
            });

            // When an image is selected, run a callback.
            file_frame.on( 'select', function() {
                var attachment           = file_frame.state().get( 'selection' ).first().toJSON();
                var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

                jQuery( '#gidi_hotels_location_image_meta' ).val( attachment_thumbnail.url );
                jQuery( '.remove_location_image_btn' ).show();
            });

            // Finally, open the modal.
            file_frame.open();
        });

        jQuery( document ).on( 'click', '.remove_location_image_btn', function() {
            jQuery( '#gidi_hotels_location_image_meta' ).val( '' );
            jQuery( '.remove_location_image_btn' ).hide();
            return false;
        });

    </script>
        <?php
    }

}
