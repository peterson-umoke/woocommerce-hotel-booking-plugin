<?php
$args = array(
			'post_type' 	=> 'gidi_hotels',
			// 'paged'			=> $paged,
            "posts_per_page"    => -1,
		);
$hotels = new WP_Query($args);
if($hotels->have_posts()): 
    while($hotels->have_posts()): $hotels->the_post(); 

    $hotel_facilities = wp_get_post_terms( get_the_ID(), "gidi_hotel_facilities", ["posts_per_page" => 4 ]);
    $hotel_location = wp_get_post_terms( get_the_ID(), "gidi_hotel_locations", ["posts_per_page" => 4 ]);
    $old_price = (null !== get_post_meta(get_the_ID(), "_gidi_hotels_general_price_meta", true)) ? get_post_meta(get_the_ID(), "_gidi_hotels_general_price_meta", true) : 1;
    $new_price = (null !== get_post_meta(get_the_ID(), "_gidi_hotels_sale_price_meta", true)) ? get_post_meta(get_the_ID(), "_gidi_hotels_sale_price_meta", true) : 1; 
    
    ?>

        <div class="gh-grid-wrapper single-hotel-listing">
            <div class="gh-content-left">
                <div class="featured-image">
                    <?php the_post_thumbnail( "medium" ); ?>
                </div>
                <div class="picture_action">
                    <span><i class="fa fa-heart-o"></i></span>
                </div>
            </div>
            <div class="gh-content-right">
                <div class="gh-card-top">
                    <div class="content-left">
                        <div class="hotel-name">
                            <a href="<?php the_permalink(); ?>">
                                <h2 title="<?php the_title(); ?>"> <?php the_title(); ?></h2>
                            </a>
                            <div class="star-ratings">
                                <?php 
                                    $star_count = get_post_meta(get_the_ID(), "_gidi_hotels_star_rating", true); 

                                    for($i = 1; $i <= $star_count; $i++){
                                        echo "<span class='fa fa-star'></span>";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="address">
                            <?php echo get_post_meta(get_the_ID(), "_gidi_hotels_address", true) ; ?>
                        </div>
                        <div class="location-terms">
                            <?php foreach($hotel_location as $key => $value): ?>
                                <span data-target="<?= $value->term_link; ?>" title="<?= $value->name; ?>" class="hotel-listings__location-tag"><?php echo $value->name; ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="content-right price">
                        <div class="hotel-listings__old-price">
                            <?php 
                                if(($new_price/$old_price) != 0):
                               echo  $percentage_value = ((($new_price/$old_price) * 100) != 0) ? "up to <span>"  . floor( (($new_price/$old_price) * 100) ) . '<i class="fa fa-percent"></i>' . ' Off </span>' : "";
                               endif;
                            ?>
                        </div>
                        <div class="hotel-listings__new-price">
                            <?php 
                                if($new_price):
                                    echo get_woocommerce_currency_symbol() . $new_price;
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="gh-card-middle">
                    <div class="content-left">
                        <div class="free-specials">
                            <b>Offers: </b><span><?php echo get_post_meta(get_the_ID(), "_gidi_hotels_specials_meta",true ); ?></span>
                        </div>
                    </div>
                    <div class="content-right">
                        <div class="overall">
                            7.2/10
                        </div>
                        <div class="reviews">
                            <?php echo comments_number( "<span>0 </span><span>Reviews </span>", "<span>1 </span><span>Review</span>", "<span>% </span><span>Reviews</span>" ); ?>
                        </div>
                    </div>
                </div>
                <div class="gh-card-bottom">
                    <div class="content-left">
                        <ul class="hotel-listings__top-facility-icon-group">
                        <?php foreach($hotel_facilities as $key => $value): ?>
                            <li class="hotel-listings__top-facility-icon">
                                <span class="facility-icon" title="<?php echo $value->name; ?>"><i class="<?php echo get_term_meta($value->term_taxonomy_id,"gidi_hotels_facility_icon_meta",true); ?> fa-lg"></i></span>
                                <span class="facility-name sr-only"><?php echo $value->name; ?></span>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="content-right">
                        <a href="<?php the_permalink(); ?>" class="button button-secondary button-rounded">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
<?php
    endwhile; wp_reset_postdata();

else:
    echo "No Rooms Available";
endif;