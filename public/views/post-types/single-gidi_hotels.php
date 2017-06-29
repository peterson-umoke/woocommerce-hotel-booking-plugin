<?php
get_header(); ?>
<?php
// Start the loop.
while ( have_posts() ) : the_post(); 
$hotel_facilities = wp_get_post_terms( get_the_ID(), "gidi_hotel_facilities", ["posts_per_page" => 4 ]);
$hotel_services = wp_get_post_terms( get_the_ID(), "gidi_hotel_services", ["posts_per_page" => -1 ]);
$hotel_location = wp_get_post_terms( get_the_ID(), "gidi_hotel_locations", ["posts_per_page" => 4 ]);
$old_price = get_post_meta(get_the_ID(), "_gidi_hotels_general_price_meta", true);
$new_price = get_post_meta(get_the_ID(), "_gidi_hotels_sale_price_meta", true);
$star_count = get_post_meta(get_the_ID(), "_gidi_hotels_star_rating", true); 
?>

<div class="gh-grid-wrapper page-title main-search">
	<div class="gh-grid-full-width">
		<div class="gh-grid-four">
			<div class="featured-image">
				<?php the_post_thumbnail(); ?>
			</div>
		</div>
		<div class="gh-grid-six">
			<div class="location-terms">
				<?php foreach($hotel_location as $key => $value): ?>
					<span data-target="<?= $value->term_link; ?>" title="<?= $value->name; ?>" class="hotel-listings__location-tag"><?php echo $value->name; ?></span>
				<?php endforeach; ?>
			</div>
			<div class="hotel-title-name">
				<h1 title="<?php the_title(); ?>"><?php the_title(); ?></h1>
				<select id="star-rating">
					<?php for($i = 1; $i <= 5; $i++): ?>
						<option value="<?= $i; ?>"><?= $i; ?></option>
					<?php endfor; ?>
				</select>
			</div>
			<div class="hotel-description">
				<a href="#" class="show-map" onclick="showGoogleMap(<?php echo get_post_meta(get_the_ID(),'_gidi_hotels_gidi_hotels_main_location',true)['latitude']; ?>,<?php echo get_post_meta(get_the_ID(),'_gidi_hotels_gidi_hotels_main_location',true)['longitude']; ?>)"> <?php echo get_post_meta(get_the_ID(), "_gidi_hotels_address", true); ?>  <strong><i class="fa fa-map"></i> Show On Map </strong> </a>
				<div class="gh-make-space-top">
					<b>Email:</b> <?php echo get_post_meta(get_the_ID(),"_gidi_hotels_email_address_meta",true); ?>
				</div>
				<div class="gh-make-space-top">
					<b>Contact Us:</b> <?php $hov = get_post_meta(get_the_ID(),"_gidi_hotels_contact_number_meta",true); ?>
					<?php 
						for($j = 0; $j < count($hov);$j++ ){
							echo $hov[$j] . ",";
						}
					?>
				</div>
				<div class="gh-make-space-top">
					<b>Website: </b> <?php echo get_post_meta(get_the_ID(),"_gidi_hotels_website_meta",true); ?>
				</div>
				<div class="gh-make-space-top free-specials">
					<b>Offers: </b> <?php echo get_post_meta(get_the_ID(),"_gidi_hotels_specials_meta",true); ?>
				</div>
				<div class="gh-make-space-top free-specials">
					<a href="#" class="button button-secondary button-rounded"> Book Now</a> <a href="#" class="button button-rounded"> Add Action Now</a> 
				</div>
			</div>
		</div>
		<div class="gh-grid-two">
			<!-- social media share -->
		</div>
	</div>

	<div class="gh-grid-full-width gh-clearfix" id="hotel-gallery">
		<!-- Set up your HTML -->
			<div class="owl-carousel">
				<?php 
					$hotel_gallery = get_post_meta(get_the_ID(),"_gidi_hotels_gallery_meta",true); 
					foreach($hotel_gallery as $key => $value):
				?>
					<div> <?php echo wp_get_attachment_image( $key, 'thumbnail', false,["style"=>"width:100px;height:100px;"] ); ?></div>
				<?php endforeach; ?>
			</div>

			<script>
				jQuery(document).ready(function($){
					$(".owl-carousel").owlCarousel({
						items: 10,
						nav: true,
						margin:5,
					});
				});
			</script>
	</div>
</div>

