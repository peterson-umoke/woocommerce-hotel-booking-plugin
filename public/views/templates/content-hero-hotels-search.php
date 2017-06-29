<?php 
$background = 'https://mediastream.jumeirah.com/webimage/heroactual//globalassets/global/hotels-and-resorts/dubai/burj-al-arab/burj-al-arab-terrace/burj-al-arab-jumeirah-terrace-exterior-2-hero.jpg'; ?>

<div class="hero hero-search-wrapper">
	<div class="hero-search">		
		<?php if ( ! empty( $background ) ) : ?>
			<div class="hero-search-image" style="background-image: url('<?php echo esc_attr( $background ); ?>');">	
			</div><!-- /.hero-search-image -->
		<?php endif; ?>

		<div class="hero-search-content">
			<h1>Search For Hotels around the world.</h1>
			<p>We have over 3,210,123 hotels registered with us</p>

			<div class="gh-tabs">
				<ul class="gh-tab-navigation">
					<li class="gh-tab active"><a href="#">Hotel</a></li>
					<li class="gh-tab"><a href="#">Flights</a></li>
					<li class="gh-tab"><a href="#">Packges</a></li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div id="gh-main-search" class="tabcontent clearfix">
				<?php $template_engine = new Gidi_hotels_template_loader();
						$template_engine->gh_get_template_part("content","blank-search"); ?>
			</div><!-- #london -->
		</div><!-- .hero-search-content -->
	</div><!-- /.hero-search -->
</div><!-- /.hero -->

<style>
	.page-title {
		display:none;
	}
	.main-inner {
		display:none;
	}
	.woocommerce-breadcrumb {
		display:none;
	}
	.hero-search {
		margin-top:-15px;
	}
	.hero-search-content {
		padding-top:100px;
	}
	.select2-selection.select2-selection--single {
		padding:8px;
	}
	.select2-container--default .select2-selection--single .select2-selection__arrow {
		height: 40px;
		position: absolute;
		top: 1px;
		right: 1px;
		width: 60px;
	}
	.select2-container .select2-selection--single {
		box-sizing: border-box;
		cursor: pointer;
		display: block;
		 height: auto; 
		user-select: none;
		-webkit-user-select: none;
	}
</style>