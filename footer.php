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
					$credits = __( 'Built with WordPress & <a href="' . QUOTA_HOME . '">Quota for Easy Digital Downloads</a>', 'quota' );
					// If copyright & credits are left empty or have not been set, display default info.
					if ( '' == get_theme_mod( 'quota_credits_copyright' ) ) :
						echo $credits;
					else :
						echo get_theme_mod( 'quota_credits_copyright', $credits );
					endif;
				?>
				
			</span>
		</footer>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>