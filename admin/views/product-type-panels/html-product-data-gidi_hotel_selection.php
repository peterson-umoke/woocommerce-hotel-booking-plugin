<div id="gidi_hotel_selection_data" class="panel woocommerce_options_panel">

    <div class="options_group">
        <?php 
            $args = array(
                "post_type" => "gidi_hotels",
                "orderby"   => "title",
                "order"     => "asc",
                "post_per_page" => -1,
            );

            $query = new WP_Query($args);
            $p_data = $query->posts;
            $reference_id = get_post_meta( $thepostid, "_gidi_hotel_select_hotel", true );

        ?>

        <p class="form-field gidi_select_hotel_listings_field ">
            <label for="gidi_select_hotel_listings">Choose Hotel</label>
            <select id="gidi_select_hotel_listings" name="_gidi_hotel_select_hotel" class="select short" style="">
                <option value="">None</option>
                <?php if($query->have_posts()): ?>
                <?php while($query->have_posts()): $query->the_post(); ?>
                    <option value="<?php echo get_the_ID(); ?>" <?php selected($reference_id, get_the_ID() ); ?>><?php echo the_title(); ?></option>
                <?php endwhile; ?>
                <?php else: ?>
                    <option value="no-hotel-avail">No Hotel Available Now</option>
                <?php endif; ?>
            </select> 

            <span class="description">
                Choose the Hotel You want to link this room to, if it is not here <a href="<?php echo site_url(); ?>/wp-admin/post-new.php?post_type=gidi_hotels"> Add </a> One 
                <?php echo wc_help_tip( __( 'This is the URL or absolute path to the file which customers will get access to. URLs entered here should already be encoded.', 'woocommerce' ) ); ?>
            </span>
        </p>

    </div>

    <?php 
        /**
         * @todo Add the jQuery function to spit the details of selected hotels in the div blocks below
         */
    ?>
    <div class="gidi_hotel_selection_details"></div>
</div>

<script>
    /**
     * Hotel Selection Script for the use of the #rest-api
     */
    (function($){
        
        'use strict';

        $(document).ready(function(){

            /**
             * Using the WP_REST_API to get and show dynamic content for the user's hotel selection module
             */
            var hotel_select_id = $("#gidi_select_hotel_listings");
            var hotel_content_placeholder = $(".gidi_hotel_selection_details");
            var hotel_select_value = hotel_select_id.val();
            var content_heading = "Selected Hotel Details";
            var api_url = gidi_hotels_api_data.site_url + "/wp-json/wp/v2";
            var api_media_url = api_url + "/media/";
            var api_hotel_url = api_url + "/gidi_hotels/";
            var message = "";

            hotel_content_placeholder.html("Loading ...");

            function insertHotelContent(hotel_has_image = true, hotel_title = "",hotel_content = "", hotel_image_url = "", hotel_link = ""){
                hotel_content = hotel_content.substring(0,25);
                var content = "<h1 class='center-the-text'>" + content_heading + "</h1>";
                    content += "<table class='widefat'>";
                    content += "<tr>";
                    if(hotel_has_image){
                        content += "<td style='width:50%;'>";
                        content += '<img class="gidi_ajax_picture" src="'+ hotel_image_url + '" alt="' + hotel_title + '">';
                        content += "</td>";
                        content += "<td style='width:50%;'>";
                    } else {
                        content += "<td style='width:100%;'>";
                    }
                        content += '<div class="gidi_ajax_title"><h1><span>' + hotel_title + '</span></h1></div>';
                        content += '<div class="gidi_ajax_description">Description: <span>' + hotel_content + '</span></div>';
                        content += '<div class="gidi_ajax_link"> <a href="' + hotel_link + '" target="_blank"> See this Hotel Now </a> </div>';
                        content += "</td>";
                        content += "</tr>";
                        content += "</table>";

                return content;
            }

            hotel_select_id.on("change",function(){
                var new_value = this.value;
                if(new_value != 0 || new_value <= 0 || new_value != "") {
                    hotel_content_placeholder.html("Loading ...");
                    $.ajax({
                        type: "GET",
                        url: api_hotel_url+ new_value,
                        success: function (response) {
                            var title = response.title.rendered;
                            var content = response.content.rendered;
                            var permalink = response.link;
                            var f_media = response.featured_media;

                            if(f_media != 0 || f_media <= 0) {
                                $.ajax({
                                    type: "GET",
                                    url: api_media_url + f_media,
                                    success: function (media_api) {
                                        var piture_data = media_api.media_details.sizes.medium;
                                        var featured_url = picture_data.source_url;
                                        hotel_content_placeholder.html(insertHotelContent(true,title,content,featured_url,permalink));
                                    },
                                    error : function() {
                                        hotel_content_placeholder.html(insertHotelContent(false,title,content,null,permalink));
                                    }
                                });
                            } else {
                                hotel_content_placeholder.html(insertHotelContent(false,title,content,null,permalink));
                            }

                        }
                    });
                } else {
                    hotel_content_placeholder.html("No Hotel Selected");
                }
            });

            var hotel_current_value = hotel_select_id.val();
            if(hotel_current_value != 0 || hotel_current_value <= 0 || hotel_current_value != "") {
                $.ajax({
                    type: "GET",
                    url: api_hotel_url+ hotel_current_value,
                    success: function (response) {
                        var title = response.title.rendered;
                        var content = response.content.rendered;
                        var permalink = response.link;
                        var f_media = response.featured_media;

                        if(f_media != 0 || f_media <= 0) {
                            $.ajax({
                                type: "GET",
                                url: api_media_url + f_media,
                                success: function (media_api) {
                                    var piture_data = media_api.media_details.sizes.medium;
                                    var featured_url = picture_data.source_url;
                                    hotel_content_placeholder.html(insertHotelContent(true,title,content,featured_url,permalink));
                                },
                                error: function() {
                                     hotel_content_placeholder.html(insertHotelContent(false,title,content,null,permalink));
                                }
                            });
                        } else {
                                hotel_content_placeholder.html(insertHotelContent(false,title,content,null,permalink));
                        }

                    }
                });
            } else {
                hotel_content_placeholder.html("No hotels found");
            }
            
        });
    })(jQuery);
</script>