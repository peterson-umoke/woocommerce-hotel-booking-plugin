<style>
    .main-inner{
        padding:25px 0;
    }
    .page-title.main-search {
        display:block;
    }

    .page-title,.woocommerce-breadcrumb {
        display:none;
    }
</style>

<form action="#" method="post">
    <div class="gh-grid-wrapper">
        <div class="gh-gallery-five">
            <label class="gh-search-label" for="hotel_name">Hotel Name</label>
            <select type="text" name="hotel_name" id="hotel_name" class="hotel_name" placeholder="Hotel Name">
                <option value="">Choose Hotel name</option>
                <?php 
                    $q = new WP_Query(["post_type" => "gidi_hotels"]);

                    if($q->have_posts()): 
                        while($q->have_posts()): $q->the_post(); ?>
                            <option value="<?php echo get_the_ID(); ?>"><?php the_title(); ?></option>
                        <?php endwhile; 
                        wp_reset_postdata();
                    endif;
                ?>
            </select>
        </div>
        <div class="gh-gallery-five">
            <label class="gh-search-label" for="hotel_check_in">Check In</label>
            <input type="text" name="hotel_check_in" id="hotel_check_in" class="hotel_check_in" placeholder="Check In">
        </div>
        <div class="gh-gallery-five">
            <label class="gh-search-label" for="hotel_check_out">Check Out</label>
            <input type="text" name="hotel_check_out" id="hotel_check_out" class="hotel_check_out" placeholder="Check Out">
        </div>
        <div class="gh-gallery-five">
            <label class="gh-search-label" for="hotel_adult_number">Adults</label>
            <input type="number" min="1" value="1" name="hotel_adult_number" id="hotel_adult_number" class="hotel_adult_number" placeholder="Number of Adults">
        </div>
        <div class="gh-gallery-five">
            <label class="gh-search-label" for="hotel_children_number">Children</label>
            <input type="number" min="0" value="0" name="hotel_children_number" id="hotel_children_number" class="hotel_children_number" placeholder="Number of Children">
        </div>
    </div>
    <div class="gh-cleafix gh-make-space-top">
        <button type="submit" class="button button-centered button-secondary button-rounded"> Search </button>
    </div>
</form>

<style>
	
</style>