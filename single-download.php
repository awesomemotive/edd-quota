<?php
/**
 * the template for displaying all single downloads
 *
 * To edit the download template, do so in a child theme by COPYING
 * and pasting the quota/templates/content-download.php file into your child
 * folder in the same structural location. Then, WordPress will use your child
 * theme's content-download.php file instead of Quota's. 
 */

get_header(); ?>

	<div class="content clear">
		<?php 
			// start the loop
			while ( have_posts() ) : the_post();

				get_template_part( 'templates/content', 'download' );
					
				// only allow comments if chosen in theme customizer
				if ( 'option1' == get_theme_mod( 'quota_download_comments' ) ) :
				
					// if comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				endif;

			endwhile; // end the loop
		?>
	</div>

<?php get_sidebar( 'download' ); ?>
<?php get_footer(); ?>