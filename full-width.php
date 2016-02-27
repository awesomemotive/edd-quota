<?php
/*
 * Template Name: Full-width Page
 *
 * To edit the Full-width Page template, do so in a child theme by COPYING
 * and pasting the quota/templates/content-full-width.php file into your child
 * folder in the same structural location. Then, WordPress will use your child
 * theme's content-landing.php file instead of Quota's.
 */

get_header(); ?>

	<div class="store-content">
		<?php
			// start the loop
			while ( have_posts() ) : the_post();

				get_template_part( 'templates/content', 'full-width' );

			endwhile; // end the loop
		?>
	</div>

<?php get_footer(); ?>