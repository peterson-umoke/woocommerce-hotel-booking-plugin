<div class="hotel-listings__search-container <?= $atts['classes']; ?>">
    <h2>Filter Your Search</h2>
    <div class="hotel-listings__full-width">
        
        <form action="<?php echo site_url($atts['submit_page']); ?>" class="hotel-listings__form-container" method="GET">
            
            <div class="hotel-listings__group">
                <h2 class="hotel-listings__title">
                    <?php echo $atts['title']; ?>
                </h2>
            </div>

            <div class="hotel-listings__form-group">
                <label for="gidi_hotel_user_budget" class="hotel-listings__form-label">What's Your Budget Like ?</label>
                <input type="number" class="hotel-listings__form-control" name="gidi_hotel_user_budget" id="gidi_hotel_user_budget" data-toggle="tooltip" data-placement="bottom" title="Amount" placeholder="Amount">
            </div><!-- .hotel-listings__form-group -->

            <div class="hotel-listings__form-group">
                <label for="gidi_hotel_name" class="hotel-listings__form-label">Hotel Name</label>
                <input type="text" class="hotel-listings__form-control" name="gidi_hotel_name" id="gidi_hotel_name" data-toggle="tooltip" data-placement="bottom" title="Name of Hotel" placeholder="Name of Hotel">
            </div><!-- .hotel-listings__form-group -->

            <div class="hotel-listings__form-group">
                <label for="gidi_hotel_min_price" class="hotel-listings__form-label">Price From</label>
                <input type="number" class="hotel-listings__form-control" name="gidi_hotel_min_price" id="gidi_hotel_min_price" data-toggle="tooltip" data-placement="bottom" title="Price From" placeholder="Price From">
            </div><!-- .hotel-listings__form-group -->

            <div class="hotel-listings__form-group">
                <label for="gidi_hotel_price_to" class="hotel-listings__form-label">Price To</label>
                <input type="number" class="hotel-listings__form-control" name="gidi_hotel_price_to" id="gidi_hotel_price_to" data-toggle="tooltip" data-placement="bottom" title="What's the highest Price you want to search on" placeholder="Price To">
            </div><!-- .hotel-listings__form-group -->

            <div class="hotel-listings__form-group">
                <label for="gidi_hotel_check_in" class="hotel-listings__form-label">Check In</label>
                <input type="date" class="hotel-listings__form-control" name="gidi_hotel_check_in" id="gidi_hotel_check_in" data-toggle="tooltip" data-placement="bottom" title="Check In Date - Time" placeholder="Check In Date - Time">
            </div><!-- .hotel-listings__form-group -->

            <div class="hotel-listings__form-group">
                <label for="gidi_hotel_check_out" class="hotel-listings__form-label">Check Out</label>
                <input type="date" class="hotel-listings__form-control" name="gidi_hotel_check_out" id="gidi_hotel_check_out" data-toggle="tooltip" data-placement="bottom" title="Check Out Date - Time" placeholder="Check Out Date - Time">
            </div><!-- .hotel-listings__form-group -->
            
            <div class="hotel-listings__form-group">
                <label for="gidi_hotel_landmark" class="hotel-listings__form-label">Select Hotel Landmarks</label>
                <select type="number" class="hotel-listings__form-control" name="gidi_hotel_landmark[]" id="gidi_hotel_landmark" data-toggle="tooltip" data-placement="bottom" title="" placeholder=""> 
                    <option value="">Select Landmark</option>
                    <?php 
                        $hotel_model = new Gidi_hotels_model();
                        $hotel_locations = $hotel_model->get_landmarks();

                        foreach($hotel_locations as $name => $value) {
                            echo "<option value='{$name}'>{$value}</option>";
                        }
                    ?>
                </select>
            </div><!-- .hotel-listings__form-group -->

            <div class="hotel-listings__form-group">
                <label for="gidi_hotel_location" class="hotel-listings__form-label">Select Location</label>
                <select type="number" class="hotel-listings__form-control" name="gidi_hotel_location" id="gidi_hotel_location" data-toggle="tooltip" data-placement="bottom" title="" placeholder=""> 
                    <option value="">Select Location</option>
                    <?php 
                        $hotel_locations = get_terms("gidi_hotel_locations", array('hide_empty'=> false,'parent'=> 0) );

                        foreach($hotel_locations as $name => $value) {
                            echo "<option value='gidi_hotel_locations-{$value->term_id}'>{$value->name}</option>";
                        }
                    ?>
                </select>
            </div><!-- .hotel-listings__form-group -->

            <div class="hotel-listings__form-group">
                <label for="gidi_hotel_star_rating" class="hotel-listings__form-label">Star Rating</label>
                <?php for($i = 1; $i <= 5; $i++): ?>
                <div class="hotel-listings__form-control" name="" id="" data-toggle="tooltip" data-placement="bottom" title="" placeholder="">
                    <label class="hotel-listings__form-label-inner">
                        <input type="checkbox" name="gidi_hotel_star_rating[]" value="<?= $i; ?>" id="gidi_hotel_star_rating[]">
                        <?= $stars .= '<i class="fa fa-star fa-lg text-eve-primary"></i>'; ?> <?= $i; ?> Star
                    </label>
                </div>
                <?php endfor; ?>
            </div><!-- .hotel-listings__form-group -->

            <div class="hotel-listings__form-group">
                <label class="hotel-listings__label">Select Hotel Facilities </label>
                <?php
                $hotel_locations = get_terms("gidi_hotel_facilities", array('hide_empty'=> false,'parent'=> 0) );

                foreach($hotel_locations as $name => $value) { ?>
                <div class="hotel-listings__form-control" name="" id="" data-toggle="tooltip" data-placement="bottom" title="" placeholder="">
                    <label for="gidi_hotel_facilities-<?php echo $value->term_id; ?>" class="hotel-listings__form-label-inner">
                        <input type="checkbox" name="gidi_hotel_facilities-<?php echo $value->term_id; ?>[]" id="gidi_hotel_facilities-<?php echo $value->term_id; ?>">
                        <i class="<?php echo get_term_meta($value->term_taxonomy_id,"hotel_custom_font_icon_field",true); ?> fa-lg"></i> <?php echo $value->name; ?>
                    </label>
                </div>
                <?php }   ?>
            </div><!-- .hotel-listings__form-group -->

            <div class="hotel-listings__form-group">
                <label class="hotel-listings__label">Select Hotel Services </label>
                <?php
                $hotel_locations = get_terms("gidi_hotel_services", array('hide_empty'=> false,'parent'=> 0) );

                foreach($hotel_locations as $name => $value) { ?>
                <div class="hotel-listings__form-control" name="" id="" data-toggle="tooltip" data-placement="bottom" title="" placeholder="">
                    <label for="gidi_hotel_services-<?php echo $value->term_id; ?>" class="hotel-listings__form-label-inner">
                        <input type="checkbox" name="gidi_hotel_services-<?php echo $value->term_id; ?>[]" id="gidi_hotel_services-<?php echo $value->term_id; ?>">
                        <i class="<?php echo get_term_meta($value->term_taxonomy_id,"hotel_custom_font_icon_field",true); ?> fa-lg"></i> <?php echo $value->name; ?>
                    </label>
                </div>
                <?php }   ?>
            </div><!-- .hotel-listings__form-group -->

        </form>
    </div>
</div>