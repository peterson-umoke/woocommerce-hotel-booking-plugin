<h4 class="reset-heading put-a-difference">Room Categories</h4>
<div class="sort-rooms all-bordered more-air">
    <form action="#" method="post">
        <div class="gh-grid-wrapper">
            <div class="gh-grid-six">
                <label class="gh-search-label" for="hotel_check_in"> <small>  Check In </small> </label>
                <input type="text" name="hotel_check_in" id="hotel_check_in" class="hotel_check_in" placeholder="Check In">
            </div>
            <div class="gh-grid-six last">
                <label class="gh-search-label" for="hotel_check_out"> <small> Check Out </small> </label>
                <input type="text" name="hotel_check_out" id="hotel_check_out" class="hotel_check_out" placeholder="Check Out">
            </div>
            <div class="gh-grid-six gh-clearfix gh-make-space-top">
                <label class="gh-search-label" for="hotel_adult_number"> <small>  Adults </small> </label>
                <input type="number" min="1" value="1" name="hotel_adult_number" id="hotel_adult_number" class="hotel_adult_number" placeholder="Number of Adults">
            </div>
            <div class="gh-grid-six last gh-make-space-top">
                <label class="gh-search-label" for="hotel_children_number">Children</label>
                <input type="number" min="0" value="0" name="hotel_children_number" id="hotel_children_number" class="hotel_children_number" placeholder="Number of Children">
            </div>
        </div>
        <div class="gh-cleafix gh-make-space-top">
            <button type="submit" class="button button-block button-centered button-secondary button-rounded"> Search </button>
        </div>
    </form>
</div>

<div class="gh-grid-wrapper gh-clearfix gh-make-space-top">
    <?php 
        $this_id = get_the_ID();

        $new_args =array(
            "post_type" => "product",
            "posts_per_page"    => -1,
            'meta_key'   => '_gidi_hotel_select_hotel',
            'meta_value' => $this_id,
        );
        $rooms = new WP_Query($new_args);

        if($rooms->have_posts()):
            while($rooms->have_posts()): $rooms->the_post();
    ?>
    <div class="gh-clearfix">
        <div class="gh-grid-four">
            <?php if(has_post_thumbnail( get_the_ID() )): ?>
            <?php the_post_thumbnail( 'thumbnail' ); ?>
            <?php else: ?>
            <?php echo wc_placeholder_img( ); ?>
            <?php endif; ?>
        </div>
        <div class="gh-grid-eight last">
            <p class="reset-heading"><strong><?php the_title(); ?></strong></p>
            <?php
                global $woocommerce;
                $currency = get_woocommerce_currency_symbol();
                $price = get_post_meta( get_the_ID(), '_regular_price', true);
                $sale = get_post_meta( get_the_ID(), '_sale_price', true);
                
            ?>
            <?php if($sale) : ?>
                <h5 class="product-price-tickr reset-heading"><del><?php echo $currency; echo $price; ?></del> <?php echo $currency; echo $sale; ?></h5>    
            <?php elseif($price) : ?>
                <h4 class="product-price-tickr reset-heading"><?php echo $currency; echo $price; ?></h4>    
            <?php endif; ?>
            <div class="gh-cleafix gh-make-space-top">
                <?php $book_room_now_url = do_shortcode( "[add_to_cart_url id=". get_the_ID() . "]" ); ?>
                <a href="<?php echo $book_room_now_url; ?>" class="button button-centered button-reset-ib button-rounded"> Book Now </a>
            </div>
        </div>
    </div>

    <?php endwhile; wp_reset_postdata(); ?>
    <?php else: ?>
        <h4>No Rooms Available for this Hotel</h4>
    <?php endif; ?>
</div>