<?php
/**
 * the template part for headline areas
 */
 

/** 
 * The following section controls the page headline such as
 * the tagline on the homepage, the headline on the store
 * front, and any additional headlines you'd like to add.
 */
$start_headline = "<div class=\"headline-area full\"><div class=\"main\"><div class=\"headline inner\">";
$end_headline = "</div></div></div>";


// Show headline area on the blog IF it's the homepage. Otherwise, show it on the homepage...
if ( ( is_home() && is_front_page() ) || ( is_front_page() && ! is_home() ) ) :
	echo $start_headline; ?>
	
			<h1 class="site-description headline-text"><?php echo get_bloginfo( 'description' ); ?></h1>
			
	<?php echo $end_headline;

// Show headline area on the store front page	
elseif ( is_page_template( 'edd-store-front.php' ) ) :
	echo $start_headline; ?>
	
			<h1 class="store-description headline-text"><?php echo get_theme_mod( 'quota_store_front_headlines', __( 'Edit this headline using the <a href="' . admin_url('/customize.php') . '">Customizer</a>.', 'quota' ) ); ?></h1>
			
	<?php echo $end_headline;	
	

/** 
 * Show headline area somewhere else you'd like using WordPress' conditional tags
 * Conditional Tags - http://codex.wordpress.org/Conditional_Tags
 * UNCOMMENT THE LINES BELOW for example code
 */

/* ---- ERASE THIS ENTIRE LINE ( 1 of 2 ) TO USE EXAMPLE CODE ----

// Show headline area on single posts
elseif ( is_single() ) :
	echo $start_headline; ?>
	
			<h1 class="single-headline headline-text">Sample Headline Text for Single Posts</h1>
			
	<?php echo $end_headline;
	
---- ERASE THIS ENTIRE LINE ( 2 of 2 ) TO USE EXAMPLE CODE ---- */ 
		
endif; 