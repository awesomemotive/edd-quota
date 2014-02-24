<?php
/**
 * Template Name: Members Area
 *
 * This template is used to display the profile editor with [edd_profile_editor],
 * the purchase history, and whatever else you see fit for a member page.
 */

get_header(); ?>

<div class="store-content">

	<?php 
		// start the loop
		while ( have_posts() ) : the_post();

			get_template_part( 'templates/content', 'members' );

		endwhile; // end the loop
	?>

</div>

<?php get_footer(); ?>