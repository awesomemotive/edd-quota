<?php
/**
 * Quota Updater.
 */

// Includes the files needed for the updater
if ( !class_exists( 'Quota_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new Quota_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://easydigitaldownloads.com', // Site where EDD is hosted
		'item_name' => 'Quota', // Name of theme
		'theme_slug' => 'quota', // Theme slug
		'version' => QUOTA_VERSION, // The current version of this theme
		'author' => QUOTA_AUTHOR, // The author of this theme
		'download_id' => '', // Optional, used for generating a license renewal link
		'renew_url' => '' // Optional, allows for a custom license renewal link
	),

	// Strings
	$strings = array(
		'theme-license' => QUOTA_NAME . __( ' License', 'quota' ),
		'enter-key' => __( 'Enter your theme license key.', 'quota' ),
		'license-key' => __( 'License Key', 'quota' ),
		'license-action' => __( 'License Action', 'quota' ),
		'deactivate-license' => __( 'Deactivate License', 'quota' ),
		'activate-license' => __( 'Activate License', 'quota' ),
		'status-unknown' => __( 'License status is unknown.', 'quota' ),
		'renew' => __( 'Renew?', 'quota' ),
		'unlimited' => __( 'unlimited', 'quota' ),
		'license-key-is-active' => __( 'License key is active.', 'quota' ),
		'expires%s' => __( 'Expires %s.', 'quota' ),
		'%1$s/%2$-sites' => __( 'You have %1$s / %2$s sites activated.', 'quota' ),
		'license-key-expired-%s' => __( 'License key expired %s.', 'quota' ),
		'license-key-expired' => __( 'License key has expired.', 'quota' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'quota' ),
		'license-is-inactive' => __( 'License is inactive.', 'quota' ),
		'license-key-is-disabled' => __( 'License key is disabled.', 'quota' ),
		'site-is-inactive' => __( 'Site is inactive.', 'quota' ),
		'license-status-unknown' => __( 'License status is unknown.', 'quota' ),
		'update-notice' => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'quota' ),
		'update-available' => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'quota' )
	)

);