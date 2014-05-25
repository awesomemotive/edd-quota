<?php
/**
 * the template for displaying Search Results pages
 */

if ( have_posts() ) : ?>
	<header class="page-header">
		<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'quota' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	</header>

	<?php 
		// Start the Loop
		while ( have_posts() ) : the_post(); ?>
		
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
			</article>

	<?php 
		endwhile;

		quota_content_nav( 'nav-below' );

	else :

		get_template_part( 'templates/content', 'no-results' );

	endif; // end the loop