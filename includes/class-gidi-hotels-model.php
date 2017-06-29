<?php

/**
 * This file just basically contains the whole manually inputted data for this plugin's use
 * Using oop i believe it safe from the publics eyes
 * 
 * @package gidi-hotels/
 * @subpackage gidi-hotels/includes
 * 
 * @author Peterson Nwachukwu Umoke <umoke10@hotmail.com>
 */

class Gidi_hotels_model {

    /**
     * Set the default value for te packages segment
     *
     * @var array
     * @access public
     */
    public $packages = array();

    /**
     * Set the default values for the amemnities var
     *
     * @var array
     * @access public
     */
    public $amenities = array();

    public function __construct() {
        $this->packages = array(
            "pool-access"   => "Pool Access",
            "laundry"       => "Laundry",
            "dry-cleaning"  => "Dry Cleaning",
        );

        // $this->amenities = get_terms( 'amenities', array('hide_empty'=> false,'parent'=> 0) );
        $this->amenities = array(
            "air-condition" => "Air Condition",
            "cable-tv"      => "Cable TV",
            "satelite-tv"   => "Satelite TV",
            "dstv"          => "DSTV",
            "computer"      => "Computer",
            "dishwashers"   => "Dishwashers",
            "dvd"           => "DVD",
            "fridge"        => "Fridge",
            "hair-dryer"    => "Hair Dryer",
            "hi-fi"        =>  "Hi-Fi",
            "fan"           => "Fan",
            "internet"      => "Internet",
            "iron"          => "Iron",
            "balcony"       => "Balcony",
            "oven"          => "Oven",
            "micro-wave"    => "Micro-Wave",
            "table"         => "Table",
            "dinner-table"  => "Dinner Table",
            "use-of-towels" => "Use of Towels",
            "toaster"       => "Toaster",
            "radio"         => "Radio",
        );

    }

    public function packages() {
        $package_total = $this->packages;

        return $package_total;
    }

    public function amenities() {
        $amenities = $this->amenities;

        return $amenities;
    }

    public function get_landmarks() {
        return array(
            "bus-terminal" => "Bus Terminal", 
            "airport" => "Airport", 
            "shopping-mall" => "Shopping Mall", 
            "shipping-port" => "Shipping Port",
            "city-centre"   => "City Centre",
            "town-hall"     => "Town Hall",
            );
    }

    public function homepage_tabs() {
        return array(
            array(
                "slug" => '#',
                "name" => 'Hotels',
            ),
            array(
                "slug" => "packages",
                "name" => "Packages",
            ),
            array(
                "slug" => 'home-and-travels',
                "name" => 'Flights',
            ),
        );
    }

    public function templates() {
        return array(
			'../public/views/page-templates/template-gidi-hotel-empty.php' => 'Gidi Hotel Empty',
			'../public/views/page-templates/template-gidi-hotel-booking.php' => 'Gidi Hotel Booking',
			'../public/views/page-templates/template-gidi-hotel-search.php' => 'Hotel Search Page',
			'../public/views/page-templates/template-gidi-hotel-listings.php' => 'Gidi Hotel Listings',
		);
    }
}