<div class="gh-grid-wrapper gh-clearfix">
	<div class="gh-grid-twelve">
		<div class="gh-tabs">
			<ul class="tabs wc-tabs">
				<li><a onclick="openCity(event, 'rooms_data')" class="gh-tab-links active">Rooms</a></li>
				<li><a onclick="openCity(event, 'description')" class="gh-tab-links">Description</a></li>
				<li><a onclick="openCity(event, 'faciservce')" class="gh-tab-links">Facilities</a></li>
				<li><a onclick="openCity(event, 'location')" class="gh-tab-links">Map</a></li>
				<li><a onclick="openCity(event, 'policies')" class="gh-tab-links">Hotel Policies</a></li>
				<li><a onclick="openCity(event, 'extra_information')" class="gh-tab-links">Extra Information</a></li>
				<li><a onclick="openCity(event, 'reviews')" class="gh-tab-links">Reviews</a></li>
			</ul>
		</div>
		<div class="gh-tab-content">
			<div class="tab-content active" id="rooms_data">
				<h4> Room Categories </h4>
				<p>	<?php the_content(); ?> </p>
			</div>
			<div class="tab-content active" id="description">
				<h4>About the Hotel </h4>
				<p>	<?php the_content(); ?> </p>
			</div>
			<div class="tab-content" id="faciservce">
				<div class="gh-grid-wrapper">
					<div class="gh-grid-six">
						<h4>Services</h4>
						<ul class="no-list-styles">
							<?php foreach($hotel_services as $key => $value): ?>
							<li>
								<?php echo $value->name; ?>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
					<div class="gh-grid-six last">
						<h4>Facilities</h4>
						<ul class="no-list-styles">
							<?php foreach($hotel_facilities as $key => $value): ?>
							<li>
								<i class="<?php echo get_term_meta($value->term_id,'gidi_hotels_facility_icon_meta',true); ?>"></i> <?php echo $value->name; ?>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="tab-content" id="location">
				<h4>Hotel Location</h4>
				<div id="inner-google-maps" style="height:400px;width:100%;margin:auto;"></div>
				<script>
					var mapCanvas = document.getElementById("inner-google-maps");
					var mapOptions = {
						center: new google.maps.LatLng(<?php echo get_post_meta(get_the_ID(),'_gidi_hotels_gidi_hotels_main_location',true)['latitude']; ?>,<?php echo get_post_meta(get_the_ID(),'_gidi_hotels_gidi_hotels_main_location',true)['longitude']; ?>),
						zoom: 10
					};
					var map = new google.maps.Map(mapCanvas, mapOptions);
				</script>
				
			</div>
			<div class="tab-content" id="reviews">
				<h4>Reviews About this Hotel</h4>
				<?php 
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>
			</div>
			<div class="tab-content" id="policies">
				<h4>Hotel Policies, Terms and Conditions</h2>
				<p>
					<?php echo get_post_meta(get_the_ID(), "_gidi_hotels_policies",true); ?>
				</p>
			</div>
			<div class="tab-content" id="extra_information">
				<h4>Extra Information</h4>
				<p>
					<div class="gh-grid-wrapper">
					<?php $extra = get_post_meta(get_the_ID(), "_gidi_hotel_extra_information",true); ?>
					<?php foreach($extra as $key => $value): ?>
						<div class="gh-grid-three">
							<strong><?php echo $key; ?></strong>
						</div>
						<div class="gh-grid-nine last">
							<?php echo $value; ?>
						</div>
						<hr/>
					<?php endforeach; ?>
					</div>
				</p>
			</div>
		</div>
	</div>
	<div class="gh-grid-four last">
		<?php $roomtemplate = new Gidi_hotels_template_loader();

			$roomtemplate->gh_get_template_part("content","room"); ?>
	</div>	
</div>

<?php // If comments are open or we have at least one comment, load up the comment template.

// End the loop.
endwhile;
?>
<style>
	.main-inner,.page-title {
		display:none;
	}
	.page-title.main-search {
		display:block;
	}
	.woocommerce .woocommerce-breadcrumb {
		margin:0;
		visibility:hidden;
	}
</style>

<script>
	function openCity(evt, cityName) {
		// Declare all variables
		var i, tabcontent, tablinks;

		// Get all elements with class="tabcontent" and hide them
		tabcontent = document.getElementsByClassName("tab-content");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}

		// Get all elements with class="tablinks" and remove the class "active"
		tablinks = document.getElementsByClassName("gh-tab-links");
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
		}

		// Show the current tab, and add an "active" class to the button that opened the tab
		document.getElementById(cityName).style.display = "block";
		evt.currentTarget.className += " active";
	}

	function showGoogleMap(lat,long) {
		var mapCanvas = document.getElementById("google-maps-modal");
		var mapOptions = {
			center: new google.maps.LatLng(lat,long),
			zoom: 10
		};
		var map = new google.maps.Map(mapCanvas, mapOptions);
	}
	jQuery(function($){
		$("#star-rating").barrating({
			theme: 'fontawesome-stars',
			initialRating: <?php echo $star_count; ?>,
			readonly: true,
		});
	});
</script>

<?php get_footer(); ?>