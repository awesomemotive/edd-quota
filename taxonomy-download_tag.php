<?php
/**
 * download tag archives use the same style template as the store front. Edit
 * this template in the templates/content-download-taxonomy.php file.
 */

get_header(); ?>

	<div class="store-front">
		<div class="store-container">
			<?php get_template_part( 'templates/content', 'download-taxonomy' ); ?>
		</div>
	</div>

<?php get_footer(); ?>