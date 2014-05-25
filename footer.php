<?php
/**
 * the template for displaying the footer
 */
?>

		</div><?php // <!-- .content-area --> ?>
	</div><?php // <!-- .main --> ?>
</div><?php // <!-- .site-content - the above HTML tags correspond with header.php --> ?>

<div class="footer-area full">
	<div class="main">
		<footer class="site-footer inner">
			<span class="site-info">			
				<?php
					$site_info = get_bloginfo( 'description' ) . ' - ' . get_bloginfo( 'name' ) . ' &copy; ' . date( 'Y' );					
					// display custom footer text if it's set, otherwise show tagline, site title, copyright, and date
					if ( '' != get_theme_mod( 'quota_credits_copyright' ) ) :
						echo get_theme_mod( 'quota_credits_copyright' );
					else :
						echo $site_info;
					endif;
				?>				
			</span>
		</footer>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>