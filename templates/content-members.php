<?php
/**
 * the template part for the members page
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'quota-members' ); ?>>	
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
	<div class="entry-content">
		<?php the_content(); ?>		
		<?php echo do_shortcode( '[purchase_history]' ); ?>		
		<?php echo do_shortcode( '[edd_profile_editor]' ); ?>
	</div>
</article>