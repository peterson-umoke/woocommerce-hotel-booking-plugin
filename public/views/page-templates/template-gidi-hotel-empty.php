<?php 

/**
 * Template Name: Hotel Empty Page(No sidebar)
 * 
 * @author Ptersn Nwachukwu Umoke <umoke10@hotmail.com>
 * @link http://www.github.com/peterson-umoke
 */

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/peterson-umoke/
 * @since      1.0.0
 *
 * @package    Gidi_hotels
 * @subpackage Gidi_hotels/public/views
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php

get_header(); ?>

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

<?php get_footer(); ?>