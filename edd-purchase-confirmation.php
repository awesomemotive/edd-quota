<?php
/*
 * Template Name: Purchase Confirmation
 *
 * Easy Digital Downloads automatically creates multiple Pages when the 
 * plugin is installed and activated. This template is created for use 
 * with the Purchase Confirmation page.
 *
 * To edit the Purchase Confirmation template, do so in a child theme by COPYING
 * and pasting the quota/templates/content-purchase-confirmation.php file into your child
 * folder in the same structural location. Then, WordPress will use your child
 * theme's content-purchase-confirmation.php file instead of Quota's. 
 */

get_header(); ?>

<div class="store-content">

	<?php 
		// start the loop
		while ( have_posts() ) : the_post();

			get_template_part( 'templates/content', 'purchase-confirmation' );

		endwhile; // end the loop
	?>

</div>

<?php get_footer(); ?>