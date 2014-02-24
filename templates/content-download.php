<?php
/**
 * the template part for single download pages
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>
	
	<div class="featured-image">
		<?php ( has_post_thumbnail() ? the_post_thumbnail() : ''); ?>
	</div>

	<div class="entry-content">
	
		<?php 
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'quota' ),
				'after'  => '</div>',
			) );
		?>
		
	</div>
</article>