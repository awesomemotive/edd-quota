<?php
/**
 * the template part for single posts
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php quota_posted_on(); ?>
		</div>
	</header>
	
	<?php // show featured image? theme customizer options ?>
	<?php if ( 'option1' == get_theme_mod( 'quota_single_featured_image' ) && has_post_thumbnail() ) : ?>
		<div class="featured-image">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content">
	
		<?php 
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'quota' ),
				'after'  => '</div>',
			) );
		?>
		
	</div>

	<footer class="entry-footer">
		<div class="entry-meta">
	
			<?php
				// translators: used between list items, there is a space after the comma
				$category_list = get_the_category_list( __( ', ', 'quota' ) );
	
				// translators: used between list items, there is a space after the comma
				$tag_list = get_the_tag_list( '', __( ', ', 'quota' ) );
	
				if ( ! quota_categorized_blog() ) {
				
					// This blog only has 1 category so we just need to worry about tags in the meta text
					if ( '' != $tag_list ) {
						$meta_text = __( 'Tagged as %2$s.', 'quota' );
					} else {
						$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'quota' );
					}
	
				} else {
				
					// But this blog has loads of categories so we should probably display them here
					if ( '' != $tag_list ) {
						$meta_text = __( 'Posted in %1$s and tagged %2$s.', 'quota' );
					} else {
						$meta_text = __( 'Posted in %1$s.', 'quota' );
					}
	
				} // end check for categories on this blog
	
				printf(
					$meta_text,
					$category_list,
					$tag_list,
					get_permalink(),
					the_title_attribute( 'echo=0' )
				);
				
				edit_post_link( __( ' Edit', 'quota' ), '<span class="edit-link">', '</span>' ); 
			?>
		</div>
	</footer>
</article>

<?php // show post footer? theme customizer options ?>
<?php if ( 'option1' == get_theme_mod( 'quota_post_footer' ) ) : ?>
	<div class="single-post-footer">
		<div class="post-footer-header clear">
			<div class="post-footer-avatar">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 75, '', get_the_author_meta( 'display_name' ) ); ?>
			</div>
			<div class="post-footer-author">
				<h3><?php printf( __( 'Written by %s', 'quota' ), get_the_author_meta( 'display_name' ) ); ?></h3>
				<p><?php do_action( 'quota_author_box' ); ?></p>
			</div>
		</div>
		<div class="post-footer-body">
			<p><?php echo get_the_author_meta( 'description' ); ?></p>
		</div>
	</div>
<?php endif; ?>