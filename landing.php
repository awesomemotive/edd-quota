<?php
/*
 * Template Name: Landing Page
 * 
 * To edit the Landing Page template, do so in a child theme by COPYING
 * and pasting the quota/templates/content-landing.php file into your child
 * folder in the same structural location. Then, WordPress will use your child
 * theme's content-landing.php file instead of Quota's.
 */

get_header(); ?>

	<div class="content clear">

		<?php 
			// start the loop
			while ( have_posts() ) : the_post();		
	
				get_template_part( 'templates/content', 'landing' );

			endwhile; // end the loop
		?>
		
	</div>

<?php get_footer(); ?>