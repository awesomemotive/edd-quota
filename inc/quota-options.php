<?php
/**
 * Quota admin options
 */


/** ===============
 * add settings page to menu
 */
function quota_add_options_page() {
	add_menu_page( __( QUOTA_NAME . ' Dashboard', 'quota' ), __( QUOTA_NAME, 'quota' ), 'manage_options', 'quota-options', 'quota_options_page', QUOTA_DIR_URI . '/inc/images/quota-admin-icon.png', 59 );
	add_submenu_page( 'quota-options', QUOTA_NAME . __( ' Theme License', 'quota' ), __( 'License Key', 'quota' ), 'manage_options', 'quota-options', 'quota_options_page' );
	add_submenu_page( 'quota-options', __( 'Customize', 'quota' ), __( 'Customizer', 'quota' ), 'manage_options', 'customize.php' );
}


/** ===============
 * register settings
 */
function quota_options_init() {
	register_setting( 'quota_license', 'quota_license_key', 'quota_sanitize_options' );
}


/** ===============
 * add actions
 */
add_action( 'admin_init', 'quota_options_init' );
add_action( 'admin_menu', 'quota_add_options_page' );


/** ===============
 * options output
 */
function quota_options_page() {
	$license 	= get_option( 'quota_license_key' );
	$status 	= get_option( 'quota_license_key_status' );
	?>
	<div class="wrap">
		<h2><?php _e( QUOTA_NAME . ' License Key Management' ); ?></h2>
		<form method="post" action="options.php">
		
			<?php settings_fields( 'quota_license' ); ?>
			
			<table class="form-table">
				<tbody>
					<tr valign="top">	
						<th scope="row" valign="top">
							<?php _e( 'License Key', 'quota' ); ?>
						</th>
						<td>
							<input id="quota_license_key" name="quota_license_key" type="text" class="regular-text" value="<?php esc_attr_e( $license ); ?>" />
							<label class="description" for="quota_license_key"><?php _e( 'Enter your license key', 'quota' ); ?></label>
						</td>
					</tr>
					<?php if( false !== $license ) { ?>
						<tr valign="top">	
							<th scope="row" valign="top">
								<?php _e( 'Activate License', 'quota' ); ?>
							</th>
							<td>
								<?php if( $status !== false && $status == 'valid' ) { ?>
									<span style="color:green;"><?php _e( 'active', 'quota' ); ?></span>
									<?php wp_nonce_field( 'edd_sample_nonce', 'edd_sample_nonce' ); ?>
									<input type="submit" class="button-secondary" name="quota_license_deactivate" value="<?php _e( 'Deactivate License', 'quota' ); ?>"/>
								<?php } else {
									wp_nonce_field( 'edd_sample_nonce', 'edd_sample_nonce' ); ?>
									<input type="submit" class="button-secondary" name="quota_license_activate" value="<?php _e( 'Activate License', 'quota' ); ?>"/>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>	
			<?php submit_button(); ?>
		
		</form>
	<?php
}


/** ===============
 * Gets rid of the local license status option
 * when adding a new one
 */
function quota_sanitize_options( $new ) {
	$old = get_option( 'quota_license_key' );
	if( $old && $old != $new ) {
		delete_option( 'quota_license_key_status' ); // new license has been entered, so must reactivate
	}
	return $new;
}