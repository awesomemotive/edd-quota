<?php
/**
 * the main template file
 *
 * This is the most generic template file in Quota. It is used to display 
 * a page when nothing more specific matches a query.
 */

get_header(); ?>

	<div class="content clear">

		<?php 
			if ( have_posts() ) :
				$count = 0;
	
				// start the Loop 
				while ( have_posts() ) : the_post();
				
					get_template_part( 'templates/content', get_post_format() );
					
					// display contents of quota_after_first_post hook below first post
					if ( $count == 0 && !is_paged() ) :						
						do_action( 'quota_after_first_post' );						
					endif;
					
					$count++;	
							
				endwhile; // end the loop
				
				quota_content_nav( 'nav-below' );	
				
			else :
			
				get_template_part( 'templates/no-results', 'index' );	
				
			endif; 
		?>

	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>