<?php
/**
 * the template part for download categories and tags
 */
?>

<div class="store-container">
		
	<?php if ( have_posts() ) : ?>
	
		<?php $i = 1; ?>
	
		<div class="products-container clear">
		
			<?php while ( have_posts() ) : the_post(); ?>
				
				<div class="threecol product <?php if ( $i % 3 == 0 ) { echo ' last'; } ?>">
					<a class="product-title" href="<?php the_permalink(); ?>">
						<?php the_title( '<h4>', '</h4>' ); ?>
					</a>
					
					<div class="product-image">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'product-image' ); ?>
						</a>
						
						<?php if ( function_exists( 'edd_price' ) ) : ?>
							<p class="product-price">
							
								<?php quota_item_price_template(); ?>
								
							</p>
						<?php endif; ?>
						
					</div>
					
					<?php if ( function_exists( 'edd_price' ) ) : ?>
						<p class="product-buttons">
							<a class="product-button" href="<?php the_permalink(); ?>"><?php echo get_theme_mod( 'quota_product_info_button', __( 'View Details', 'quota' ) ); ?><i class="fa fa-arrow-circle-right button-icon"></i></a>
						</p>
					<?php endif; ?>
					
				</div>
	
				<?php $i+=1; ?>
				
			<?php endwhile; ?>
				
		</div>
				
		<div class="navigation-paging store-pagination">
	
			<?php 					
				$big = 999999999; // an unlikely integer					
				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $wp_query->max_num_pages
				) );
			?>
		
		</div>
	
	<?php else : ?>
	
		<h2 class="center"><?php _e( 'Not Found', 'quota' ); ?></h2>
		<p class="center"><?php _e( 'Sorry, but you are looking for something that isn&rsquo;t here.', 'quota' ); ?></p>
		<?php get_search_form(); ?>
	
	<?php endif; // ends check for downloads ?>

</div>