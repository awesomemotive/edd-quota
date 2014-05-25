<?php
/**
 * the template for Quota's document <head>, site header, and 
 * opening site content. The content-headline.php file is also
 * called to include custom page headlines. See inline comments.
 */
$char = get_bloginfo('charset');
$ping = get_bloginfo('pingback_url');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo $char; ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php echo $ping; ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="header-area full">
		<div class="main">
			<?php do_action( 'before' ); ?>
			<header class="site-header inner">
			
				<span class="site-title">
				
					<?php // display either a logo or site title based on theme customizer options ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
						<?php if ( get_theme_mod( 'quota_logo' ) ) : ?>
							<img src="<?php echo get_theme_mod( 'quota_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
						<?php else : ?>
							<?php bloginfo( 'name' ); ?>
						<?php endif; ?>
					</a>
					
				</span>
	
				<?php if ( ! is_page_template( 'landing.php' ) ) : ?>
					<nav id="site-navigation">
						<span class="menu-toggle"><?php echo '<i class="fa fa-bars"></i> ' . __( 'Menu', 'quota' ); ?></span>								
						<?php wp_nav_menu( array( 'theme_location' => 'header', 'fallback_cb' => 'quota_menu_fallback' ) ); ?>					
					</nav>
				<?php endif; ?>
				
			</header>
		</div>
	</div>

<?php
/**
 * The HTML used to build the actual headlines are located in the 
 * templates/content-headline.php file for easier customization 
 * with a child theme.
 */
get_template_part( 'templates/content', 'headline' );


// <!-- the HTML tags below are closed in footer.php --> ?>
<div class="content-area full">
	<div class="main">
		<div class="site-content inner">