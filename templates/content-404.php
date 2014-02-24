<?php
/**
 * the template part for the 404 error page
 */
?>

<article id="post-0" class="post not-found">
	<header class="entry-header">
		<h1 class="entry-title"><?php _e( 'Oops! It looks like there&rsquo;s an error. Let us help.', 'quota' ); ?></h1>
	</header>

	<div class="entry-content">
		<p><?php _e( 'Try using search to find what you were looking for.', 'quota' ); ?></p>

		<?php 
			get_search_form();
		
			// show intro to featured downloads if any exist
			if ( function_exists( 'edd_fd_show_featured_downloads' ) ) :
				printf( '<p class="featured-downloads-intro">%1$s</p>', __( 'You may also be interested in our featured downloads listed below. Take a look.', 'quota' ) );
			endif;
		?>

	</div>	
	
	<?php if ( function_exists( 'edd_fd_show_featured_downloads' ) ) : ?>
		<div class="featured-download-container">
			<h3 class="featured-downloads-title"><?php _e( 'Featured Downloads', 'quota' ); ?></h3>
			<?php edd_fd_show_featured_downloads(); ?>
		</div>
    <?php endif; ?>	
    	    		    
</article>
