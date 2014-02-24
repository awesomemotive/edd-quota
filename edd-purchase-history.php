<?php
/*
 * Template Name: Purchase History
 *
 * Easy Digital Downloads automatically creates multiple Pages when the 
 * plugin is installed and activated. This template is created for use 
 * with the Purchase History page.
 *
 * To edit the Purchase History template, do so in a child theme by COPYING
 * and pasting the quota/templates/content-purchase-history.php file into your child
 * folder in the same structural location. Then, WordPress will use your child
 * theme's content-purchase-history.php file instead of Quota's. 
 */

get_header(); ?>

<div class="store-content">

	<?php 
		// start the loop
		while ( have_posts() ) : the_post();

			get_template_part( 'templates/content', 'purchase-history' );

		endwhile; // end the loop
	?>

</div>

<?php get_footer(); ?>