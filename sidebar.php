<?php
/**
 * the main sidebar widget area
 */
?>

<div class="sidebar">

	<?php do_action( 'before_sidebar' ); ?>
	
	<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
				
			<?php
				// calendar widget settings
				$calendar_args = array(
					'before_widget'	=> '<aside class="widget widget_calendar">',
					'after_widget'	=> '</aside>',
				);
				the_widget('WP_Widget_Calendar', '', $calendar_args); 
			?>

			<aside class="widget widget_archive">
				<h4 class="widget-title"><?php _e( 'Archives', 'quota' ); ?></h4>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

			<aside class="widget widget_search">
				<h4 class="widget-title"><?php _e( 'Search', 'quota' ); ?></h4>
				<?php get_search_form(); ?>
			</aside>

	<?php endif; ?>
	
</div>
