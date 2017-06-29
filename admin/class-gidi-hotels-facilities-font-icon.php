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
class Gidi_hotels_facilities_font_icon {

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
		$this->language = $locale;
		$this->plugin_name = str_replace( "-", "_", $plugin_name) . "_facility_icon_meta";
	}

    public function facilities_custom_column( $columns ) {
        $columns[$this->plugin_name] = __( 'Facility Icon', $this->language );

        return $columns;
    }

	public function facilities_add_field_column_contents( $content, $column_name, $term_id ) {
        switch( $column_name ) {
            case $this->plugin_name :
                $content = get_term_meta( $term_id, $this->plugin_name, true );
                $content  = "<i class='{$content} fa-3x fa-lg' style='text-align:center;'></i>";
                break;
        }

        return $content;
    }

    public function facilities_add_custom_font( $taxonomy ) {
        ?>
        <div class="form-field term-group">
            <label for="<?= $this->plugin_name; ?>"><?php _e( 'Font Icon Class', $this->language ); ?></label>
            <input type="text" id="<?= $this->plugin_name; ?>" name="<?= $this->plugin_name; ?>" />
            <p class="description">Add A custom font icon class here.</p>
        </div>
        <?php
    }

    public function facilities_edit_custom_font( $term, $taxonomy ) {
        $this->plugin_name . $_font_icon_meta = get_term_meta( $term->term_id, $this->plugin_name, true );
        ?>
        <tr class="form-field term-group-wrap">
            <th scope="row">
                <label for="<?= $this->plugin_name; ?>"><?php _e( 'Font Icon Class', 'wc-gidi-hotels-room' ); ?></label>
            </th>
            <td>
                <input type="text" id="<?= $this->plugin_name; ?>" name="<?= $this->plugin_name; ?>" value="<?php echo $this->plugin_name . $_font_icon_meta; ?>" />
                <p class="description">Please state the full class of the font icon that you are adding.</p>
            </td>
        </tr>
        <?php
    }

    public function facilities_update_custom_font( $term_id, $tag_id ) {
        if( isset( $_POST[$this->plugin_name] ) ) {
            update_term_meta( $term_id, $this->plugin_name, esc_attr( $_POST[$this->plugin_name] ) );
        }
    }

}
