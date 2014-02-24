<?php
/**
 * the template for displaying Search Results pages
 *
 * To edit the search template, do so in a child theme by COPYING
 * and pasting the quota/templates/content-search.php file into your child
 * folder in the same structural location. Then, WordPress will use your child
 * theme's content-search.php file instead of Quota's. 
 */

get_header(); ?>

	<section class="content clear">

		<?php 
			/** the loop is inside of the content-search.php file due to the
			 * way search pages are structured
			 */
			get_template_part( 'templates/content', 'search' ); 
		?>

	</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>