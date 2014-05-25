<?php
/**
 * the template part for the main store front
 */
$store_page_setting = ( is_front_page() && is_page_template('edd-store-front.php') ? 'page' : 'paged' );
$current_page = get_query_var( $store_page_setting );
$per_page = intval( get_theme_mod( 'quota_store_front_count', 9 ) );
$offset = $current_page > 0 ? $per_page * ( $current_page-1 ) : 0;
$product_args = array(
	'post_type' 		=> 'download',
	'posts_per_page' 	=> $per_page,
	'offset' 			=> $offset
);
$products = new WP_Query( $product_args ); 
?>

<div class="store-container">

	<?php if ( get_theme_mod( 'quota_store_archives_description' ) && ! is_post_type_archive() ) : ?>
		<div class="store-description">
			<?php echo wpautop( get_theme_mod( 'quota_store_archives_description' ) ); ?>
		</div>
	<?php endif; ?>

	<?php if ( $products->have_posts() ) : ?>
	
		<?php $i = 1; ?>
	
		<div class="products-container clear">
		
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
			
				<div class="threecol product<?php if ( $i % 3 == 0 ) { echo ' last'; } ?>">
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
				
				<?php $i+=1;
			
			endwhile; ?>
		
		</div>
		
		<div class="navigation-paging store-pagination">
			<?php 					
				$big = 999999999; // an unlikely integer					
				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, $current_page ),
					'total' => $products->max_num_pages
				) );
			?>
		</div>
	
	<?php else : ?>
	
		<h2 class="center"><?php _e( 'Not Found', 'quota' ); ?></h2>
		<p class="center"><?php _e( 'Sorry, but you are looking for something that isn\'t here.', 'quota' ); ?></p>
		<?php get_search_form(); ?>
	
	<?php endif; // ends check for downloads ($products) ?>
	
</div>