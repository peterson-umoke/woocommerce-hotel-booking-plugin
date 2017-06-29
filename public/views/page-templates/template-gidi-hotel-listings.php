<?php

/**
 * Template Name: Gidi Hotel Listings
 * 
 * @author Peterson Nwachukwu Umoke
 * @version 1.2.3
 * @link http://gidievents.com
 */

    /**
     * Get the header
     */
    get_header(); 
?>

<div id="container" class="force-fullwidth">
	<div id="primary">
		<?php if ( have_posts() ) : ?>
			<div class="posts">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php $gidi_hotels_templates->gh_get_template_part( 'templates/content', get_post_type() );?>
				<?php endwhile; ?>
			</div><!-- /.posts -->

		    <?php eve_pagination(); ?>
		<?php else : ?>
		    <?php $templates->gh_get_template_part( 'templates/content', 'none' ); ?>		
		<?php endif; ?>
	</div><!-- /#primary -->			
</div><!-- /#container -->	

<?php

    /**
     * Get the footer
     */
    get_footer(); 
?>

<style>
    .main-inner {
        display:none;
    }
    .page-title {
        display:none;
    }
</style>