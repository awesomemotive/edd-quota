<?php
/**
 * This template is the most generic of all content displaying templates.
 * If the content type is not specified, like a single post or page, this
 * template is used to structure the content.
 */ 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-feed' ); ?>>
	<header class="entry-header">
		<a class="entry-title" href="<?php the_permalink(); ?>" rel="bookmark">
			<h1><?php the_title(); ?></h1>
		</a>
		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
			
				<?php 
					quota_posted_on();
					
					// translators: used between list items, there is a space after the comma
					$categories_list = get_the_category_list( __( ', ', 'quota' ) );
					
					if ( $categories_list && quota_categorized_blog() ) :
						printf( __( '<span class="cat-links"> in %1$s</span>', 'quota' ), $categories_list );
					endif;
				?>
				
			</div>
		<?php endif; ?>
	</header>
	<?php // show featured image? theme customizer options ?>
	<?php if ( 'option2' != get_theme_mod( 'quota_feed_featured_image' ) && has_post_thumbnail() ) : ?>
		<div class="featured-image">
			<a class="featured-image-anchor" href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
	<?php endif; ?>
	<div class="entry-content">
	
		<?php 
			// display either full posts or excerpts based on theme customizer options
			if ( 'option2' == get_theme_mod( 'quota_post_content' ) ) :
				the_content( __( 'Read More', 'quota' ) . '<i class="fa fa-arrow-circle-right button-icon"></i>' );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'quota' ),
					'after'  => '</div>',
				) );
			else :
			    the_excerpt();
			endif;
		?>
		
	</div>
</article>