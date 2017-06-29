<?php

/**
 * Autoloader File
 * 
 * This file basically autoload classes, i.e that is its includes them just once!
 * 
 * @author  Peterson Nwachukwu Umoke <umoke10@hotmail.com>
 * @version 2.1.0
 * @package wp-kwestion
 * 
 */

/**
 * The  Autoloader File
 *
 * This file is read by php to autoload classes that are called.
 *
 * @link              https://github.com/peterson-umoke/
 * @since             1.0.0
 * @package           Wp_Kwestion
 *
 * @wordpress-plugin wp-kwestion/wp-kwestion.php
 */

if ( ! defined( 'ABSPATH' ) ) { 
    exit; // Exit if accessed directly
}

/**
 * Call the autoload functionality
 */
spl_autoload_register("load_gidi_hotel_classes");

/**
 * Autoload classes in the wp-kwestion directory
 *
 * @param [type] $classname
 * @return void
 */
function load_gidi_hotel_classes( $classname ) {

    // strip all the underscores and replace with hyphens
    $filename = "class-" . strtolower( str_replace( "_", "-", $classname ) ) . ".php";

    /**
     * Check if the file exists in the includes folder, 
     * include it
     */
    if( file_exists( GHROOT . "includes" . GHDS . $filename ) ) {
        require_once GHROOT . "includes" . GHDS . $filename;
    }
    
    /**
     * Check if the file exists in the admin folder, 
     * include it
     */
    elseif( file_exists( GHROOT . "admin" . GHDS . $filename ) ) {
        require_once GHROOT . "admin" . GHDS . $filename;
    }
    
    /**
     * Check if the file exists in the public folder, 
     * include it
     */
    elseif( file_exists( GHROOT . "public" . GHDS . $filename ) ) {
        require_once GHROOT . "public" . GHDS . $filename;
    }
}
