/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	wp.customize( 'quota_store_front_headlines', function( value ) {
		value.bind( function( to ) {
			$( '.store-description' ).text( to );
		} );
	} );
	wp.customize( 'quota_credits_copyright', function( value ) {
		value.bind( function( to ) {
			$( '.site-info' ).text( to );
		} );
	} );
	wp.customize( 'quota_read_more', function( value ) {
		value.bind( function( to ) {
			$( '.more-link' ).text( to );
		} );
	} );
	wp.customize( 'quota_product_info_button', function( value ) {
		value.bind( function( to ) {
			$( '.product-button' ).text( to );
		} );
	} );
} )( jQuery );