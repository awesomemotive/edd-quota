<?php
/**
 * the template for displaying Archive pages
 *
 * To edit the archive template, do so in a child theme by COPYING
 * and pasting the quota/templates/content-archive.php file into your child
 * folder in the same structural location. Then, WordPress will use your child
 * theme's content-archive.php file instead of Quota's. 
 */

get_header(); ?>

<section class="content clear">

	<?php 
		/** the loop is inside of the content-archive.php file due to the
		 * way archive pages are structured
		 */
		get_template_part( 'templates/content', 'archive' ); 
	?>
	
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>