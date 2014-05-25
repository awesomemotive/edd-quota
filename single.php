<?php
/**
 * the template for displaying all single posts
 *
 * To edit the single post template, do so in a child theme by COPYING
 * and pasting the quota/templates/content-single.php file into your child
 * folder in the same structural location. Then, WordPress will use your child
 * theme's content-single.php file instead of Quota's. 
 */

get_header(); ?>

	<div class="content clear">
		<?php
			// start the loop
			while ( have_posts() ) : the_post();
			
				get_template_part( 'templates/content', 'single' );

				// if comments are open or we have at least one comment, load the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;

				quota_content_nav( 'nav-below' );

			endwhile; // end the loop
		?>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>