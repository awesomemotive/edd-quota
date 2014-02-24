<?php
/**
 * the template part for transaction failed pages
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'edd-failed' ); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>				
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</article>