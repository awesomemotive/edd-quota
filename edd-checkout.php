<?php
/*
 * Template Name: Checkout
 *
 * Easy Digital Downloads automatically creates multiple Pages when the 
 * plugin is installed and activated. This template is created for use 
 * with the Checkout page.
 *
 * To edit the Checkout template, do so in a child theme by COPYING
 * and pasting the quota/templates/content-checkout.php file into your child
 * folder in the same structural location. Then, WordPress will use your child
 * theme's content-checkout.php file instead of Quota's. 
 */

get_header(); ?>

<div class="store-content">

	<?php 
		// start the loop
		while ( have_posts() ) : the_post();

			get_template_part( 'templates/content', 'checkout' );

		endwhile; // end the loop
	?>

</div>

<?php get_footer(); ?>