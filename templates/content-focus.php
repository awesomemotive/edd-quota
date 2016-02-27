<?php
/**
 * the template part for the focus page template
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'quota-focus-page' ); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</article>