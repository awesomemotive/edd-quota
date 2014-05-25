<?php
/**
 * the template for displaying all pages
 *
 * To edit the generic page template, do so in a child theme by COPYING
 * and pasting the quota/templates/content-page.php file into your child
 * folder in the same structural location. Then, WordPress will use your child
 * theme's content-page.php file instead of Quota's. 
 */

get_header(); ?>

	<div class="content clear">
		<?php 
			// start the loop
			while ( have_posts() ) : the_post();

				get_template_part( 'templates/content', 'page' );
			
				// only allow comments if chosen in theme customizer
				if ( 'option1' == get_theme_mod( 'quota_page_comments' ) ) :
				
					// if comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				endif;
					
			endwhile; // end the loop 
		?>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
