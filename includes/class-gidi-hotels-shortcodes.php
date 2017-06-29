<?php

/**
 * The Plugin Shortcode dictionary
 * 
 * @author Peterson Nwachukwu Umoke <umoke10@hotmail.com>
 * @link http://www.github.com/peter-umoke
 * 
 * @package gidi_hotels
 * @subpackage gidi_hotels/includes
 * 
 * @version 3.2.1
 * 
 * This is basically a list of shortcodes used druing the templates creation process of the plugin
 */

class Gidi_hotels_shortcodes {

    /**
     * The Plugin's template loader var
     */
    public $template_loader = "";

    /**
     * This variable holds the plugin root file
     *
     * @var constant
     */
    protected $plugin_root = GHROOT;
    
    public function __construct() {
        $this->template_loader = new Gidi_hotels_template_loader();
    }

    public function template_loader($atts = array()) {
        $location = isset($atts['location']) ? $atts['location'] : "";

        return $this->template_loader->gh_get_template_html($location);
    }

    public function count_hotels() {
        $args = array(
            "post_type" => "gidi_hotels",
            "post_per_page" => -1,
        );

        $query = new WP_Query($args);

        return $query->found_post();
    }

    public function page_title_open($atts = array(), $content) {
        $val  = '<div class="page-title main-search">';
        $val .= '<div class="page-title-inner">';

        return $val;
    }

    public function page_title_close() {
        return '</div></div>'. woocommerce_breadcrumb();
    }
}