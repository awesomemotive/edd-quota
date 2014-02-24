<?php
/**
 * Template Name: Store Front
 * 
 * To edit the Store Front page template, do so in a child theme by COPYING
 * and pasting the quota/templates/content-store-front.php file into your child
 * folder in the same structural location. Then, WordPress will use your child
 * theme's content-store-front.php file instead of Quota's. 
 */

get_header(); ?>

	<div class="store-front">

		<?php get_template_part( 'templates/content', 'store-front' ); ?>
	
	</div>

<?php get_footer(); ?>