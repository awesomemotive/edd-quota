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
		<div class="product-sidebar-price">
			<?php quota_item_price_template(); ?>
		</div>	
		<div class="product-download-buy-button">
			<?php echo edd_get_purchase_link( array( 'id' => get_the_ID() ) ); ?>
		</div>
	</div>
<?php }



/** ===============
 * Item pricing information
 */
function quota_item_price_template() { 	

	// custom price template filters 
	$item_info = apply_filters( 'item_info', array(
		'price'				=> 'Price:',
		'starting_price'	=> 'Starting at:',
		'free'				=> 'Free'
	));
	
	if ( edd_has_variable_prices( get_the_ID() ) ) :

		// if the download has variable prices,
		// show the first one as a starting price
		_e( $item_info[ 'starting_price' ] . ' ', 'quota'); edd_price( get_the_ID() );
		
	elseif ( '0' != edd_get_download_price( get_the_ID() ) && !edd_has_variable_prices( get_the_ID() ) ) :
	
		_e( $item_info[ 'price' ] . ' ', 'quota' ); edd_price( get_the_ID() ); 
		
	else :
	
		_e( $item_info[ 'free' ] . ' ','quota' );
		
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
			<a href="<?php echo edd_get_checkout_uri(); ?>"><?php _e( 'Shopping Cart Items: ', 'quota' ); echo edd_get_cart_quantity(); ?> - <span class="header-cart edd-cart-quantity"><?php echo edd_currency_filter( edd_format_amount( edd_get_cart_amount() ) ); ?></span>
			</a>
		</li>
	</ul>
<?php }