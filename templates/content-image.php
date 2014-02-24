<?php
/**
 * the template part for image attachments 
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
		
			<?php
				// image byline information
				$metadata = wp_get_attachment_metadata();
				printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a>', 'quota' ),
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() ),
					wp_get_attachment_url(),
					$metadata['width'],
					$metadata['height']
				);

				edit_post_link( __( ' Edit', 'quota' ), '<span class="edit-link">', '</span>' );
			?>
			
		</div>
	</header>

	<div class="entry-content">
		<div class="entry-attachment">
			<div class="attachment">
				<?php quota_the_attached_image(); ?>
			</div>
			<?php if ( has_excerpt() ) : ?>
				<div class="entry-caption">
					<?php the_excerpt(); ?>
				</div>
			<?php endif; ?>
		</div>

		<?php
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'quota' ),
				'after'  => '</div>',
			) );
		?>
		
	</div>

	<nav role="navigation" class="navigation-image">
		<div class="nav-previous">
			<?php previous_image_link( false, __( '<span class="meta-nav">&larr;</span> Previous', 'quota' ) ); ?>
		</div>
		<div class="nav-next">
			<?php next_image_link( false, __( 'Next <span class="meta-nav">&rarr;</span>', 'quota' ) ); ?>
		</div>
	</nav>
</article>