<?php
/**
 * the template part for the checkout page
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'edd-checkout' ); ?>>	
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</article>