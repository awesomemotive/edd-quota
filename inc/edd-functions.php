<?php
/**
 * these functions apply directly to EDD functionality
 */


/** ===============
 * No purchase button below download content
 */
remove_action( 'edd_after_download_content', 'edd_append_purchase_link' );


/** ===============
 * Item info above sidebar on single download items
 */
function quota_download_item_before_sidebar() { ?>
	<div class="product-info-wrapper">
		<p class="product-sidebar-price">
			<?php quota_item_price_template(); ?>
		</p>
		<p class="product-download-buy-button">
			<?php echo edd_get_purchase_link( array( 'id' => get_the_ID() ) ); ?>
		</p>
	</div>
<?php }



/** ===============
 * Item pricing information
 */
function quota_item_price_template() {

	// custom price template filters
	$item_info = apply_filters( 'item_info', array(
		'price'				=> __( 'Price: ', 'quota' ),
		'starting_price'	=> __( 'Starting at: ', 'quota' ),
		'free'				=> __( 'Free ', 'quota' ),
	));

	if ( edd_has_variable_prices( get_the_ID() ) ) :

		// if the download has variable prices,
		// show the first one as a starting price
		echo $item_info[ 'starting_price' ];
		edd_price( get_the_ID() );

	elseif ( '0' != edd_get_download_price( get_the_ID() ) && !edd_has_variable_prices( get_the_ID() ) ) :

		echo $item_info[ 'price' ];
		edd_price( get_the_ID() );

	else :

		echo $item_info[ 'free' ];

	endif;
}


/** ===============
 * Allow comments on downloads
 */
function quota_add_comments_support( $supports ) {
	$supports[] = 'comments';
	return $supports;
}
add_filter( 'edd_download_supports', 'quota_add_comments_support' );


/** ===============
 * Menu fallback cart info display
 */
function quota_menu_fallback() { ?>
	<ul class="cart-menu">
		<li class="cart-menu-item">
			<?php if ( class_exists( 'Easy_Digital_Downloads' ) ) : ?>
				<a href="<?php echo edd_get_checkout_uri(); ?>"><?php _e( 'Shopping Cart Items: ', 'quota' ); echo edd_get_cart_quantity(); ?> - <span class="header-cart edd-cart-quantity"><?php echo edd_currency_filter( edd_format_amount( edd_get_cart_subtotal() ) ); ?></span></a>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo get_bloginfo( 'description' ); ?>"><?php _e( 'Home', 'quota' ); ?></a>
			<?php endif; ?>
		</li>
	</ul>
<?php }