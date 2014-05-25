<?php
/**
 * the download sidebar widget area
 */
?>

<div class="sidebar">
	<?php 
		/**
		 * located in the inc/edd-functions.php file, this function 
		 * outputs information about the current download being viewed. To remove 
		 * the download information from above the sidebar, COPY and paste
		 * this file to the root of your child theme and simply comment out
		 * (or delete) the quota_download_item_before_sidebar() function 
		 * directly below.
		 */
		quota_download_item_before_sidebar();

		do_action( 'before_sidebar' );
		dynamic_sidebar( 'sidebar-download' );
	?>
</div>
