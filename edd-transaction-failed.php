<?php
/*
 * Template Name: Transaction Failed
 *
 * Easy Digital Downloads automatically creates multiple Pages when the 
 * plugin is installed and activated. This template is created for use 
 * with the Transaction Failed page.
 *
 * To edit the Transaction Failed template, do so in a child theme by COPYING
 * and pasting the quota/templates/content-transaction-failed.php file into your child
 * folder in the same structural location. Then, WordPress will use your child
 * theme's content-transaction-failed.php file instead of Quota's. 
 */

get_header(); ?>

	<div class="store-content">
		<?php 
			// start the loop
			while ( have_posts() ) : the_post();
	
				get_template_part( 'templates/content', 'transaction-failed' );
	
			endwhile; // end the loop
		?>
	</div>

<?php get_footer(); ?>